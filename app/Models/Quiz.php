<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use App\Models\Directory;
use App\Models\Tag;

class Quiz extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //Imageに対するリレーション
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    //Tagに対するリレーション
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function histories()
    {
        return $this->hasMany(History::class);
    }
    
    public function directory()
    {
        return $this->belongsTo(Directory::class);
    }
    
    public function getOnlyLoginUser()
    {
        $user_id = auth()->id();
        return $this->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->get();
    }
    
    //クイズの正解率
    public function accuracy()
    {
        $histories = $this->histories()->orderBy('created_at', 'DESC')->pluck('is_correct');
        $histories_len = $histories->count();
        $accuracy_num = Auth::user()->accuracy_num;
        if ($histories_len > $accuracy_num){
            $questioned_num = $accuracy_num;
            $correct_num = $histories->slice(0, $questioned_num)->sum();
        }else{
            $questioned_num = $histories_len;
            $correct_num = $histories->slice(0, $questioned_num)->sum();
        }
        if ($questioned_num == 0){
            return 0;
        }else{
            return $correct_num/$questioned_num;
        }
    }
    
    //正解率によって重み付けした確率でクイズを取得する
    public function getWeightedQuiz($directory_ids, $tag_ids)
    {
        $user_id = Auth::user()->id;
        $quizzes = $this
            ->where([['user_id', $user_id], ['question_flag', 0]])
            ->whereIn('directory_id', $directory_ids)
            ->get();
        if(isset($tag_ids)){
            foreach($tag_ids as $tag_id){
                $quizzes = $quizzes->intersect(Tag::find($tag_id)->quizzes()->get());
            }
        }

        $array = []; //クイズの重みを格納する配列
        $qindex = 0;
        foreach($quizzes as $quiz){
            $accuracy = $quiz->accuracy();
            if($accuracy != 1){
                $array[$qindex] = 1.0 - $accuracy;
            }else{
                //正解率100%のクイズの重みが0にならないようにする
                $accuracy_num = Auth::user()->accuracy_num;
                $array[$qindex] = 1.0/(2.0*$accuracy_num); //1度だけ間違えたクイズの半分の重みをつける
            }
            $qindex++;
        }
        $sum = array_sum($array);
        $rand = $sum*mt_rand()/mt_getrandmax();
        $accumulated_weight = 0.0;
        foreach($array as $qindex => $weight){
            $accumulated_weight += $weight;
            if($accumulated_weight >= $rand){
                return $quizzes->get($qindex);
            }
        }
    }
    
    public function getQuizRandomly()
    {
        $user_id = auth()->id();
        return $this->where([
            ['user_id', $user_id],
            ['question_flag', 0],
            ])->inRandomOrder()
            ->first();
    }
    
    protected $fillable = [
        'body',
        'answer',
        'annotation',
        'directory_id'
        ];
        
    //あるクイズが削除された際に、それに付随する画像全てを物理削除する
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($quiz){
            $quiz->images()->delete();
        });
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

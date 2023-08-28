<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getOnlyLoginUser()
    {
        $user_id = auth()->id();
        return $this->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->get();
    }
    
    protected $fillable = [
        'body',
        'answer',
        'annotation',
        ];
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Image;
use App\Models\History;
use App\Models\Tag;
use App\Models\Directory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HayaoshiController extends Controller
{
    public function hayaoshi(Quiz $quiz)
    {
        $interval = Auth::user()->interval;
        $count_down_time = Auth::user()->count_down_time;
        if ($quiz->user_id == auth()->id() && $quiz->question_flag == 0){
            return view('hayaoshi.hayaoshi')->with([
                'quiz' => $quiz, 
                'images' => $quiz->images()->get(),
                'tags' => $quiz->tags()->get(),
                'interval' => $interval,
                'count_down_time' => $count_down_time
                ]);
        }elseif($quiz->user_id == auth()->id()){
            return 'このクイズは学習済みです';
            //bladeファイルを作って、フラッグリセットのボタンとともに表示したい
        }else{
            return view('cannot_show');
        }
    }
    
    public function start_button_pressed(Request $request)
    {
        //hayaoshi_portal画面でスタートボタンを押した時のみセッションを書き換える
        $request->session()->forget(['directory_id', 'directory_ids', 'tag_ids']);
        $directory_id = $request->input('directory');
        if (isset($directory_id)){
            $directory_ids = Directory::find($directory_id)->descendantsWithSelf()->get()->pluck('id')->toArray(); //選択したディレクトリとその全ての子孫ディレクトリ
        }else{
            $directory_ids = Directory::where('user_id', Auth::user()->id)->pluck('id')->toArray(); //ディレクトリを選択しなかった場合はそのユーザーのすべてのディレクトリを選択
        }
        $tag_ids = $request->input('tags');
        $request->session()->put(['directory_id' => $directory_id, 'directory_ids' => $directory_ids, 'tag_ids' => $tag_ids]);
        $quiz = new Quiz();
        return $this->hayaoshi_select($quiz, $directory_ids, $tag_ids);
    }
    
    public function hayaoshi_select(Quiz $quiz, $directory_ids, $tag_ids)
    {
        $q = $quiz->getWeightedQuiz($directory_ids, $tag_ids);
        if (isset($q)){
            return redirect('/hayaoshi/'.$q->id);
        }else{
            return redirect('/hayaoshi/all_used');
        }
    }
    
    public function hayaoshi_portal(Tag $tag, Directory $directory)
    {
        $user_id = Auth::user()->id;
        return view('hayaoshi.hayaoshi_portal')->with([
            'tags' => $tag->getOnlyLoginUser(),
            'directories' => $directory->where('user_id', $user_id)->get()->toTree()
        ]);
    }
    
    public function all_used()
    {
        $directory = Directory::find(session('directory_id'));
        $tag_ids = session('tag_ids');
        if(isset($tag_ids)){
            $tags = Tag::get();
            $tags = $tags->only($tag_ids);
        }
        return view('hayaoshi.hayaoshi_all_used')->with(['directory' => $directory, 'tags' => $tags]);
    }
    
    public function wrong(Quiz $quiz, History $history)
    {
        $history->quiz_id = $quiz->id;
        $history->is_correct = 0;
        $history->save();
        
        $quiz = new Quiz();
        $directory_ids = session('directory_ids');
        $tag_ids = session('tag_ids');
        return $this->hayaoshi_select($quiz, $directory_ids, $tag_ids);
    }
    
    public function correct(Quiz $quiz, History $history)
    {
        $history->quiz_id = $quiz->id;
        $history->is_correct = 1;
        $history->save();
        
        $quiz->question_flag = 1;
        $quiz->save();
        
        $quiz = new Quiz();
        $directory_ids = session('directory_ids');
        $tag_ids = session('tag_ids');
        return $this->hayaoshi_select($quiz, $directory_ids, $tag_ids);
    }
    
    //すべてのクイズのquestion_flagを1から0にリセットする
    public function reset_flag(){
        $user_id = auth()->id();
        DB::table('quizzes')->where([
                ['user_id', $user_id],
                ['question_flag', 1],
            ])->update(['question_flag' => 0]);
        return redirect('/hayaoshi');
    }
}

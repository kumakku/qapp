<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Image;
use App\Models\History;
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
    
    public function hayaoshi_select(Quiz $quiz)
    {
        // $q = $quiz->getQuizRandomly();
        $q = $quiz->getWeightedQuiz();
        if (isset($q)){
            return redirect('/hayaoshi/'.$q->id);
        }else{
            return view('hayaoshi.hayaoshi_all_used');
        }
    }
    
    public function hayaoshi_portal()
    {
        return view('hayaoshi.hayaoshi_portal');
    }
    
    public function wrong(Quiz $quiz, History $history)
    {
        $history->quiz_id = $quiz->id;
        $history->is_correct = 0;
        $history->save();
        
        $quiz = new Quiz();
        return $this->hayaoshi_select($quiz);
    }
    
    public function correct(Quiz $quiz, History $history)
    {
        $history->quiz_id = $quiz->id;
        $history->is_correct = 1;
        $history->save();
        
        $quiz->question_flag = 1;
        $quiz->save();
        
        $quiz = new Quiz();
        return $this->hayaoshi_select($quiz);
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

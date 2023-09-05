<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HayaoshiController extends Controller
{
    public function hayaoshi(Quiz $quiz)
    {
        $interval = Auth::user()->interval;
        $count_down_time = Auth::user()->count_down_time;
        if ($quiz->user_id == auth()->id()){
            return view('hayaoshi.hayaoshi')->with([
                'quiz' => $quiz, 
                'images' => $quiz->images()->get(), 
                'interval' => $interval,
                'count_down_time' => $count_down_time
                ]);
        }else{
            return view('cannot_show');
        }
    }
    
    public function hayaoshi_select(Quiz $quiz)
    {
        $q = $quiz->getQuizRandomly();
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
    
    public function wrong(Quiz $quiz)
    {
        $quiz->question_num += 1;
        $quiz->save();
        $quiz = new Quiz();
        return $this->hayaoshi_select($quiz);
    }
    
    public function correct(Quiz $quiz)
    {
        $quiz->question_flag = 1;
        $quiz->correct_num += 1;
        return $this->wrong($quiz);
    }
}

<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;

class QuizController extends Controller
{
    //
    public function portal()
    {
        return view('quizzes.portal');
    }
    
    public function index(Quiz $quiz)
    {
        //return view('quizzes.index')->with(['quizzes' => $quiz->getPaginateByLimit()]);
        $user_id = auth()->id();
        return view('quizzes.index')->with(['quizzes' => $quiz->where('user_id', $user_id)->get()]);
    }
    
    public function show(Quiz $quiz)
    {
        return view('quizzes.show')->with(['quiz' => $quiz]);
    }
    
    public function create()
    {
        return view('quizzes.create');
    }
    
    public function store(QuizRequest $request, Quiz $quiz)
    {
        $input = $request['quiz'];
        $quiz->user_id = auth()->id();
        $quiz->fill($input)->save();
        return redirect('/quizzes/'.$quiz->id);
    }
}

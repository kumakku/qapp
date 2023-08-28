<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;

class QuizController extends Controller
{
    //
    public function index(Quiz $quiz)
    {
        //return view('quizzes.index')->with(['quizzes' => $quiz->getPaginateByLimit()]);
        $user_id = auth()->id();
        return view('quizzes.index')->with(['quizzes' => $quiz->getOnlyLoginUser()]);
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
    
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit')->with(['quiz' => $quiz]);
    }
    
    public function update(QuizRequest $request, Quiz $quiz)
    {
        $input = $request['quiz'];
        $quiz->fill($input)->save();
        return redirect('quizzes/'.$quiz->id);
    }
}

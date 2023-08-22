<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('quizzes.index')->with(['quizzes' => $quiz->get()]);
    }
}

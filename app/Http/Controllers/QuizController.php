<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Image;
use Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        //別のユーザーのクイズにはアクセスできないようにする
        if ($quiz->user_id == auth()->id()){
            return view('quizzes.show')->with(['quiz' => $quiz, 'images' => $quiz->images()->get() ]);
        }else{
            return view('cannot_show');
        }
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
        
        if ($request->file('image_data')){
            $image_data = $request->file('image_data');
            $paths = [];
            foreach ($image_data as $image_datum){
                $paths[] = Cloudinary::upload($image_datum->getRealPath())->getSecurePath();
            }
            $image_array = [];
            foreach ($paths as $path){
                // $image_array[] = ['quiz_id' => $quiz->id, 'path' => $path];
                $image = new Image(); //複数レコードを追加するために毎回インスタンス化する
                $image->quiz_id = $quiz->id;
                $image->path = $path;
                $image->save();
            }
            // DB::table('images')->insert($image_array);
            // insertを使うとcreated_atとupdated_atがNULLになってしまう
        }
        return redirect('/quizzes/'.$quiz->id);
    }
    
    public function edit(Quiz $quiz)
    {
        if ($quiz->user_id == auth()->id()){
            return view('quizzes.edit')->with(['quiz' => $quiz, 'images' => $quiz->images()->get()]);
        }else{
            return view('cannot_show');
        }
    }
    
    public function update(QuizRequest $request, Quiz $quiz)
    {
        $input = $request['quiz'];
        // $quiz->user_id = auth()->id();
        $quiz->fill($input)->save();
        return redirect('quizzes/'.$quiz->id);
    }
    
    public function delete(Quiz $quiz)
    {
        $quiz->delete();
        return redirect('/');
    }
}

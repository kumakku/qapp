<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Image;
use App\Models\Tag;
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
            return view('quizzes.show')->with([
                'quiz' => $quiz, 
                'images' => $quiz->images()->get(),
                'tags' => $quiz->tags()->get()
                ]);
        }else{
            return view('cannot_show');
        }
    }
    
    public function create(Tag $tag)
    {
        return view('quizzes.create')->with(['tags' => $tag->getOnlyLoginUser()]);
    }
    
    public function store(QuizRequest $request, Quiz $quiz)
    {
        $input = $request['quiz'];
        $quiz->user_id = auth()->id();
        $quiz->fill($input)->save();
        
        if ($request->filled('tags')){
            $tag_ids = $request->input('tags');
            $quiz->tags()->attach($tag_ids);
        }
        
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
    
    public function edit(Quiz $quiz, Tag $tag)
    {
        if ($quiz->user_id == auth()->id()){
            return view('quizzes.edit')->with([
                'quiz' => $quiz, 
                'images' => $quiz->images()->get(),
                'tags' => $tag->getOnlyLoginUser(),
                'selected_tags' => $quiz->tags()->get()
                ]);
        }else{
            return view('cannot_show');
        }
    }
    
    public function update(QuizRequest $request, Quiz $quiz)
    {
        $input = $request['quiz'];
        $quiz->fill($input)->save();
        
        $tag_ids = $request->input('tags');
        $quiz->tags()->sync($tag_ids);
        
        return redirect('quizzes/'.$quiz->id);
    }
    
    public function delete(Quiz $quiz)
    {
        $quiz->delete();
        return redirect('/');
    }
}

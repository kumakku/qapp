<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Models\Image;
use App\Models\Tag;
use App\Models\Directory;
use Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index(Request $request, Quiz $quiz)
    {
        $user_id = Auth::user()->id;
        $word = $request->input('word');
        if(!empty($word)){
            $quizzes = $quiz
                        ->where([
                            ['user_id', $user_id],
                            ['body', 'like', '%'.$word.'%']
                        ])->orWhere([
                            ['user_id', $user_id],
                            ['answer', 'like', '%'.$word.'%']
                        ])->paginate($quiz->limit_count);
        }else{
            $quizzes = $quiz->getOnlyLoginUser();
        }
        return view('quizzes.index')->with(['quizzes' => $quizzes, 'word' => $word]);
    }
    
    public function show(Quiz $quiz)
    {
        //別のユーザーのクイズにはアクセスできないようにする
        if ($quiz->user_id == auth()->id()){
            return view('quizzes.show')->with([
                'quiz' => $quiz, 
                'images' => $quiz->images()->get(),
                'tags' => $quiz->tags()->get(),
                'directory' => Directory::find($quiz->directory_id),
                ]);
        }else{
            return view('cannot_show');
        }
    }
    
    public function create(Tag $tag, Directory $directory)
    {
        $user_id = Auth::user()->id;
        return view('quizzes.create')->with(['tags' => $tag->getOnlyLoginUser(), 'directories' => $directory->where('user_id', $user_id)->get()->toTree()]);
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
    
    public function edit(Quiz $quiz, Tag $tag, Directory $directory)
    {
        $user_id = Auth::user()->id;
        if ($quiz->user_id == $user_id){
            return view('quizzes.edit')->with([
                'quiz' => $quiz, 
                'images' => $quiz->images()->get(),
                'tags' => $tag->getOnlyLoginUser(),
                'selected_tags' => $quiz->tags()->get(),
                'directories' => $directory->where('user_id', $user_id)->get()->toTree()
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

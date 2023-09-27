<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directory;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DirectoryRequest;
use Datetime;

class DirectoryController extends Controller
{
    public function directory_manager(Directory $directory)
    {
        $user_id = Auth::user()->id;
        return view('directories.directory_manager')->with(['directories' => $directory->where('user_id', $user_id)->get()->toTree()]);
    }
    
    public function create(DirectoryRequest $request, Directory $directory)
    {
        $directory->user_id = Auth::user()->id;
        $directory->name = $request->input('directory_name');
        if($request->has('parent_directory_id')){
            $directory->parent_id = $request->input('parent_directory_id');
        }
        $directory->created_at = new Datetime();
        $directory->updated_at = new Datetime();
        $directory->save();
        return redirect('/directories');
    }
    
    public function show(Directory $directory, Request $request, Quiz $quiz)
    {
        //別のユーザーのディレクトリにはアクセスできないようにする
        $user_id = Auth::user()->id;
        if ($directory->user_id == $user_id){
            $word = $request->input('word');
            $limit_count = $quiz->limit_count;
            $onlyone = Directory::getRoots()->where('user_id', $user_id)->count() == 1 && $directory->isRoot(); 
            //そのユーザーの持つルートディレクトリ数が1であるかどうか。ディレクトリが最低一つ存在しないとクイズの追加ができないため、これがtrueの場合は削除ボタンを非表示にする。
            if(!empty($word)){
                $quizzes = $directory
                            ->quizzes()
                            ->where('body', 'like', '%'.$word.'%')
                            ->orWhere('answer', 'like', '%'.$word.'%')
                            ->paginate($limit_count);
            }else{
                $quizzes = $directory->quizzes()->paginate($limit_count);
            }
            return view('directories.show')->with([
                'directory' => $directory,
                'descendants' => $directory->descendantsWithSelf()->get()->toTree(),
                'parent' => Directory::find($directory->parent_id),
                'quizzes' => $quizzes,
                'word' => $word,
                'onlyone' => $onlyone,
                ]);
        }else{
            return view('cannot_show');
        }
    }
    
    public function edit(Directory $directory)
    {
        return view('directories.edit')->with(['directory' => $directory]);
    }
    
    public function update(Directory $directory, DirectoryRequest $request)
    {
        $directory->name = $request->input('directory_name');
        $directory->save();
        return redirect()->route('directory_manager');
    }
    
    public function delete(Directory $directory)
    {
        $directory->delete();
        return redirect('/directories');
    }
}

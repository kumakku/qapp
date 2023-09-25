<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImportRequest;
use SplFileObject;
use App\Models\Quiz;
use App\Models\Tag;
use App\Models\Directory;
use Illuminate\Support\Facades\Auth;
use DateTime;

class ImportController extends Controller
{
    public function prepare(Tag $tag, Directory $directory)
    {
        return view('import.prepare')->with([
            'directories' => $directory->where('user_id', Auth::user()->id)->get()->toTree(),
        ]);
    }
    
    public function store(ImportRequest $request, Quiz $quiz)
    {
        $file_array = $request->file_array;
        $directory_id = $request->directory;
        $tag_ids = $request->tags;
        foreach($file_array as &$item){
            $item['directory_id'] = $directory_id;
            $item['user_id'] = Auth::user()->id;
            $item['created_at'] = new Datetime();
            $item['updated_at'] = new Datetime();
        }
        unset($item);
        foreach(collect($file_array)->chunk(500) as $chunk){
            $quiz->insert($chunk->toArray());
        }
        return redirect('/');
    }
}
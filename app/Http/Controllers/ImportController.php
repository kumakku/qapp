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
        if (Auth::user()->directories()->count() > 0){
            return view('import.prepare')->with([
                'directories' => $directory->where('user_id', Auth::user()->id)->get()->toTree(),
            ]);
        }else{
            return redirect()->route('directory_manager'); //ディレクトリが存在しないとそもそもクイズが作成できないので、ディレクトリを作成させる
        }
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
        //バルクインサート
        foreach(collect($file_array)->chunk(500) as $chunk){
            $quiz->insert($chunk->toArray());
        }
        return redirect('/');
    }
}

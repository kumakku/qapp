<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function tag_manager(Tag $tag)
    {
        return view('tags.tag_manager')->with(['tags' => $tag->getOnlyLoginUser()]);
    }
    
    public function store(TagRequest $request, Tag $tag)
    {
        $tag->user_id = auth()->id();
        $tag->name = $request->input('tag_name');
        $tag->save();
        return redirect('/tags');
    }
    
    public function edit(Tag $tag)
    {
        return view('tags.edit')->with(['tag' => $tag]);
    }
    
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->name = $request->input('tag_name');
        $tag->save();
        return redirect('/tags');
    }
    
    public function delete(Tag $tag)
    {
        $tag->delete();
        return redirect('/tags/');
    }
}

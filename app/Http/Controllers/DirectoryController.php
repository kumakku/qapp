<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directory;
use Illuminate\Support\Facades\Auth;

class DirectoryController extends Controller
{
    public function directory_manager(Directory $directory)
    {
        $user_id = Auth::user()->id;
        return view('directories.directory_manager')->with(['directories' => $directory->where('user_id', $user_id)->get()->toTree()]);
    }
}

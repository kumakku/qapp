<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    //Quizに対するリレーション
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getOnlyLoginUser()
    {
        $user_id = auth()->id();
        return $this->where('user_id', $user_id)->get();
    }
}

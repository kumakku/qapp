<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    //Quizに対するリレーション
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }
}

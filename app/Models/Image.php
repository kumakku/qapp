<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    //Quizに対するリレーション
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

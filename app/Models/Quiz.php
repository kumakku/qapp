<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    
    //Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //Imageに対するリレーション
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    //Tagに対するリレーション
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

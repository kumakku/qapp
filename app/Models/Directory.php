<?php
namespace App\Models;

use Franzose\ClosureTable\Models\Entity;

class Directory extends Entity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'directories';

    /**
     * ClosureTable model instance.
     *
     * @var \App\Models\DirectoryClosure
     */
    protected $closure = 'App\Models\DirectoryClosure';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}

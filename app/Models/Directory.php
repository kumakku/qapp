<?php
namespace App\Models;

use Franzose\ClosureTable\Models\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Directory extends Entity
{
    
    use SoftDeletes;
    
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

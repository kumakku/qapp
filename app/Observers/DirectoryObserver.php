<?php

namespace App\Observers;

use App\Models\Directory;

class DirectoryObserver
{
    /**
     * Handle the Directory "created" event.
     *
     * @param  \App\Models\Directory  $directory
     * @return void
     */
    public function created(Directory $directory)
    {
        //
    }

    /**
     * Handle the Directory "updated" event.
     *
     * @param  \App\Models\Directory  $directory
     * @return void
     */
    public function updated(Directory $directory)
    {
        //
    }

    /**
     * Handle the Directory "deleted" event.
     *
     * @param  \App\Models\Directory  $directory
     * @return void
     */
    public function deleted(Directory $directory)
    {
        //
    }
    
    public function deleting(Directory $directory)
    {
        $directory->quizzes()->each(function ($quiz){
            $quiz->delete();
        });
        $directory->descendants()->each(function ($descendant){
            $descendant->delete();
        });
        // $directory->quizzes()->delete();
        // $directory->descendants()->delete();
        //まとめてdeleteではなく一つずつdeleteすることで子ディレクトリとそれらに属する全てのクイズを一括消去できる
    }

    /**
     * Handle the Directory "restored" event.
     *
     * @param  \App\Models\Directory  $directory
     * @return void
     */
    public function restored(Directory $directory)
    {
        //
    }

    /**
     * Handle the Directory "force deleted" event.
     *
     * @param  \App\Models\Directory  $directory
     * @return void
     */
    public function forceDeleted(Directory $directory)
    {
        //
    }
}

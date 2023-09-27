<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Directory;
use App\Models\Tag;
use DateTime;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // 新規ユーザー用のデフォルトのディレクトリとタグ
        $directory = new Directory();
        $directory->user_id = $user->id;
        $directory->name = $user->name;
        $directory->created_at = new Datetime();
        $directory->updated_at = new Datetime();
        $directory->save();
                
        foreach ($this->genres as $genre){
            Tag::insert([
                'user_id' => $user->id,
                'name' => $genre,
                'created_at' => new DateTime(),
    			'updated_at' => new DateTime(),
                ]);
        }
    }
    
    private $genres = [
            '理系',
            '文学',
            '言葉',
            '日本史',
            '世界史',
            '地理',
            '公民',
            '芸術',
            '漫アゲ',
            '生活',
            'スポーツ',
            '芸能',
            'ノンセク'
            ];

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        
    }
    
    //deletedは削除後に呼び出されるが、deletingは削除前に呼び出される
    public function deleting(User $user)
    {
        $user->quizzes()->delete(); //一度論理削除
        $user->quizzes()->withTrashed()->forceDelete(); //論理削除したものを物理削除
        $user->directories()->delete();
        // $user->directories()->withTrashed()->forceDelete(); //Directoryモデルでsoftdeleteを宣言していないのでdeleteで物理削除される
        $user->tags()->delete();
        $user->tags()->withTrashed()->forceDelete();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

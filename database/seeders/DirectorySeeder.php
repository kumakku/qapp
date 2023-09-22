<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Directory;
use DateTime;

class DirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directories = [
            new Directory(['id' => 1, 'user_id' => 1, 'name' => '短文基本']),
            new Directory(['id' => 2, 'user_id' => 1, 'parent_id' => 1, 'name' => 'abc']),
            new Directory(['id' => 3, 'user_id' => 1, 'parent_id' => 2, 'name' => 'abc the1st']),
            new Directory(['id' => 4, 'user_id' => 1, 'parent_id' => 2, 'name' => 'abc the2nd']),
            new Directory(['id' => 5, 'user_id' => 1, 'parent_id' => 1, 'name' => 'abcmorphous']),
            new Directory(['id' => 6, 'user_id' => 1, 'parent_id' => 5, 'name' => 'abcmorphous the1st']),
            new Directory(['id' => 7, 'user_id' => 1, 'parent_id' => 5, 'name' => 'abcmorphous the2nd']),
            new Directory(['id' => 8, 'user_id' => 1, 'name' => '鳥居']),
            new Directory(['id' => 9, 'user_id' => 1, 'parent_id' => 8, 'name' => 'STU']),
            new Directory(['id' => 10, 'user_id' => 1, 'parent_id' => 8, 'name' => 'BNS']),
            new Directory(['id' => 11, 'user_id' => 1, 'parent_id' => 9, 'name' => 'STU the1st']),
            new Directory(['id' => 12, 'user_id' => 1, 'parent_id' => 9, 'name' => 'STU the2nd']),
            new Directory(['id' => 13, 'user_id' => 1, 'parent_id' => 10, 'name' => 'BNS the1st']),
            new Directory(['id' => 14, 'user_id' => 1, 'parent_id' => 10, 'name' => 'BNS the2nd']),
            new Directory(['id' => 15, 'user_id' => 2, 'name' => '別のユーザー'])
        ];
        
        foreach($directories as $directory){
            $directory->created_at = new DateTime();
            $directory->updated_at = new DateTime();
            $directory->save();
        }
    }
}

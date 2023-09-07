<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=5; $i++){
            DB::table('tags')->insert([
                'user_id' => 1,
                'name' => '難易度'.str_repeat('○', $i),
                'created_at' => new DateTime(),
    			'updated_at' => new DateTime(),
                ]);
        }
            
        foreach ($this->genres as $genre){
            DB::table('tags')->insert([
                'user_id' => 1,
                'name' => $genre,
                'created_at' => new DateTime(),
    			'updated_at' => new DateTime(),
                ]);
        }
        
        DB::table('tags')->insert([
                'user_id' => 1,
                'name' => '自作',
                'created_at' => new DateTime(),
    			'updated_at' => new DateTime(),
                ]);
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
}

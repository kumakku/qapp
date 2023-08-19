<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'body' => 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほ',
            'answer' => 'サンプル',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'body' => 'まみむめもやゆよらりるれろわをん',
            'answer' => 'サンプル',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'body' => '地動説で知られるコペルニクスも同様の法則を発見していた、素材価値の低い通貨の方が流通しやすいという法則は何でしょう？',
            'answer' => 'グレシャムの法則',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'body' => '黒澤明監督の『乱』や『影武者』に主演した、養成所の「無名塾」を開いたことでも知られる俳優は誰でしょう？',
            'answer' => '仲代達矢',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'body' => '第5曲の『菩提樹』が特に有名な、『美しき水車小屋の娘』『白鳥の歌』と並び称されるシューベルトの歌曲集は何でしょう？',
            'answer' => '『冬の旅』',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'body' => '歌のコーナーからは『だんご三兄弟』などのヒット曲も生まれた、NHKで長年放送されている幼児向け番組は何でしょう？',
            'answer' => '『おかあさんといっしょ』',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
    }
}

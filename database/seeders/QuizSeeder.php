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
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 1,
            'body' => 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほ',
            'answer' => 'サンプル',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 1,
            'body' => 'まみむめもやゆよらりるれろわをん',
            'answer' => 'サンプル',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => '地動説で知られるコペルニクスも同様の法則を発見していた、素材価値の低い通貨の方が流通しやすいという法則は何でしょう？',
            'answer' => 'グレシャムの法則',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => '黒澤明監督の『乱』や『影武者』に主演した、養成所の「無名塾」を開いたことでも知られる俳優は誰でしょう？',
            'answer' => '仲代達矢',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => '第5曲の『菩提樹』が特に有名な、『美しき水車小屋の娘』『白鳥の歌』と並び称されるシューベルトの歌曲集は何でしょう？',
            'answer' => '『冬の旅』',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => '歌のコーナーからは『だんご三兄弟』などのヒット曲も生まれた、NHKで長年放送されている幼児向け番組は何でしょう？',
            'answer' => '『おかあさんといっしょ』',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => 'お供のドラキュラ、オオカミ男、フランケンとともに人間界へやってきた主人公を描く、藤子不二雄Ⓐの漫画は何でしょう？',
            'answer' => '『怪物くん』',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => 'プログラミングにおいて、複数の条件分岐やループを入れ子にした構造のことを何というでしょう？',
            'answer' => 'ネスト',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => 'ロダン以降の時代には完成した芸術作品として製作されるようになった、頭と手足がない胴体だけの彫刻作品を何というでしょう？',
            'answer' => 'トルソー',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => '「もう飛ぶまいぞ、この蝶々」などのアリアが歌われる、主人公の召使と恋人スザンナの結婚式を描くモーツァルトのオペラは何でしょう？',
            'answer' => '『フィガロの結婚』',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => 'カトリックの信者が死後に聖人として公式に認定されることを、漢字二文字で何というでしょう？',
            'answer' => '列聖',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 1,
            'directory_id' => 7,
            'body' => '「三日月に腰かけて釣りをする少年」のロゴで知られる、『シュレック』や『カンフー・パンダ』を手がけた映画会社は何でしょう？',
            'answer' => 'ドリームワークス',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 2,
            'directory_id' => 15,
            'body' => '石清水八幡宮で行われたくじ引きの結果将軍となり「万人恐怖」と恐れられる政治を行った、室町幕府の第6代将軍は誰でしょう？',
            'answer' => '足利義教',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 2,
            'directory_id' => 15,
            'body' => 'メキシコにウシュマルやパレンケといった遺跡が残る、独自の象形文字や暦が発達した、中央アメリカの文明は何でしょう？',
            'answer' => 'マヤ文明',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
        DB::table('quizzes')->insert([
            'user_id' => 2,
            'directory_id' => 15,
            'body' => '若水を用いたお茶が振る舞われる、年が明けて最初に行われる茶会のことを何というでしょう？',
            'answer' => '初釜',
            'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
            ]);
    }
}

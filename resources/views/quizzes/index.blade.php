<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Index</title>
　　</head>
    <body>
        <h3>クイズの絞り込み</h3>
        <form action="/" method="GET">
            @csrf
            <input type="search" name="word" placeholder="キーワードで検索" value="{{ $word }}">
            <input type="submit" class="btn" value="検索">
        </form>
        <!--クイズ一覧をテーブル表示-->
        @include('quizzes.qtable', ['quizzezs' => $quizzes])
    </body>
    </x-app-layout>
</html>
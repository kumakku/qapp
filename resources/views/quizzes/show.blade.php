<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Create</title>
　　</head>
    <body>
        <h2>問題</h2>
        <p>{{ $quiz->body }}</p>
        <h2>答え</h2>
        <p>{{ $quiz->answer }}</p>
        <h2>注釈</h2>
        <p>{{ $quiz->annotation }}</p>
        <h2>画像</h2>
        <h2>タグ</h2>
        <button type="button" onclick="location.href='/quizzes/{{ $quiz->id }}/edit'">編集</button>
    </body>
    </x-app-layout>
</html>
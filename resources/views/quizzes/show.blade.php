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
        @foreach ($images as $image)
            <img src="{{ $image->path }}" alt="画像が読み込めません">
        @endforeach
        <h2>タグ</h2>
        <button type="button" onclick="location.href='/quizzes/{{ $quiz->id }}/edit'">編集</button>
        <form action="/quizzes/{{ $quiz->id }}" method="POST" id="form_{{ $quiz->id }}">
            @csrf
            @method('DELETE')
            <button type="button" onclick="deleteQuiz({{ $quiz->id }})">削除</button>
        </form>
        <script>
    		function deleteQuiz(id){
    			'use strict'
    			var res = window.confirm('削除すると復元できません。\n本当に削除しますか？')
    			if (res){
    				document.getElementById(`form_${id}`).submit();
    			}
    		}
    	</script>
    </body>
    </x-app-layout>
</html>
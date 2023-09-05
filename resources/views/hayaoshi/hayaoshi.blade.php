<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Hayaoshi</title>
　　</head>
    <body>
        <h2>問題文をここに表示</h2>
        <p id="body"></p>
        <p id="count_down"></p>
        <button id="hayaoshi" type="button" onclick="stopQuiz()">早押しボタン</button>
        <div id="qinfo" style="display:none">
            <h2>答え</h2>
            <p>{{ $quiz->answer }}</p>
            <form action="/hayaoshi/{{ $quiz->id }}/correct" method="POST">
                @csrf
                <input type="submit" value="○">
            </form>
            <form action="/hayaoshi/{{ $quiz->id }}/wrong" method="POST">
                @csrf
                <input type="submit" value="×">
            </form>
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
        </div>
        
        @php
            $body = $quiz->body;
            $answer = $quiz->answer;
        @endphp
        
        <script>
    		function deleteQuiz(id){
    			'use strict'
    			var res = window.confirm('削除すると復元できません。\n本当に削除しますか？')
    			if (res){
    				document.getElementById(`form_${id}`).submit();
    			}
    		}
    		var body = @json($body);
    		var interval = @json($interval);
    		var count_down_time = @json($count_down_time);
    	</script>
    	<script src="{{ asset('js/qapp.js') }}"></script>
    </body>
    </x-app-layout>
</html>
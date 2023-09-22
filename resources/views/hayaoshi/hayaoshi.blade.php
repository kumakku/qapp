<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Hayaoshi</title>
　　</head>
    <body>
        <div class="container mx-auto px-6">
            <h2>問題</h2>
            <p id="body" class="qtext">　</p>
            <p id="count_down" class="qtext text-center">　</p>
            <div class="flex justify-center">
                <button id="hayaoshi" class="btn" type="button" onclick="stopQuiz()">早押しボタン</button>
            </div>
            <div id="qinfo" style="display:none">
                <div class="flex justify-center">
                    <h2>答え </h2>
                    <p class="qtext">{{ $quiz->answer }}</p>
                </div>
                <div class="flex justify-center">
                    <form action="/hayaoshi/{{ $quiz->id }}/correct" method="POST">
                        @csrf
                        <input type="submit" class="delete_btn" value="○">
                    </form>
                    <form action="/hayaoshi/{{ $quiz->id }}/wrong" method="POST">
                        @csrf
                        <input type="submit" class="btn" value="×">
                    </form>
                    <br>
                </div>
                @isset($quiz->annotation)
                    <h2>注釈</h2>
                    <p class="qtext">{{ $quiz->annotation }}</p>
                @endisset
                @if($images->count()>0)
                    <h2>画像</h2>
                    @foreach ($images as $image)
                        <img src="{{ $image->path }}" alt="画像が読み込めません">
                    @endforeach
                @endif
                @if($tags->count()>0)
                    <h2>タグ</h2>
                @endif
                <div class="flex justify-center">
                    <button type="button" class="btn" onclick="location.href='/quizzes/{{ $quiz->id }}/edit'">編集</button>
                    <form action="/quizzes/{{ $quiz->id }}" method="POST" id="form_{{ $quiz->id }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete_btn" onclick="deleteQuiz({{ $quiz->id }})">削除</button>
                    </form>
                </div>
            </div>
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
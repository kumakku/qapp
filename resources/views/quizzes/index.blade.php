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
            <input type="search" name="word" placeholder="検索" value="{{ $word }}">
            <input type="submit" class="btn" value="検索">
        </form>
        <br>
        
        <!--クイズ一覧をテーブル表示-->
        <h2>クイズ一覧</h2>
        <p>問題数：{{ $quizzes->count() }}</p>
        <table>
            <tr class="head_record">
                <th>問題</th>
                <th>答え</th>
                <th>注釈</th>
                <th>タグ</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($quizzes as $quiz)
            <tr class="record">
                <td><a href="/quizzes/{{ $quiz->id }}">{{ $quiz->body }}</a></td>
                <td>{{ $quiz->answer }}</td>
                <td>{{ $quiz->annotation }}</td>
                <td>
                    @php
                        $tags = $quiz->tags()->get();
                    @endphp
                    @foreach ($tags as $tag)
                        <p>{{ $tag->name }}</p>
                    @endforeach
                </td>
                <td><button type="button" class="btn" onclick="location.href='/quizzes/{{ $quiz->id }}/edit'">編集</button></td>
                <td>
                    <form action="/quizzes/{{ $quiz->id }}" method="POST" id="form_{{ $quiz->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete_btn" onclick="deleteQuiz({{ $quiz->id }})">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $quizzes->links() }}
        
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
<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Quiz Database</title>
　　</head>
    <body>
        <input type="text" id="searchInput" placeholder="検索">
        <p>問題数：{{ $quizzes->count() }}</p>
        <table border="1" id="qtable">
            <tr>
                <th>問題</th>
                <th>答え</th>
                <th>注釈</th>
                <th>タグ</th>
            </tr>
            @foreach ($quizzes as $quiz)
            <tr>
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
                <td>
                    <button type="button" onclick="location.href='/quizzes/{{ $quiz->id }}/edit'">編集</button>
                </td>
                <td>
                    <form action="/quizzes/{{ $quiz->id }}" method="POST" id="form_{{ $quiz->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteQuiz({{ $quiz->id }})">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{--{{ $quizzes->links() }}--}}
    </body>
    <script>
		function deleteQuiz(id){
			'use strict'
			var res = window.confirm('削除すると復元できません。\n本当に削除しますか？')
			if (res){
				document.getElementById(`form_${id}`).submit();
			}
		}
	</script>
    </x-app-layout>
</html>
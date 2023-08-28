<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Quiz Database</title>
　　</head>
    <body>
        <input type="text" id="searchInput" placeholder="検索">
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
            </tr>
            @endforeach
        </table>
        {{--{{ $quizzes->links() }}--}}
    </body>
    </x-app-layout>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Quiz Database</title>
　　</head>
    <body>
        <input type="text" id="searchInput" placeholder="検索">
        <button type=“button” onclick="location.href='/create'">クイズ作成</button>
        <table border="1" id="qtable">
            <tr>
                <th>問題</th>
                <th>答え</th>
                <th>注釈</th>
                <th>タグ</th>
            </tr>
            @foreach ($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->body }}</td>
                <td>{{ $quiz->answer }}</td>
                <td>{{ $quiz->annotation }}</td>
            </tr>
            @endforeach
        </table>
        {{--{{ $quizzes->links() }}--}}
    </body>
</html>
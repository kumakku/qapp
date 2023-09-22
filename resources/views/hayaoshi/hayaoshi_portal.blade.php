<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Hayaoshi</title>
　　</head>
    <body>
        タグで絞り込んでから早押しクイズを開始する
        <br>
        <div class="flex justify-center">
            <form action="/hayaoshi/select" method="POST">
                @csrf
                <input type="submit" class="btn" value="スタート">
            </form>
        </div>
    </body>
    </x-app-layout>
</html>
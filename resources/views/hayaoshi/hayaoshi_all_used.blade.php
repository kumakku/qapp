<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Hayaoshi</title>
　　</head>
    <body>
        <!--選択したクイズを全て出題した場合に表示する画面-->
        タグ〜のクイズは全て出題済です
        
        <!--リセットしてもう一度やるボタン 設定とかにも表示する-->
        <form action="/hayaoshi/reset_flag" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" value="もう一度">
        </form>
    </body>
    </x-app-layout>
</html>
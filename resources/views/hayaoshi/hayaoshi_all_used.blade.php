<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Hayaoshi</title>
　　</head>
    <body>
        <!--選択したクイズを全て出題した場合に表示する画面-->
        <p>
            @isset($directory)
                ディレクトリ {{ $directory->name }} @isset($tags)、@else の@endisset
            @endisset 
            @isset($tags)
                タグ @foreach($tags as $tag) {{ $tag->name }} @endforeach の
            @endisset
            クイズは全て出題済です
        </p>
        
        <!--リセットしてもう一度やるボタン 設定とかにも表示する-->
        <form action="/hayaoshi/reset_flag" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" value="出題済をリセット" class="btn">
        </form>
    </body>
    </x-app-layout>
</html>
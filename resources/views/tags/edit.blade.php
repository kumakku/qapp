<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Edit</title>
　　</head>
    <body>
        <form action="/tags/{{ $tag->id }}" method="POST">
            @csrf
            @method('PUT')
            @if ($errors->any())
                @php
                    $body = old('tag_name');
                @endphp
            @else
                @php
                    $body = $tag->name;
                @endphp
            @endif
            <input type="text" name="tag_name" placeholder="タグ名を変更" value={{ $body }}>
            <br>
            <input type="submit" value="保存">
        </form>
    </body>
    </x-app-layout>
</html>
<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Edit Directory</title>
　　</head>
    <body>
        <h2>ディレクトリ名変更</h2>
        <form action="/directories/{{ $directory->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="directory_name" placeholder="ディレクトリ名を記入" value="{{ old('directory', $directory->name) }}">
            <p style="color:red">{{ $errors->first('directory_name') }}</p>
            <input type="submit" class="btn" value="保存">
        </form>
    </body>
    </x-app-layout>
</html>
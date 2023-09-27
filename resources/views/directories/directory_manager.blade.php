<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Directory</title>
　　</head>
    <body>
        <div class="flex justify-center">
            <div>
                @if($directories->count() > 0)
                    <ul>
                        @foreach($directories as $directory)
                            <li>
                                <a href="/directories/{{ $directory->id }}">{{ $directory->name }}</a>
                                @includeWhen($directory->hasChildren(), 'directories.recursive', ['directories' => $directory->getChildren()])
                            </li>
                        @endforeach
                    </ul>
                @else
                    クイズを追加するにはディレクトリを作成する必要があります
                @endisset
                <h3>ルートディレクトリを新規作成</h3>
                <form action="/directories/create" method="POST">
                    @csrf
                    <input type="text" name="directory_name" placeholder="ディレクトリ名を入力" value="{{ old('directory_name') }}">
                    <input type="submit" class="btn" value="保存">
                </form>
            </div>
        </div>
    </body>
    </x-app-layout>
</html>
<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Directory</title>
　　</head>
    <body>
        @if($directories->count() > 0)
            <ul>
                @foreach($directories as $directory)
                    <li>
                        {{ $directory->name }}
                        @includeWhen($directory->hasChildren(), 'directories.recursive', ['directories' => $directory->getChildren()])
                    </li>
                @endforeach
            </ul>
        @else
            クイズを追加するにはディレクトリを作成する必要があります
        @endisset
        <!--ルートディレクトリの新規作成-->
    </body>
    </x-app-layout>
</html>
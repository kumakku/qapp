<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Directory</title>
　　</head>
    <body>
        <ul>
            @foreach($directories as $directory)
                <li>
                    <a href="/directories/{{ $directory->id }}">{{ $directory->name }}</a>
                    @includeWhen($directory->hasChildren(), 'directories.recursive', ['directories' => $directory->getChildren()])
                </li>
            @endforeach
        </ul>
    </body>
</html>
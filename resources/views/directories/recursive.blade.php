<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Directory</title>
　　</head>
    <body>
        <ul>
            @foreach($directories as $directory)
                <li class="parent">
                    {{ $directory->name }}
                    @includeWhen($directory->hasChildren(), 'directories.recursive', ['directories' => $directory->getChildren()])
                </li>
            @endforeach
        </ul>
    </body>
</html>
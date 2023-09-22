<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Directory</title>
　　</head>
    <body>
        <ul>
            @foreach($directories as $directory)
                <li class="parent" onclick="openClose(this)">
                    {{ $directory->name }}
                    @includeWhen($directory->hasChildren(), 'directories.recursive', ['directories' => $directory->getChildren()])
                </li>
            @endforeach
        </ul>
        
        <script>
            function openClose(e){
                e.classList.toggle('active');
            }
        </script>
    </body>
    </x-app-layout>
</html>
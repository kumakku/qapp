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
                    <input 
                        type="radio" 
                        id="directory_{{ $directory->id }}" 
                        name="directory" 
                        value="{{ $directory->id }}" 
                        {{ old('directory') == $directory->id ? 'checked':'' }}
                    > <label for="directory_{{ $directory->id }}">{{ $directory->name }}</label>
                    @includeWhen($directory->hasChildren(), 'directories.recursive_for_hayaoshi', ['directories' => $directory->getChildren()])
                </li>
            @endforeach
        </ul>
    </body>
</html>
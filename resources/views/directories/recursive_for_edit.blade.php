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
                        name="quiz[directory_id]" value="{{ $directory->id }}" 
                        {{ old('quiz.directory_id', $quiz->directory_id) == $directory->id ? 'checked':'' }}
                    > <label for="directory_{{ $directory->id }}">{{ $directory->name }}</label>
                    @includeWhen($directory->hasChildren(), 'directories.recursive_for_edit', ['directories' => $directory->getChildren()])
                </li>
            @endforeach
        </ul>
    </body>
</html>
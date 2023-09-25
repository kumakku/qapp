<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Hayaoshi</title>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
　　</head>
    <body>
        <div class="flex justify-center">
            <form action="/import" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="flex">ファイルを選択<div class="require">*選択必須</div></h2>
                @foreach($errors->get('column_num_array.*') as $error)
                    <p style="color:red">{{ $error[0] }}</p>
                @endforeach
                @foreach($errors->get('file_array.*.body') as $error)
                    <p style="color:red">{{ $error[0] }}</p>
                @endforeach
                @foreach($errors->get('file_array.*.answer') as $error)
                    <p style="color:red">{{ $error[0] }}</p>
                @endforeach
                <input type="file" name="import">
                <p style="color:red">{{ $errors->first('import') }}</p>
                <br>
                
                <h2 class="flex">ディレクトリの選択<div class="require">*選択必須</div></h2>
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
                <p style="color:red">{{ $errors->first('directory') }}</p>
                <br>
                
                <input type="submit" class="btn" value="インポート">
            </form>
        </div>
        
        <script>
            $('.chosen-select').chosen({
                search_contains:true
            });
        </script>
    </body>
    </x-app-layout>
</html>
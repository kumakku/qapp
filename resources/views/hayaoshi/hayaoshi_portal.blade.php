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
            <form action="/hayaoshi/start" method="POST">
                @csrf
                <h2>ディレクトリで絞り込み</h2>
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
                
                <h2>タグで絞り込み</h2>
                <select name="tags[]" multiple class="chosen-select" data-placeholder="タグを検索">
                    @foreach($tags as $tag)
                        <option value={{ $tag->id }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
                <p class="require">ディレクトリとタグを選択しない場合は登録している全てのクイズが出題されます</p>
                <input type="submit" class="btn" value="スタート">
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
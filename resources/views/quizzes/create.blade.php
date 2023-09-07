<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Create</title>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
　　</head>
    <body>
        <form action="/quizzes" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>問題</h2>
            <input type="text" name="quiz[body]" placeholder="問題文を入力" value={{ old('quiz.body') }}>
            <p style="color:red">{{ $errors->first('quiz.body') }}</p>
            <h2>答え</h2>
            <input type="text" name="quiz[answer]" placeholder="答えを入力" value={{ old('quiz.answer') }}>
            <p style="color:red">{{ $errors->first('quiz.answer') }}</p>
            <h2>注釈</h2>
            <textarea name="quiz[annotation]" rows="5" cols="50" placeholder="注釈やメモしたいことがあれば入力">{{ old('quiz.annotation') }}</textarea>
            <p style="color:red">{{ $errors->first('quiz.annotation') }}</p>
            <h2>画像</h2>
            <input type="file" name="image_data[]" multiple>
            <h2>タグ</h2>
            <select name="tags[]" multiple class="chosen-select" data-placeholder="タグを検索">
                @foreach($tags as $tag)
                    <option value={{ $tag->id }}>{{ $tag->name }}</option>
                @endforeach
            </select>
            <br>
            <input type="submit" value="保存">
        </form>
        
        <script>
            $('.chosen-select').chosen({
                search_contains:true
            });
        </script>
    </body>
    </x-app-layout>
</html>
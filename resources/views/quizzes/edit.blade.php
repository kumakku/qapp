<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Edit</title>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
　　</head>
    <body>
        <form action="/quizzes/{{ $quiz->id }}" method="POST">
            @csrf
            @method('PUT')
            @if ($errors->any())
                @php
                    $body = old('quiz.body');
                    $answer = old('quiz.answer');
                    $annotation = old('quiz.annotation');
                @endphp
            @else
                @php
                    $body = $quiz->body;
                    $answer = $quiz->answer;
                    $annotation = $quiz->annotation;
                @endphp
            @endif
            <h2>問題</h2>
            <input type="text" name="quiz[body]" placeholder="問題文を入力" value={{ $body }}>
            <p style="color:red">{{ $errors->first('quiz.body') }}</p>
            <h2>答え</h2>
            <input type="text" name="quiz[answer]" placeholder="答えを入力" value={{ $answer }}>
            <p style="color:red">{{ $errors->first('quiz.answer') }}</p>
            <h2>注釈</h2>
            <textarea name="quiz[annotation]" rows="5" cols="50" placeholder="注釈やメモしたいことがあれば入力">{{ $annotation }}</textarea>
            <p style="color:red">{{ $errors->first('quiz.annotation') }}</p>
            <h2>画像の追加/削除</h2>
            @foreach ($images as $image)
                <img src="{{ $image->path }}" alt="画像が読み込めません">
            @endforeach
            <input type="file" name="image_data[]" multiple>
            <h2>タグ</h2>
            <select name="tags[]" multiple class="chosen-select" data-placeholder="タグを検索">
                    {{--$selected_tagsはcollectionなので、@emptyではfalse判定される--}}
                    @if($selected_tags->isEmpty())
                        @foreach($tags as $tag)
                            <option value={{ $tag->id }}>{{ $tag->name }}</option>
                        @endforeach
                    @else
                        @foreach($tags as $tag)
                            @foreach($selected_tags as $selected_tag)
                                @if($selected_tag->id == $tag->id)
                                    <option value={{ $tag->id }} selected>{{ $tag->name }}</option>
                                    @break
                                @elseif($loop->last)
                                    <option value={{ $tag->id }}>{{ $tag->name }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
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
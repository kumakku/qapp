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
        <div class="flex justify-center">
            <div>
                <form action="/quizzes/{{ $quiz->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h2 class="flex">問題<div class="require">*必須</div></h2>
                    <textarea type="text" name="quiz[body]" class="w-full" placeholder="問題文を入力">{{ old('quiz.body', $quiz->body) }}</textarea>
                    <p style="color:red">{{ $errors->first('quiz.body') }}</p>
                    
                    <h2 class="flex">答え<div class="require">*必須</div></h2>
                    <textarea type="text" name="quiz[answer]" class="w-full" placeholder="答えを入力">{{ old('quiz.answer', $quiz->answer) }}</textarea>
                    <p style="color:red">{{ $errors->first('quiz.answer') }}</p>
                    
                    <h2 class="flex">ディレクトリ<div class="require">*必須</div></h2>
                    <ul>
                        @foreach($directories as $directory)
                            <li>
                                <input 
                                    type="radio" 
                                    id="directory_{{ $directory->id }}" 
                                    name="quiz[directory_id]" 
                                    value="{{ $directory->id }}" 
                                    {{ old('quiz.directory_id', $quiz->directory_id) == $directory->id ? 'checked':'' }}
                                > <label for="directory_{{ $directory->id }}">{{ $directory->name }}</label>
                                @includeWhen($directory->hasChildren(), 'directories.recursive_for_edit', ['directories' => $directory->getChildren()])
                            </li>
                        @endforeach
                    </ul>
                    <p style="color:red">{{ $errors->first('quiz.directory_id') }}</p>
                    
                    <h2>注釈</h2>
                    <textarea name="quiz[annotation]" class="w-full" placeholder="注釈やメモしたいことがあれば入力">{{ old('quiz.annotation', $quiz->annotation) }}</textarea>
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
                    <input type="submit" class="btn" value="保存">
                </form>
                
                <br>
                @if($quiz->question_flag == 1)
                    <form action="/hayaoshi/reset_flag" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="resflag_id" value="{{ $quiz->id }}">
                        <input type="submit" value="出題済をリセット" class="delete_btn">
                    </form>
                @endif
            </div>
        </div>
        
        <script>
            $('.chosen-select').chosen({
                search_contains:true
            });
        </script>
    </body>
    </x-app-layout>
</html>
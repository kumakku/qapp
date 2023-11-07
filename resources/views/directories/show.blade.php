<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Show Directory</title>
　　</head>
    <body>
        <div class="flex">
            <h2>ディレクトリ：{{ $directory->name }}</h2>
            <button type="button" class="btn" onclick="location.href='/directories/{{ $directory->id }}/edit'">名称変更</button>
            @if(!$onlyone)
                <form action="/directories/{{ $directory->id }}" method="POST" id="form_{{ $directory->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="delete_btn" onclick="deleteDirectory({{ $directory->id }})">削除</button>
                </form>
            @endif
        </div>
        <p>親ディレクトリ：@if($directory->isRoot()) なし @else <a href="/directories/{{ $parent->id }}">{{ $parent->name }}</a> @endif</p>
        @if($directory->hasDescendants())
            <p>子ディレクトリ</p>
            <ul>
                @foreach($descendants as $descendant)
                    <li>
                        <a href="/directories/{{ $descendant->id }}">{{ $descendant->name }}</a>
                        @includeWhen($descendant->hasChildren(), 'directories.recursive', ['directories' => $descendant->getChildren()])
                    </li>
                @endforeach
            </ul>
        @else
            <p>子ディレクトリ：なし</p>
        @endif
        <h3>子ディレクトリを追加</h3>
        <form action="/directories/create" method="POST">
            @csrf
            <input type="text" name="directory_name" placeholder="ディレクトリ名を入力" value="{{ old('directory_name') }}">
            <input type="hidden" name="parent_directory_id" value="{{ $directory->id }}">
            <input type="submit" class="btn" value="保存">
        </form>
        <br>
        <h3>クイズの絞り込み</h3>
        <form action="/directories/{{ $directory->id }}" method="GET">
            @csrf
            <input type="search" name="word" placeholder="キーワードで検索" value="{{ $word }}">
            <input type="submit" class="btn" value="検索">
        </form>
        <!--クイズ一覧をテーブル表示-->
        @include('quizzes.qtable', ['quizzes' => $quizzes])
            
        
        <script>
    		function deleteDirectory(id){
    			'use strict'
    			var res = window.confirm('削除すると復元できません。\nまた、このディレクトリに属する全ての子ディレクトリとそれらに属するクイズも削除されます。\n本当に削除しますか？')
    			if (res){
    				document.getElementById(`form_${id}`).submit();
    			}
    		}
    	</script>
    </body>
    </x-app-layout>
</html>
<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Create</title>
　　</head>
    <body>
        <form action="/tags/" method="POST">
            @csrf
            <h2>タグを作成</h2>
            <input type="text" name="tag_name" placeholder="タグを新規作成" value={{ old('tag_name') }}>
            <br>
            <input type="submit" class="btn" value="保存">
        </form>
        <h2>タグを編集・削除</h2>
        @foreach($tags as $tag)
            {{dd($tags)}}
            {{ $tag->name }}
            <button type="button" class="btn" onclick="location.href='/tags/{{ $tag->id }}/edit'">編集</button>
            <form action="/tags/{{ $tag->id }}" method="POST" id="form_{{ $tag->id }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="button" class="delete_btn" onclick="deleteTag({{ $tag->id }})">削除</button>
            </form>
            <br>
        @endforeach
        
        <script>
    		function deleteTag(id){
    			'use strict'
    			var res = window.confirm(`削除すると復元できません。\nタグを本当に削除しますか？`);
    			if (res){
    				document.getElementById(`form_${id}`).submit();
    			}
    		}
    	</script>
    </body>
    </x-app-layout>
</html>
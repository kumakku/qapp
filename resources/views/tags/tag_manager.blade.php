<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Create</title>
　　</head>
    <body>
        <div class="flex justify-center">
            <div>
                <form action="/tags/" method="POST">
                    @csrf
                    <h2>タグを作成</h2>
                    <input type="text" name="tag_name" placeholder="タグを新規作成" value={{ old('tag_name') }}>
                    <br>
                    <input type="submit" class="btn" value="保存">
                </form>
                <br>
                <table>
                    <tr class="head_record">
                        <th>タグを編集・削除</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($tags as $tag)
                        <tr class="record">
                            <td>{{ $tag->name }}</td>
                            <td><button type="button" class="btn" onclick="location.href='/tags/{{ $tag->id }}/edit'">名称変更</button></td>
                            <td>
                                <form action="/tags/{{ $tag->id }}" method="POST" id="form_{{ $tag->id }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete_btn" onclick="deleteTag({{ $tag->id }})">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
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
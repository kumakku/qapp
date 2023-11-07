<!DOCTYPE html>
<html>
    <x-app-layout>
    <head>
        <meta charset="UTF-8"> <!-文字化け防止->
	    <title>Preferences</title>
　　</head>
    <body>
        <div class="flex justify-center">
            <div>
                <form action="/profile/preferences" method="POST">
                    @csrf
                    <h2>問題文の表示速度</h2>
                    <input type="text" name="user[interval]" value="{{ old("user.interval", Auth::user()->interval ) }}"> ms/文字
                    <p style="color:red">{{ $errors->first('user.interval') }}</p>
                    <h2>カウントダウンの秒数</h2>
                    <input type="text" name="user[count_down_time]" value="{{ old("user.count_down_time", Auth::user()->count_down_time ) }}"> s
                    <p style="color:red">{{ $errors->first('user.count_down_time') }}</p>
                    <br>
                    <br>
                    <input type="submit" class="btn" value="保存">
                </form>
                <br>
                @if ($flagged_num>0)
                    <h2>出題済を全てリセット</h2>
                    <form action="/profile/reset_all_flags" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="submit" class="delete_btn" value="出題済をリセット">
                    </form>
                @endif
            </div>
        </div>
    </body>
    </x-app-layout>
</html>
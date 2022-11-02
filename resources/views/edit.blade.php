@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mypage</title>
        <!-- Fonts -->
        <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">プロフィール編集画面</h1>
        <div class="myinformation">
            <form action="/mypage/{{ $user->id }}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class='name'>
                    <h2>名前</h2>
                    <input type='text' name='user[name]' value="{{ $user->name }}" />
                    <p class="name__error" style="color:red">{{ $errors->first('user.name') }}</p>
                </div>
                <div class='car'>
                    <h2>車の特徴</h2>
                    <input type='text' size="50" name='user[car]' value="{{ $user->car }}" />
                    <p class="car__error" style="color:red">{{ $errors->first('user.car') }}</p>
                </div>
                <div class='comment'>
                    <h2>コメント</h2>
                    <input type='text' size="50" name='user[comment]' value="{{ $user->comment }}" />
                    <p class="comment__error" style="color:red">{{ $errors->first('user.comment') }}</p>
                </div>
                <br/>
                <input type="submit" value="保存" />
            </form>
        </div>
        <div class="footer">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </body>
</html>
@endsection
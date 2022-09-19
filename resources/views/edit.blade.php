@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mypage</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">プロフィール編集画面</h1>
        <div class="content">
            <form action="/mypage/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='name'>
                    <h2></h2>
                    <input type='text' name='user[name]' value="{{ $user->name }}">
                </div>
                <div class='car'>
                    <h2>本文</h2>
                    <input type='text' name='user[car]' value="{{ $user->car }}">
                </div>
                <div class='comment'>
                    <h2>本文</h2>
                    <input type='text' name='user[comment]' value="{{ $user->comment }}">
                </div>
                <input type="submit" value="保存">
            </form>
            <br>
            <div class="footer">
                <button type="button" onClick="history.back()">戻る</button>
            </div>
        </div>
    </body>
</html>
@endsection
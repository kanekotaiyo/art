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
        <h1 class="title">プロフィール写真変更画面</h1>
        <div class="myinformation">
            <form action="/mypage_image/{{ $user->id }}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class='image'>
                    <h2>プロフィール写真</h2>
                    <input type="file" name='image' />
                </div>
                <br/>
                *プロフィール写真を選択せずに保存するとプロフィール写真は空になります。
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
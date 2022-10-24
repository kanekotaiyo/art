@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>allpage</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>プロフィール画面</h1>
        <h2>名前：{{$user->name}}</h2>
        <h2>車の特徴：{{$user->car}}</h2>
        <h2>コメント：{{$user->comment}}</h2>
        <h2>レビュー：{{ $avg }}/5.0</h2>
        @if ($user->car_image_path)
            <img src="{{ $user->car_image_path }}">
        @endif
        <div class="footer">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </body>
</html>
@endsection
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mypage</title>
        <!-- Fonts -->
        <link href="{{ asset('css/mypage.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1 class="page-title">マイページ画面</h1>
        <h2 class="edit">[<a href="/mypage/{{ $user->id }}/edit">編集</a>]</h2>
        <div class="mycomment">
            <div class="itm">
                <h2 class="name">名前：{{$user->name}}</h2>
            </div>
            <div class="image">
                @if ($user->car_image_path)
                    <img src="{{ $user->car_image_path }}">
                @endif
            </div>
            <h2 class="car">車の特徴：{{$user->car}}</h2>
            <h2 class="comment">コメント：{{$user->comment}}</h2>
            <h2 class="review">レビュー：{{ $avg }}/5.0</h2>
        </div>
        <h2><a href='/past_use'>過去のマッチング(予約者側)</a></h2>
        <h2><a href='/past_use_pickup'>過去のマッチング(送迎者側)</a></h2>
    </body>
</html>
@endsection
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
        <h2 class="edit">[<a href="/mypage/{{ $user->id }}/edit">プロフィール編集</a>]</h2>
        <h2 class="image_edit">[<a href="/mypage/{{ $user->id }}/image_edit">プロフィール写真変更</a>]</h2>
        <div class="myinformation">
            <h2 class="name">名前：{{$user->name}}</h2>
            <div class="image">
                @if ($user->image_path)
                    <img src="{{ $user->image_path }}">
                @endif
            </div>
            <h2 class="car">
                <span>車の特徴：</span>{{$user->car}}
            </h2>
            <h2 class="comment">
                <span>コメント：</span>{{$user->comment}}
            </h2>
            <h2 class="review">
                <span>送迎評価：</span>{{ $avg }}/5.0 (レビュー数：{{$count}})<br/>
                <span></span><a href="/reviewcomment/{{ $user->id }}">レビューコメント一覧</a>
            </h2>
        </div>
        <h2><a href='/past_use'>過去のマッチング(予約者側)</a></h2>
        <h2><a href='/past_use_pickup'>過去のマッチング(送迎者側)</a></h2>
    </body>
</html>
@endsection
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
        <div class="footer">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </body>
</html>
@endsection
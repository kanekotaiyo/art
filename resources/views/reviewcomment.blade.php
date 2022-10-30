@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>reviewcommment</title>
        <link href="{{ asset('css/reviewcomment.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1 class="page-title">レビューコメント一覧</h1>
        <div class='reviews'>
            @foreach ($reviews as $review)
                <div class="box">
                    <h2 class='review'><span>評価</span>：{{ $review->review }}/5</h2>
                    <h2 class='comment'><span>コメント</span>：{{ $review->comment }}</h2>
                </div>
            @endforeach
            <div class="footer">
                <button type="button" onClick="history.back()">戻る</button>
            </div>
        </div>
    </body>
</html>
@endsection
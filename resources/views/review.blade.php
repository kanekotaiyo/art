@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>create</title>
        <link href="{{ asset('css/review.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>レビュー画面</h1>
        <form action="/reviewing/{{$matching->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="review">
                <h3>レビュー相手：{{$matching->user->name}}</h3>
                <h3>評価</h3>
                <div class="rate-form">
                    <input id="star5" type="radio" name="review[review]" value="5">
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="review[review]" value="4">
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="review[review]" value="3">
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="review[review]" value="2">
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="review[review]" value="1">
                    <label for="star1">★</label>
                </div>
                <p class="review__error" style="color:red">{{ $errors->first('review.review') }}</p>
                <h3>コメント</h3>
                <input type="text" size="50" name="review[comment]"/>
                <p class="comment__error" style="color:red">{{ $errors->first('review.comment') }}</p>
                *評価とコメントは必ず入れてください。<br/>
                *コメントがなければ"なし"と書いてください。<br/>
                *レビューを送信することでマッチング終了となります。<br/>
                *レビューを送信すると予約状況画面から見れなくなりマイページの過去のマッチングに移動します。
                <br>
                <input type="submit" value="送信"/>
            </div>
        </form>
        <br>
        <button type="button" onClick="history.back()">戻る</button>
    </body>
</html>
@endsection
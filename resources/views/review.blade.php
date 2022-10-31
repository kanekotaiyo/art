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
                @if ($errors->has('name'))
                    <li>{{$errors->first('name')}}</li>
                @endif
                <h3>コメント</h3>
                <input type="text" name="review[comment]"/>
                @if ($errors->has('name'))
                    <li>{{$errors->first('name')}}</li>
                @endif
            </div>
            <br>
            <input type="submit" value="保存"/>
        </form>
        <br>
        <button type="button" onClick="history.back()">戻る</button>
    </body>
</html>
@endsection
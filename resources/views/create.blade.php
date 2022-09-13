@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>create</title>
    </head>
    <body>
        <h1>新しい予約</h1>
        <form action="/store" method="POST">
            @csrf
            <div class="plase">
                <h2>場所</h2>
                <input type="text" name="reserve[startplase]" placeholder="東京駅"/>から<input type="text" name="reserve[endplase]" placeholder="渋谷駅"/>
            </div>
            <div class="time">
                <h2>時間</h2>
                <input type="text" name="reserve[time]" />
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/myreserve">back</a>]</div>
    </body>
</html>
@endsection
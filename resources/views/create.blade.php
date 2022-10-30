@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>create</title>
        <link href="{{ asset('css/reserve.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>新しい予約</h1>
        <form action="/store" method="POST">
            @csrf
            <div class="reserve">
                <div class="plase">
                    <h2>場所</h2>
                    <input type="text" name="reserve[startplase]" placeholder="東京駅"/>から<input type="text" name="reserve[endplase]" placeholder="渋谷駅"/>
                </div>
                <br/>
                <div class="time">
                    <h2>時間</h2>
                    <label for="meeting-time">予約の時間を選択してください：</label>
                    <input type="datetime-local" id="time"
                        name="reserve[time]" value="{{ \Carbon\Carbon::today() }}"
                        min="{{ \Carbon\Carbon::today() }}" max="2300-12-31T00:00">
                </div>
                <input type="submit" value="保存"/>
            </div>
        </form>
        <br>
        <button type="button" onClick="history.back()">戻る</button>
    </body>
</html>
@endsection
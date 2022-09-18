@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>myreserve_show</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="plase">
            <div class="plase_reserve">
                <h2>場所</h2>
                <p>{{ $reserve->startplase }}から{{ $reserve->endplase }}</p>
            </div>
        </div>
        <div class="time">
            <div class="time_reserve">
                <h2>時間</h2>
                <p>{{ $reserve->time }}</p>    
            </div>
        </div>
        <div class="footer">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </body>
</html>
@endsection
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>matchlist</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>マッチング申請リスト</h1>
        @foreach ($matchings as $matching)
            <div class='reserve'>
                <h2 class='name'><a href="/allpage/{{ $matching->reserve->user->id }}">{{ $matching->reserve->user->name }}</a></h2>
                <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
                <h2 class='time'>{{ $matching->reserve->time }}</h2>
                <br>
            </div>
        @endforeach
        <button type="button" onClick="history.back()">戻る</button>
    </body>
</html>
@endsection
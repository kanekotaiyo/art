@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>みんなの予約</h1>
        <div class='reserves'>
            @foreach ($reserves as $reserve)
                <div class='reserve'>
                    <a href="/allpage/{{ $reserve->user->id }}"><h1 class='name'>{{ $reserve->user->name }}</h1></a>
                    <h2 class='plase'>{{ $reserve->startplase }}から{{ $reserve->endplase }}</h2>
                    <h2 class='time'>{{ $reserve->time }}</h2>
                    <h2 class='title'>
                        <a href="/myreserve/{{ $reserve->id }}">マッチング状況</a>
                    </h2>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $reserves->links() }}
        </div>
    </body>
</html>
@endsection
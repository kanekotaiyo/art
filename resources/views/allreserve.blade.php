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
        <h2><a href="/matchlist">マッチング申請リスト</h2></a>
        <div class='reserves'>
            @foreach ($reserves as $reserve)
                <div class='reserve'>
                    <h2 class='name'><a href="/allpage/{{ $reserve->user->id }}">{{ $reserve->user->name }}</a></h2>
                    <h2 class='plase'>{{ $reserve->startplase }}から{{ $reserve->endplase }}</h2>
                    <h2 class='time'>{{ $reserve->time }}</h2>
                    <h2 class='title'>
                        <a href="/matching/{{ $reserve->id }}">マッチを申請する</a>
                    </h2>
                    <br>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $reserves->links() }}
        </div>
    </body>
</html>
@endsection
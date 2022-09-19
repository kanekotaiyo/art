@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>myreserve</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>予約状況画面</h1>
        [<a href='/create'>新しく予約する</a>]
        <div class='reserves'>
            @foreach ($reserves as $reserve)
                <br>
                <div class='reserve'>
                    <h2 class='plase'>{{ $reserve->startplase }}から{{ $reserve->endplase }}</h2>
                    <h2 class='time'>{{ $reserve->time }}</h2>
                    <h2 class='title'>
                        <a href="/myreserve/{{ $reserve->id }}">マッチング状況</a>
                    </h2>
                    <form action="/myreserve/{{ $reserve->id }}" id="form_{{ $reserve->id }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">delete</button> 
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $reserves->links() }}
        </div>
    </body>
</html>
@endsection
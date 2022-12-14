@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>myreserve</title>
        <!-- Fonts -->
        <link href="{{ asset('css/reserve.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>予約状況画面</h1>
        <h2>[<a href='/create'>新しく予約する</a>]</h2>
        <div class='reserves'>
            @foreach ($reserves as $reserve)
                @if ($reserve->allfinish!=1)
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
                @endif
            @endforeach
        </div>
        <div class='paginate'>
            {{ $reserves->links() }}
        </div>
    </body>
</html>
@endsection
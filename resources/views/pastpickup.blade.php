@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mypage</title>
        <!-- Fonts -->
        <link href="{{ asset('css/matching.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>過去のマッチング（送迎者側）</h1>
        @foreach ($matchings as $matching)
            <div class='matching'>
                <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
                <h2 class='time'>{{ $matching->reserve->time }}</h2>
                <h2>予約者：{{ $matching->reserve->user->name }}</h2>
                <h2><a href="/allpage/{{ $matching->reserve->user->id }}">プロフィール</a></h2>
            </div>
        @endforeach
        <div class='paginate'>
            {{ $matchings->links() }}
        </div>
        <div class="footer">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </body>
</html>
@endsection
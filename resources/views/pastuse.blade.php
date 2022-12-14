@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mypage</title>
        <!-- Fonts -->
        <link href="{{ asset('css/reserve.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>過去のマッチング（予約者側）</h1>
        @foreach ($reserves as $reserve)
            <div class='reserve'>
                <h2 class='plase'>{{ $reserve->startplase }}から{{ $reserve->endplase }}</h2>
                <h2 class='time'>{{ $reserve->time }}</h2>
                @foreach ($reserve->matchings as $matching)
                    <h2>送迎者：{{ $matching->user->name }}</h2>
                    <h2><a href="/allpage/{{ $matching->user->id }}">プロフィール</a></h2>
                @endforeach
            </div>
        @endforeach
        <div class='paginate'>
            {{ $reserves->links() }}
        </div>
        <div class="footer">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </body>
</html>
@endsection
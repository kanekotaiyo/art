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
        <div class='reserve_confirm'>
            <h2>[マッチング成立]</h2>
            @foreach ($matchings as $matching)
            <div class='reserve'>
                @if($matching->confirmed ===1)
                    <h2 class='name'>ユーザー名：<a href="/allpage/{{ $matching->reserve->user->id }}">{{ $matching->reserve->user->name }}</a></h2>
                    <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
                    <h2 class='time'>{{ $matching->reserve->time }}</h2>
                    <h2 class='name'><a href="">チャット画面</a></h2>
                    </form>
                    <br>
                @endif
            @endforeach
            <div class='reserve_wait'>
            <h2>[返答待ち]</h2>
            @foreach ($matchings as $matching)
            <div class='reserve'>
                @if($matching->confirmed ===0)
                    <h2 class='name'>ユーザー名：<a href="/allpage/{{ $matching->reserve->user->id }}">{{ $matching->reserve->user->name }}</a></h2>
                    <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
                    <h2 class='time'>{{ $matching->reserve->time }}</h2>
                    <form action="/matchlist/{{ $matching->id }}" id="form_{{ $matching->id }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">delete</button> 
                    </form>
                    <br>
                    <br>
                @endif
            @endforeach
        </div>
        <br>
        <button type="button" onClick="history.back()">戻る</button>
    </body>
</html>
@endsection
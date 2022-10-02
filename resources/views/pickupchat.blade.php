@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>チャット画面</h1>
        <h2 class='name'>送迎者：<a href="/allpage/{{ $matching->user->id }}">{{ $matching->user->name }}</a></h2>
        <h2 class='name'>予約者：<a href="/allpage/{{ $matching->reserve->user->id }}">{{ $matching->reserve->user->name }}</a></h2>
        <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
        <h2 class='time'>{{ $matching->reserve->time }}</h2>
        <div class='chat'>
            @foreach ($chats as $chat)
                <br>
                <div class='chatscreen'>
                    {{--<h3>{{ $chat->from->name }}</h3>--}}
                    <h2 class='message'>{{ $chat->message }}</h2>
                </div>
            @endforeach
        </div>
        <form action="/pickupmessage/{{ $matching->id }}" method="POST">
            @csrf
            <div class="message">
                <input type="text" name="chat[message]" />
            </div>
            <input type="submit" value="送信"/>
        </form>
        <br>
        <div class="footer">
            <a href="/matchlist">[マッチング申請リストへ]</a>
        </div>
    </body>
</html>
@endsection
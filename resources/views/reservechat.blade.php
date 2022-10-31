@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>chat</title>
        <!-- Fonts -->
        <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>チャット画面</h1>
        <div class='chat'>
            <h2 class='name'>予約者：{{ $matching->reserve->user->name }}</h2>
            <h2 class='name'>送迎者：<a href="/allpage/{{ $matching->user->id }}">{{ $matching->user->name }}</a></h2>
            <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
            <h2 class='time'>{{ $matching->reserve->time }}</h2>
            <div class="scroll">
                @foreach ($chats as $chat)
                    @if($chat->from_id===Auth::id())
                        <div class='image' style="text-align: right">
                            <h3>{{ $chat->fromUser->name }}</h3>
                            <img src="{{ $chat->fromUser->image_path }}">
                        </div>
                        <div class='send'>
                            <h2>{{ $chat->message }}</h2>
                        </div>
                    @else
                        <div class='image' style="text-align: left">
                            <h3>{{ $chat->fromUser->name }}</h3>
                            <img src="{{ $chat->fromUser->image_path }}">
                        </div>
                        <div class='recieve'>
                            <h2>{{ $chat->message }}</h2>
                        </div>
                    @endif
                @endforeach
            </div>
            <br/>
            <form action="/reservemessage/{{ $matching->id }}" method="POST">
                @csrf
                <div class="message">
                    <input type="text" size="50" name="chat[message]" />
                    <p class="message__error" style="color:red">{{ $errors->first('chat.message') }}</p>
                </div>
                <input type="submit" value="送信"/>
            </form>
        </div>
        <div class="footer">
            <h2><a href="/myreserve/{{ $matching->reserve->id }}">[マッチング状況一覧へ]</a></h2>
        </div>
    </body>
</html>
@endsection
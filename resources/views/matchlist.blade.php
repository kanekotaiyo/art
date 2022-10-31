@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>matchlist</title>
        <!-- Fonts -->
        <link href="{{ asset('css/matching.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>マッチング申請リスト</h1>
        <div class='reserve_confirm'>
            <h2>[マッチング成立]</h2>
            @foreach ($matchings as $matching)
            <div class='matchings'>
                @if($matching->confirmed ===1 && $matching->reserve->allfinish!=1)
                    <div class='matching'>
                        <h2 class='name'>予約者：<a href="/allpage/{{ $matching->reserve->user->id }}">{{ $matching->reserve->user->name }}</a></h2>
                        <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
                        <h2 class='time'>{{ $matching->reserve->time }}</h2>
                        <h2 class='chat'><a href="/pickupchat/{{ $matching->id }}">チャット画面</a></h2>
                        </form>
                    </div>
                @endif
            @endforeach
            <div class='reserve_wait'>
            <h2>[返答待ち]</h2>
            @foreach ($matchings as $matching)
            <div class='reserve'>
                @if($matching->confirmed ===0)
                    <div class='matching'>
                        <h2 class='name'>予約者：<a href="/allpage/{{ $matching->reserve->user->id }}">{{ $matching->reserve->user->name }}</a></h2>
                        <h2 class='plase'>{{ $matching->reserve->startplase }}から{{ $matching->reserve->endplase }}</h2>
                        <h2 class='time'>{{ $matching->reserve->time }}</h2>
                        <form action="/matchlist/{{ $matching->id }}" id="form_{{ $matching->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">delete</button> 
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
        <div class='paginate'>
            {{ $matchings->links() }}
        </div>
        <br>
        <div class="footer">
            <h2><a href="/allreserve">[みんなの予約画面へ]</a></h2>
        </div>
    </body>
</html>
@endsection
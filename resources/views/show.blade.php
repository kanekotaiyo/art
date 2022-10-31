@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>myreserve_show</title>
        <!-- Fonts -->
        <link href="{{ asset('css/matching.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="plase">
            <div class="plase_reserve">
                <h1>場所：{{ $reserve->startplase }}から{{ $reserve->endplase }}</h1>
            </div>
        </div>
        <div class="time">
            <div class="time_reserve">
                <h1>時間：{{ $reserve->time }}</h1>
            </div>
        </div>
        <h2><マッチング状況一覧></h2>
        <div class='reserve_confirm'>
            @foreach ($matchings as $matching)
                @if($matching->confirmed ===1)
                    <div class='matching'>
                        <h2>[マッチング成立]</h2>
                        <h2>送迎者：{{ $matching->user->name }}</h2>
                        <h2><a href="/allpage/{{ $matching->user->id }}">プロフィール</a></h2>
                        <h2 class='chat'><a href="/reservechat/{{ $matching->id }}">チャット画面</a></h2>
                        @if($reserve->time < $today && count($matching->reviews()->get())==0) {{--時間反対--}}
                            <h2><a href="/review/{{$matching->id}}">レビューを書く</a></h2>
                            *レビューを送信することでマッチング終了となります。
                        @endif
                        <br/>
                        *予約時間から一日後にこの画面は見れなくなります。
                    </div>
                @endif
            @endforeach
            <div class='reserve_wait'>
            @if($reserve->time >= $today)
                @foreach ($matchings as $matching)
                    @if($matching->confirmed ===0)
                        <div class='matching'>
                            <h2>送迎者：{{ $matching->user->name }}</h2>
                            <h2><a href="/allpage/{{ $matching->user->id }}">プロフィール</a></h2>
                            <h2><a href="/confirm/{{ $matching->id }}">マッチする</a></h2>
                            <br>
                        </div>
                    @endif
                @endforeach
            @else
                <h2>予約時刻は過ぎていますのでマッチングが確定しているもの以外表示できません</h2>
            @endif
        </div>
        <div class='paginate'>
            {{ $matchings->links() }}
        </div>
        <div class="footer">
            <h2><a href="/myreserve">[予約状況画面へ]</a></h2>
        </div>
    </body>
</html>
@endsection
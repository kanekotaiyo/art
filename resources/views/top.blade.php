@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>hitchhiking</title>
        <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1 class="top-title">hitchhiking</h1>
        <div class="scroll">
            <h2>【利用方法】</h2>
            <ul>
                <li>自分の情報を見たい場合はマイページを押してください。</li>
                <li>予約者側として利用したい場合は予約状況を押してください。</li>
                <li>送迎者側として利用したい場合はみんなの予約を押してください。</li>
                <li>ログアウトしたい場合は右上の名前を押すとログアウトボタンが出るのでそこを押してください。</li>
            </ul>
            
        </div>
    </body>
</html>
@endsection
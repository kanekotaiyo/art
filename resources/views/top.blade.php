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
    </body>
</html>
@endsection
@extends('layouts.default')
@vite('resources/css/app.css')
@section('header')
   
@endsection
@section('maincontent')
Vítej, {{ Auth::user()->name }}!
<p>Jsi přihlášen jako technik / admin.</p>

@endsection
    @section('footer')
    @endsection
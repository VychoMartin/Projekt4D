@extends('layouts.default')
@vite('resources/css/app.css')
@section('header')
    <h2>Toto je stránka zkouska</h2>
   
@endsection
@section('maincontent')
Vítej, {{ Auth::user()->name }}!
<p>Jsi přihlášen jako technik / admin.</p>

@endsection
    @section('footer')
        <p>Toto je footer</p>
    @endsection
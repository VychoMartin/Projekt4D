@extends('layouts.default')
@vite('resources/css/app.css')
@section('header')
    <h2>Toto je stránka home</h2>
   
@endsection
@section('maincontent')
Vítej, {{ Auth::user()->name }}!

@endsection
    @section('footer')
    @endsection

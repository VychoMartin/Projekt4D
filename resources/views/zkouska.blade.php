
@extends('layouts.default')
@section('header')
    <h2>Toto je stránka kontakt</h2>
    @include('sidemenu')
@endsection
@section('maincontent')
Vítej, {{ Auth::user()->name }}!

<form method="POST" action="{{ route('odhlaseni') }}">
    @csrf
    <button type="submit">Odhlásit se</button>
</form>
@endsection
    @section('footer')
        <p>Toto je footer</p>
    @endsection

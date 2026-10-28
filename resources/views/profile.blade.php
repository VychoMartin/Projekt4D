@extends('layouts.default')
@vite('resources/css/app.css')
@vite('resources/css/main.css')
@section('header')
   
@endsection



@section('maincontent')
<h1>Můj profil</h1>
<div class="profil">
    

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
    <h2>Osobní údaje</h2>
        <label for="name">Jméno</label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <label for="surname">Příjmení</label>
        <input id="surname" type="text" name="surname" value="{{ old('surname', $user->surname) }}">
        @error('surname') <span class="error">{{ $message }}</span> @enderror

        <label for="email">E-mail</label>
        <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}">
        @error('email') <span class="error">{{ $message }}</span> @enderror

        <label for="phone">Telefon</label>
        <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
        @error('phone') <span class="error">{{ $message }}</span> @enderror

        @if($user->role !== 'user' && $user->specializace)
            <p><strong>Specializace:</strong> {{ $user->specializace }}</p>
        @endif

        <button type="submit">Uložit změny</button>
    </form>

    

    @if(session('success_heslo'))
        <div class="alert-success">{{ session('success_heslo') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.heslo') }}">
        @csrf
        @method('PUT')
<h2>Změna hesla</h2>
        <label for="current_password">Současné heslo</label>
        <input id="current_password" type="password" name="current_password">
        @error('current_password') <span class="error">{{ $message }}</span> @enderror

        <label for="password">Nové heslo</label>
        <input id="password" type="password" name="password">
        @error('password') <span class="error">{{ $message }}</span> @enderror

        <label for="password_confirmation">Nové heslo znovu</label>
        <input id="password_confirmation" type="password" name="password_confirmation">

        <button type="submit">Změnit heslo</button>
    </form>
</div>
@endsection
    @section('footer')
    @endsection
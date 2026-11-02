@extends('layouts.default')
@vite('resources/css/app.css')
@vite('resources/css/main.css')
@vite('resources/js/app.js')
@section('header')
   
@endsection



@section('maincontent')
<h1>Můj profil</h1>
<div class="profil">
    
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
    <h2>Změna osobních údajů</h2>
        <div class="name-row">
    <div class="field">
        <label for="name">Jméno</label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="surname">Příjmení</label>
        <input id="surname" type="text" name="surname" value="{{ old('surname', $user->surname) }}">
        @error('surname') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
        <label for="email">E-mail</label>
        <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}">
        @error('email') <span class="error">{{ $message }}</span> @enderror

        <label for="phone">Telefon</label>
        <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
        @error('phone') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Uložit změny</button>
    </form>

    <form method="POST" action="{{ route('profile.heslo') }}">
        @csrf
        @method('PUT')
<h2>Změna hesla</h2>
        <label for="current_password">Současné heslo</label>
        <div class="password-wrapper">
        <input type="password" name="current_password" id="current_password" placeholder="Zadejte své heslo">
        <button type="button" class="toggle-password" data-target="password" aria-label="Zobrazit heslo"><i class="bi bi-eye"></i></button>
    </div>
        @error('current_password') <span class="error">{{ $message }}</span> @enderror

        <label for="password">Nové heslo</label>
        <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Zadejte nové heslo">
        <button type="button" class="toggle-password" data-target="password" aria-label="Zobrazit heslo"><i class="bi bi-eye"></i></button>
    </div>
        @error('password') <span class="error">{{ $message }}</span> @enderror

        <label for="password_confirmation">Nové heslo znovu</label>
        <div class="password-wrapper">
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Zadejte nové heslo znovu">
        <button type="button" class="toggle-password" data-target="password" aria-label="Zobrazit heslo"><i class="bi bi-eye"></i></button>
    </div>

        <button type="submit">Změnit heslo</button>
    </form>
</div>
<div class="smazatUcet">
    <h2>Smazání účtu</h2>
    <p>Smazáním účtu přijdete o přístup do aplikace. Tuto akci nelze vrátit zpět.</p>
    <form method="POST" action="{{ route('profile.destroy') }}"
      data-confirm="Opravdu chcete trvale smazat svůj účet?"
      data-confirm-button="Smazat účet">

        @csrf
        @method('DELETE')

        <label for="delete_password">Pro potvrzení zadejte heslo</label>
        <input type="password" name="password" id="delete_password">
        @error('password') <span class="error" style="color: red;">{{ $message }}</span> @enderror

        <button type="submit" class="btn-delete">
            <i class="bi bi-trash"></i> Smazat účet
        </button>
         
    </form>
</div>
@endsection
    @section('footer')
    @endsection
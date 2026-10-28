@extends('layouts.default')
@vite('resources/css/app.css')
@vite('resources/css/main.css')
@vite('resources/js/app.js')
@section('header')
   
@endsection



@section('maincontent')
<h1>Můj profil</h1>
<div class="profil">
    

    @if(session('success') || session('success_heslo'))
    <div class="toast-alert" id="toast">
        {{ session('success') ?? session('success_heslo') }}
    </div>
@endif
<script>
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => toast.classList.add('hide'), 3000);   // po 3 s zmizí
        setTimeout(() => toast.remove(), 3500);                // a odstraní se z DOM
    }
</script>
    
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

        @if($user->role !== 'user' && $user->specializace)
            <p><strong>Specializace:</strong> {{ $user->specializace }}</p>
        @endif

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
@endsection
    @section('footer')
    @endsection
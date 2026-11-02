<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
@php
    $toast = null;
    if (session('success'))            $toast = ['success', session('success')];
@endphp

@if($toast)
    <div class="toast toast-{{ $toast[0] }}" id="toast" role="alert">
        <i class="bi {{ $toast[0] === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
        <span>{{ $toast[1] }}</span>
        <button type="button" class="toast-close" aria-label="Zavřít">&times;</button>
        <div class="toast-progress"></div>
    </div>
@endif
<body class="authP">

<div class="container">

    <form method="POST" action="{{ route('prihlasovani') }}">
        @csrf

        <h1>Přihlášení</h1>

        <div class="input-group">
            <label>E-mail</label>
            <input type="text" name="email" placeholder="Zadejte svůj e-mail">
           @error('email')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>

        <div class="input-group">
            <label>Heslo</label>
             <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Zadejte své heslo">
        <button type="button" class="toggle-password" data-target="password" aria-label="Zobrazit heslo"><i class="bi bi-eye"></i></button>
    </div>
            @error('password')
        <div style="color:red">{{ $message }}</div>
    @enderror
        </div>
        <div class="pamatovat">
    <label>
        <input type="checkbox" name="remember" value="1"> Pamatovat si mě
    </label>
</div>
        

        <input type="submit"
               value="Přihlásit se"
               class="btn btn-primary">

               <a href="{{ route("registrace")}}" class="login-link">
                <button type="button" class="btn btn-secondary">
                    Nemám účet
                </button>
            </a>

    </form>

</div>

</body>
</html>
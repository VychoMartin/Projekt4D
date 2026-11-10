<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/js/app.js')

</head>
@php
    $toast = null;
    if (session('success'))            $toast = ['success', session('success')];
    elseif (session('success_heslo'))  $toast = ['success', session('success_heslo')];
    elseif (session('error'))          $toast = ['error', session('error')];
@endphp

@if($toast)
    <div class="toast toast-{{ $toast[0] }}" id="toast" role="alert">
        <i class="bi {{ $toast[0] === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
        <span>{{ $toast[1] }}</span>
        <button type="button" class="toast-close" aria-label="Zavřít">&times;</button>
        <div class="toast-progress"></div>
    </div>
@endif
<div class="modal-overlay" id="confirm-modal" hidden>
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="confirm-title">
        <div class="modal-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <h3 id="confirm-title">Opravdu to chcete udělat?</h3>
        <p id="confirm-text"></p>
        <div class="modal-actions">
            <button type="button" class="modal-cancel">Zrušit</button>
            <button type="button" class="modal-confirm">Potvrdit</button>
        </div>
    </div>
</div>
<body class="app">
    
<header>   
   <nav class="navbar">
    @include('sidemenu')
</nav>
   @yield('header')
</header>
<main>
@yield('maincontent')
</main>
<footer>
    @yield('footer')
    @include('footer')
</footer>
</body>
</html>
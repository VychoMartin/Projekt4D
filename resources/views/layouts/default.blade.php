<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hlášení poruch')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/css/main.css', 'resources/js/app.js'])
</head>
 
<body class="app">
 
{{-- ===== TOAST ===== --}}
@php
    $toast = null;
    if (session('success'))            $toast = ['success', session('success')];
    elseif (session('success_heslo'))  $toast = ['success', session('success_heslo')];
    elseif (session('error'))          $toast = ['error', session('error')];
 
    $toastStyles = [
        'success' => ['border' => 'border-emerald-500', 'text' => 'text-emerald-500', 'bar' => 'bg-emerald-500', 'icon' => 'bi-check-circle-fill'],
        'error'   => ['border' => 'border-red-500',     'text' => 'text-red-500',     'bar' => 'bg-red-500',     'icon' => 'bi-exclamation-triangle-fill'],
    ];
@endphp
 
@if($toast)
    @php $t = $toastStyles[$toast[0]]; @endphp
    <div id="toast" role="alert" data-closing="false"
         class="animate-toast-in fixed inset-x-4 top-5 z-[1000] flex items-center gap-3 overflow-hidden rounded-xl border-l-4 bg-white py-3.5 pl-4 pr-3 text-[#1f2a44] shadow-xl transition duration-300 data-[closing=true]:translate-x-8 data-[closing=true]:opacity-0 sm:inset-x-auto sm:right-5 sm:min-w-[300px] sm:max-w-[420px] {{ $t['border'] }}">
        <i class="bi {{ $t['icon'] }} text-xl {{ $t['text'] }}"></i>
        <span class="flex-1 text-sm font-medium">{{ $toast[1] }}</span>
        <button type="button" data-toast-close aria-label="Zavřít"
                class="cursor-pointer px-1 text-xl leading-none text-gray-400 transition hover:text-gray-800">&times;</button>
        <div class="animate-toast-progress absolute bottom-0 left-0 h-[3px] w-full origin-left opacity-30 {{ $t['bar'] }}"></div>
    </div>
@endif
 
{{-- ===== POTVRZOVACÍ OKNO ===== --}}
<div id="confirm-modal" hidden
     class="animate-fade-in fixed inset-0 z-[2000] flex items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm">
    <div role="dialog" aria-modal="true" aria-labelledby="confirm-title"
         class="animate-modal-pop w-full max-w-md rounded-2xl bg-white p-7 text-center shadow-2xl">
        <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full bg-red-100 text-2xl text-red-600">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h3 id="confirm-title" class="text-lg font-semibold text-[#1f2a44]">Opravdu to chcete udělat?</h3>
        <p id="confirm-text" class="mb-6 mt-2 text-sm text-gray-500"></p>
        <div class="flex gap-3">
            <button type="button" data-confirm-cancel
                    class="flex-1 cursor-pointer rounded-lg bg-gray-100 px-4 py-2.5 font-medium text-gray-700 transition hover:bg-gray-200">
                Zrušit
            </button>
            <button type="button" data-confirm-ok
                    class="flex-1 cursor-pointer rounded-lg bg-red-600 px-4 py-2.5 font-medium text-white transition hover:bg-red-700">
                Potvrdit
            </button>
        </div>
    </div>
</div>
 
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
 
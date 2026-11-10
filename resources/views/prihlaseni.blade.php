<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení | Hlášení poruch</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
 
<body class="flex min-h-dvh items-center justify-center bg-linear-to-br from-[#4facfe] to-[#00f2fe] p-4">
 
@php
    $toast = null;
    if (session('success')) {
        $toast = ['success', session('success')];
    } elseif (session('error')) {
        $toast = ['error', session('error')];
    }
@endphp
 
@if($toast)
    <div class="toast toast-{{ $toast[0] }}" id="toast" role="alert">
        <i class="bi {{ $toast[0] === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
        <span>{{ $toast[1] }}</span>
        <button type="button" class="toast-close" aria-label="Zavřít">&times;</button>
        <div class="toast-progress"></div>
    </div>
@endif
 
<main class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl sm:p-10">
 
    {{-- Hlavička --}}
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-semibold tracking-tight text-[#1f2a44]">Vítejte zpět</h1>
        <p class="mt-2 text-sm text-gray-500">Přihlaste se do systému hlášení poruch</p>
    </div>
 
    <form method="POST" action="{{ route('prihlasovani') }}" class="flex flex-col gap-5">
        @csrf
 
        {{-- E-mail --}}
        <div>
            <label for="email" class="form-label">E-mail</label>
            <div class="relative">
                <i class="bi bi-envelope pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input id="email" type="text" name="email" inputmode="email" autocomplete="email" autofocus
                       value="{{ old('email') }}" placeholder="Zadejte svůj e-mail"
                       class="form-input pl-10">
            </div>
            @error('email') <span class="form-error">{{ $message }}</span> @enderror
        </div>
 
        {{-- Heslo --}}
        <div>
            <label for="password" class="form-label">Heslo</label>
            <div class="password-wrapper">
                <i class="bi bi-lock pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input id="password" type="password" name="password" autocomplete="current-password"
                       placeholder="Zadejte své heslo"
                       class="form-input pl-10">
                <button type="button" class="toggle-password text-gray-400 transition hover:text-gray-700"
                        data-target="password" aria-label="Zobrazit heslo">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password') <span class="form-error">{{ $message }}</span> @enderror
        </div>
 
        {{-- Pamatovat si mě --}}
        <label class="mb-0 flex cursor-pointer items-center gap-2.5 text-sm font-normal text-gray-600">
            <input type="checkbox" name="remember" value="1"
                   class="size-4 cursor-pointer rounded border-gray-300 accent-[#1f2a44]">
            Pamatovat si mě
        </label>
 
        <button type="submit"
                class="w-full cursor-pointer rounded-xl bg-[#1f2a44] py-3 text-base font-semibold text-white shadow-md transition hover:bg-[#2c3b5e] hover:shadow-lg focus:ring-2 focus:ring-[#4facfe]/50 focus:outline-none">
            Přihlásit se
        </button>
    </form>
 
    {{-- Oddělovač --}}
    <div class="my-6 flex items-center gap-4 text-xs uppercase tracking-wider text-gray-400">
        <span class="h-px flex-1 bg-gray-200"></span>
        nebo
        <span class="h-px flex-1 bg-gray-200"></span>
    </div>
 
    <a href="{{ route('registrace') }}"
       class="block w-full rounded-xl border border-gray-300 py-3 text-center font-medium text-gray-700 transition hover:border-[#1f2a44] hover:bg-gray-50">
        Nemám účet
    </a>
</main>
 
</body>
</html>
 
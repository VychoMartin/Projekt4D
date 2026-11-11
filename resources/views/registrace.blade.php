<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace | Hlášení poruch</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
 
<body class="flex min-h-dvh items-center justify-center bg-linear-to-br from-[#4facfe] to-[#00f2fe] p-4 py-8">
 
<main class="w-full max-w-xl rounded-3xl bg-white p-8 shadow-2xl sm:p-10">
 
    {{-- Hlavička --}}
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-semibold tracking-tight text-[#1f2a44]">Vytvořit účet</h1>
        <p class="mt-2 text-sm text-gray-500">Zaregistrujte se a začněte hlásit poruchy</p>
    </div>
 
    <form name="registrace" method="POST" action="{{ route('registrace.store') }}" class="flex flex-col gap-5">
        @csrf
 
        {{-- Jméno a příjmení --}}
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="name" class="form-label">Jméno</label>
                <div class="relative">
                    <i class="bi bi-person pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input id="name" type="text" name="name" autocomplete="given-name"
                           value="{{ old('name') }}" placeholder="Např. Jan"
                           class="form-input pl-10">
                </div>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>
 
            <div>
                <label for="surname" class="form-label">Příjmení</label>
                <div class="relative">
                    <i class="bi bi-person pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input id="surname" type="text" name="surname" autocomplete="family-name"
                           value="{{ old('surname') }}" placeholder="Např. Novák"
                           class="form-input pl-10">
                </div>
                @error('surname') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>
 
        {{-- E-mail --}}
        <div>
            <label for="email" class="form-label">E-mail</label>
            <div class="relative">
                <i class="bi bi-envelope pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input id="email" type="text" name="email" inputmode="email" autocomplete="email"
                       value="{{ old('email') }}" placeholder="Např. jan.novak@gmail.com"
                       class="form-input pl-10">
            </div>
            @error('email') <span class="form-error">{{ $message }}</span> @enderror
        </div>
 
        {{-- Telefon --}}
        <div>
            <label for="phone" class="form-label">Telefon</label>
            <div class="relative">
                <i class="bi bi-telephone pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input id="phone" type="text" name="phone" inputmode="tel" autocomplete="tel"
                       value="{{ old('phone') }}" placeholder="Např. +420777123456"
                       class="form-input pl-10">
            </div>
            @error('phone') <span class="form-error">{{ $message }}</span> @enderror
        </div>
 
        {{-- Hesla --}}
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="form-label">Heslo</label>
                <div class="password-wrapper">
                    <i class="bi bi-lock pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input id="password" type="password" name="password" autocomplete="new-password"
                           placeholder="Min. 8 znaků"
                           class="form-input pl-10">
                    <button type="button" class="toggle-password text-gray-400 transition hover:text-gray-700"
                            data-target="password" aria-label="Zobrazit heslo">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>
 
            <div>
                <label for="password_confirmation" class="form-label">Heslo znovu</label>
                <div class="password-wrapper">
                    <i class="bi bi-shield-check pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password"
                           placeholder="Znovu zadejte heslo"
                           class="form-input pl-10">
                    <button type="button" class="toggle-password text-gray-400 transition hover:text-gray-700"
                            data-target="password_confirmation" aria-label="Zobrazit heslo">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password_confirmation') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>
 
        <button type="submit"
                class="mt-1 w-full cursor-pointer rounded-xl bg-[#1f2a44] py-3 text-base font-semibold text-white shadow-md transition hover:bg-[#2c3b5e] hover:shadow-lg focus:ring-2 focus:ring-[#4facfe]/50 focus:outline-none">
            Registrovat se
        </button>
    </form>
 
    {{-- Oddělovač --}}
    <div class="my-6 flex items-center gap-4 text-xs uppercase tracking-wider text-gray-400">
        <span class="h-px flex-1 bg-gray-200"></span>
        nebo
        <span class="h-px flex-1 bg-gray-200"></span>
    </div>
 
    <a href="{{ route('prihlaseni') }}"
       class="block w-full rounded-xl border border-gray-300 py-3 text-center font-medium text-gray-700 transition hover:border-[#1f2a44] hover:bg-gray-50">
        Už mám účet
    </a>
</main>
 
</body>
</html>
 
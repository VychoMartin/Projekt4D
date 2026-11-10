@extends('layouts.default')
 @vite(['resources/css/main.css', 'resources/css/app.css', 'resources/js/app.js'])
@section('header')
@endsection

@section('maincontent')
<div class="mx-auto w-full max-w-5xl px-4 py-10 sm:px-6">
    <h1 class="mb-10 text-4xl font-semibold tracking-tight text-[#1f2a44]">Můj profil</h1>

    <div class="grid items-start gap-8 lg:grid-cols-2">

        {{-- OSOBNÍ ÚDAJE --}}
        <form method="POST" action="{{ route('profile.update') }}" class="panel flex flex-col gap-4">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-semibold text-[#1f2a44]">Změna osobních údajů</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="form-label">Jméno</label>
                    <input id="name" type="text" name="name" class="form-input"
                           value="{{ old('name', $user->name) }}">
                    @error('name') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="surname" class="form-label">Příjmení</label>
                    <input id="surname" type="text" name="surname" class="form-input"
                           value="{{ old('surname', $user->surname) }}">
                    @error('surname') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="email" class="form-label">E-mail</label>
                <input id="email" type="text" name="email" class="form-input"
                       value="{{ old('email', $user->email) }}">
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone" class="form-label">Telefon</label>
                <input id="phone" type="text" name="phone" class="form-input"
                       value="{{ old('phone', $user->phone) }}">
                @error('phone') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-dark mt-2">Uložit změny</button>
        </form>

        {{-- ZMĚNA HESLA --}}
        <form method="POST" action="{{ route('profile.heslo') }}" class="panel flex flex-col gap-4">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-semibold text-[#1f2a44]">Změna hesla</h2>

            <div>
                <label for="current_password" class="form-label">Současné heslo</label>
                <div class="password-wrapper">
                    <input type="password" name="current_password" id="current_password"
                           class="form-input" placeholder="Zadejte své heslo">
                    <button type="button" class="toggle-password text-gray-500 hover:text-gray-900"
                            data-target="current_password" aria-label="Zobrazit heslo">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
               @error('current_password', 'updatePassword') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="form-label">Nové heslo</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password"
                           class="form-input" placeholder="Zadejte nové heslo">
                    <button type="button" class="toggle-password text-gray-500 hover:text-gray-900"
                            data-target="password" aria-label="Zobrazit heslo">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password', 'updatePassword') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="form-label">Nové heslo znovu</label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-input" placeholder="Zadejte nové heslo znovu">
                    <button type="button" class="toggle-password text-gray-500 hover:text-gray-900"
                            data-target="password_confirmation" aria-label="Zobrazit heslo">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-dark mt-2">Změnit heslo</button>
        </form>
    </div>

    {{-- SMAZÁNÍ ÚČTU --}}
<div class="mt-8 rounded-2xl border border-red-300 bg-white p-6 text-center shadow-sm sm:p-8">
    <h2 class="mb-2 text-xl font-semibold text-red-600">Smazání účtu</h2>
    <p class="mx-auto mb-5 max-w-md text-gray-600">
        Smazáním účtu přijdete o přístup do aplikace. Tuto akci nelze vrátit zpět.
    </p>

    <form method="POST" action="{{ route('profile.destroy') }}"
          data-confirm="Opravdu chcete trvale smazat svůj účet?"
          data-confirm-button="Smazat účet"
          class="mx-auto flex max-w-sm flex-col gap-4 text-left">
        @csrf
        @method('DELETE')

        <div>
            <label for="delete_password" class="form-label text-center">Pro potvrzení zadejte heslo</label>
            <input type="password" name="password" id="delete_password" class="form-input" placeholder="Zadejte své heslo">
            @error('password', 'deleteAccount') <span class="form-error text-center">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn-delete inline-flex items-center gap-2 self-center">
            <i class="bi bi-trash"></i> Smazat účet
        </button>
    </form>
</div>
</div>
@endsection

@section('footer')
@endsection
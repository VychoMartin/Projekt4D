<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'   => ['required', 'string', 'regex:/^(\+?[0-9\s]{9,20})$/', Rule::unique('users', 'phone')->ignore($user->id)],
        ], [
            'name.required'    => 'Vyplňte jméno.',
            'surname.required' => 'Vyplňte příjmení.',
            'email.required'   => 'Vyplňte e-mail.',
            'email.email'      => 'Zadejte platný e-mail.',
            'email.unique'     => 'Tento e-mail už používá jiný účet.',
            'phone.required'   => 'Vyplňte telefonní číslo.',
            'phone.regex'      => 'Telefonní číslo musí být ve správném formátu.',
            'phone.unique'     => 'Toto telefonní číslo už používá jiný účet.',
        ]);

        $user->update($validated);

        return back()->with('success', 'Údaje byly uloženy.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.required'         => 'Zadejte současné heslo.',
            'current_password.current_password' => 'Současné heslo není správné.',
            'password.required'                 => 'Zadejte nové heslo.',
            'password.confirmed'                => 'Hesla se neshodují.',
        ]);

        // Pokud máš v modelu casts 'password' => 'hashed', Hash::make() vynech
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success_heslo', 'Heslo bylo změněno.');
    }
}
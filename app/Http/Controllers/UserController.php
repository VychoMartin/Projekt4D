<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Seznam uživatelů (trasu zabezpeč přes role:spravce).
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Formulář registrace.
     */
    public function create()
    {
        return view('registrace');
    }

    /**
     * Uložení nového uživatele (registrace).
     */
    public function store(Request $request)
    {
        // Role zde záměrně chybí, aby ji uživatel nemohl poslat
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'surname'  => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['required', 'string', 'regex:/^(\+?[0-9\s]{9,20})$/', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ], [
            'name.required'      => 'Vyplňte jméno.',
            'surname.required'   => 'Vyplňte příjmení.',
            'password.required'  => 'Vyplňte heslo.',
            'password.min'       => 'Kratší než 8 znaků.',
            'password.confirmed' => 'Hesla se neshodují.',
            'email.required'     => 'Vyplňte e-mail.',
            'email.email'        => 'Zadejte platný e-mail.',
            'email.unique'       => 'Tento e-mail je již registrován.',
            'phone.regex'        => 'Telefonní číslo musí být ve správném formátu.',
            'phone.required'     => 'Vyplňte telefonní číslo.',
            'phone.unique'       => 'Toto telefonní číslo je již registrováno.',
        ]);

        User::create([
            'name'     => $validated['name'],
            'surname'  => $validated['surname'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user', // natvrdo pro všechny registrace
        ]);

        return redirect()
            ->route('prihlaseni')
            ->with('success', 'Registrace byla úspěšná. Nyní se můžete přihlásit.');
    }

    /**
     * Přihlášení.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Vyplňte e-mail.',
            'email.email'       => 'Zadejte platný e-mail.',
            'password.required' => 'Vyplňte heslo.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Všichni na úvodní stránku, obsah řeší HomeController podle role
            return redirect()->intended(route('home'));
        }

        return back()
            ->withErrors(['password' => 'Nesprávný e-mail nebo heslo.'])
            ->onlyInput('email');
    }

    /**
     * Odhlášení.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('prihlaseni');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registrace');
    }

    /**
     * Store a newly created resource in storage.
     */
    
public function store(Request $request)
{
    // 1. Validace vstupních dat (role zde zcela chybí, aby ji uživatel nemohl poslat)
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'phone' => ['required', 'string', 'regex:/^(\+?[0-9\s]{9,20})$/','unique:users,phone'],
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

    // 2. Vytvoření uživatele s natvrdo nastavenou rolí 'user'
    User::create([
        'name' => $validated['name'],
        'surname' => $validated['surname'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'password' => Hash::make($validated['password']), // Nezapomeňte heslo zašifrovat
        'role' => 'user', // Natvrdo nastavená role pro všechny registrace
    ]);

    return redirect()->route('prihlaseni')->with('success', 'Registrace byla úspěšná. Nyní se můžete přihlásit.');
}
public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|string',
        'password' => 'required',
    ], [
        'email.required'    => 'Vyplňte e-mail.',
        'password.required' => 'Vyplňte heslo.',
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        return match (Auth::user()->role) {
            'technik' => redirect()->route('technik.zkouska'),
            'spravce' => redirect()->route('technik.zkouska'),
            default   => redirect()->route('zkouska'),
        };
    }

    return back()
        ->withErrors(['password' => 'Nesprávný e-mail nebo heslo.'])
        ->onlyInput('email');
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('prihlaseni');
}
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}


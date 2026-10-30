<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Přihlášení je úvodní stránka
Route::get('/', fn () => view('prihlaseni'))->name('prihlaseni');
Route::post('/prihlasovani', [UserController::class, 'login'])->name('prihlasovani');

// Registrace
Route::get('/registrace', [UserController::class, 'create'])->name('registrace');
Route::post('/registrace', [UserController::class, 'store'])->name('registrace.store');

// Kontakt vidí všichni
Route::view('/contact', 'contact')->name('contact');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/heslo', [ProfileController::class, 'updatePassword'])->name('profile.heslo');


// Jen pro přihlášené
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/odhlaseni', [UserController::class, 'logout'])->name('odhlaseni');

    Route::get('/zkouska', fn () => view('zkouska'))->name('zkouska');

    // Jen technik a správce
    Route::middleware('role:spravce,technik')->group(function () {
        Route::get('/technik', fn () => view('technik.zkouska'))->name('technik.zkouska');
    });
    Route::middleware(['auth', 'role:spravce'])->group(function () {
    Route::get('/spravaUzivatelu', function () {
        return view('sprava-uzivatelu', [
            'users' => User::orderByRaw("FIELD(role, 'spravce', 'technik', 'user')")
                ->orderBy('surname')
                ->orderBy('name')
                ->get(),
        ]);
    })->name('sprava-uzivatelu');
    
    Route::delete('sprava-uzivatelu/{user}', [UserController::class, 'destroy'])
    ->name('sprava-uzivatelu.destroy');
    Route::put('/sprava-uzivatelu/{user}', [UserController::class, 'update'])->name('sprava-uzivatelu.update');
});
});
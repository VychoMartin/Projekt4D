<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
// Get route příklad
Route::get('/', function () {
    return view('prihlaseni');
})->name('prihlaseni');

//Parametry pomocí kterých se přesměruje na stránku registrace
/*Route::get('/registrace/{login}/{heslo}', function ($login, $heslo) {
    return $login . " " . $heslo;
})->name('registrace');*/
// Named route příklad
Route::get('/registrace', [UserController::class, 'create'])->name('registrace');
Route::post('/registrace', [UserController::class, 'store'])->name('registrace.store');

Route::get('/', function () {
    return view('prihlaseni');
})->name('prihlaseni');

Route::post('/prihlasovani', [UserController::class, 'login'])->name('prihlasovani');

Route::post('/odhlaseni', [UserController::class, 'logout'])->name('odhlaseni');

Route::middleware('auth')->group(function () {

    Route::get('/zkouska', fn () => view('zkouska'))
        ->name('zkouska');

    Route::middleware('role:spravce,technik')->group(function () {
        Route::get('/technik', fn () => view('technik.zkouska'))
            ->name('technik.zkouska');
    });
});

Route::get('/contact', function () {
return view('contact');
})->name('contact');
/* Route::resource('users', UserController::class); */

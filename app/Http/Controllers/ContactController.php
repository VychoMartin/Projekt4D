<?php


namespace App\Http\Controllers;

use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact', [
            'spravci'  => User::where('role', 'spravce')->orderBy('surname')->orderBy('name')->get(),
            'technici' => User::where('role', 'technik')->orderBy('surname')->orderBy('name')->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->isStaff()) {
            return view('home-staff');   
        }

        return view('home-user');        
    }
}

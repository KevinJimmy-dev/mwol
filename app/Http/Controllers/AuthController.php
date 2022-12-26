<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request)
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request)
    {
        if (!is_null(User::where('email', $request->email)->first())) {
            return redirect()->back()->withInput()->with('error', 'Este e-mail já está sendo utilizado!');
        }

        if (!is_null(User::where('nickname', $request->nickname)->first())) {
            return redirect()->back()->withInput()->with('error', 'Este apelido já está sendo utilizado!');
        }

        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);
        
        return redirect()->route('register');
    }
}

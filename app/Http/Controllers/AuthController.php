<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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

    public function login()
    {
        return view('auth.login');
    }

    public function auth(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (is_null($user) || !Hash::check($request->get('password'), $user->password)) {
            return back()->with('error', 'Falha na autenticação. Verifique o email e senha informados.');
        }

        Auth::login($user);

        return redirect()->route('register');
    }
}

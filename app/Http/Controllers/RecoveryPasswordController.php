<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Mail\MailRecoveryPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class RecoveryPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('recovery-password.forgot-password');
    }

    public function sendEmail(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (is_null($user)) {
            return redirect()->back()->with('error', 'Este e-mail não possui uma conta vinculada a ele');
        }

        $token = Uuid::uuid4();

        $user->update([
            'remember_token' => $token
        ]);

        Mail::to($user->email)->send(new MailRecoveryPassword($user, $token));

        return redirect()->route('auth.login')->with('success', 'O e-mail para redefinir sua senha, foi enviado com sucesso!');
    }

    public function recoveryPassword(Request $request)
    {
        $token = $request->get('remember_token');

        if (is_null($token)) {
            abort(404, 'Token não informado');
        }

        $user = User::where('remember_token', $token)->first();

        if (is_null($user)) {
            abort(404, 'Token inválido');
        }

        return view('recovery-password.index', ['name' => $user->name, 'email' => $user->email, 'remember_token' => $token]);
    }

    public function recovery(NewPasswordRequest $request)
    {
        User::where('remember_token', $request->remember_token)->first()->update([
            'password' => Hash::make($request->password),
            'remember_token' => null,
        ]);

        return redirect()->route('auth.login')->with('success', 'Sua senha foi redefinida com sucesso!');
    }
}

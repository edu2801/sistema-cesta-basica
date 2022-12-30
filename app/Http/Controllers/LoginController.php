<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Utils\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            User::find(Auth::id())->update([
                "remember_token" => Session::token(),
            ]);

            return Response::success([], 'Login feito com sucesso.');
        }

        return Response::error([], 'Essas credenciais não correspondem.');
    }

    public static function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if ($request->method() === 'GET'){
            return view('auth.login');
        } else {
            $credentials = $request->validate([
                'email' => 'required|string|email|',
                'password' => 'required|string'
               ]);
            if (Auth::attempt($credentials)){
                return redirect()->route('home')->with('message-sucess', 'Seja Bem Vindo ' . Auth::user()->name);
            }
            return back()->withErrors([
                'email' => 'Credenciais inválidas.',
            ])->withInput();
        }
         
    }

    public function home() {
       
        return view('welcome');
     }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('message-success', 'Você saiu com sucesso.');
    }
}

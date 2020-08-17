<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    /**
     * Vista de formulario de login
     *
     * @return Redirecy
     **/
    public function index(){
        return view('auth.login');
    }

    /**
     * Permite iniciar sesion
     *
     * @return Redirecy
     **/
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $credentials["email"], 'password' => $credentials["password"]], true)) {
            return redirect()->intended('/');
        }else{
            return redirect()->back()->withInput($credentials)->withErrors(['Los datos de acceso no coinciden.']);
        }
    }

    /**
     * Permite cerrar sesion
     *
     * @return Redirecy
     **/
    public function logout(){
        Auth::logout();
        return redirect()->to('auth');
    }
}
<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function getLogin()
    {
        $data = [
            'email' => 'miroldols@gmail.com',
            'password' => 123456
        ];

        //dd(Auth::user());
        return Auth::user();

        // attempt faz o login do usuario
        if(Auth::attempt($data)) {
            return "Logou";
        }

        // Chega se o usuario está logado
        if(Auth::check()) {
            return 'Logado';
        }

        return 'Falhou';
    }

    public function getLogout() {
        Auth::logout();

        if(Auth::check()) {
            return 'Logado';
        }

        return 'Não está logado';
    }
}

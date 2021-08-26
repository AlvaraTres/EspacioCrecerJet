<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{
    public function index(){
        return view('sessionApiRest.login');
    }

    public function store()
    {
        if(auth()->attempt(request(['email', 'password'])) == false){
            return back()->withErrors([
                'message' => 'El correo o la contraseña son incorrectos, por favor intenta otra vez'
            ]);
        }
        return redirect()->to('/reservaApiRest');
    }

    public function destroy(){
        auth()->logout();

        return redirect()->to('/');
    }
}

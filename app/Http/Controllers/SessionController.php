<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ContactusMailable;
use Illuminate\Support\Facades\Mail;

class SessionController extends Controller
{
    public function index(){
        return view('sessionApiRest.login');
    }

    public function store()
    {
        if(auth()->attempt(request(['email', 'password'])) == false){
            return response()->json(null);
        }
        return response()->json(\Auth::user());
    }

    public function destroy(){
        auth()->logout();

        return response()->json("Logout Successfully");
    }

    public function contactar(Request $request){
        $correo = new ContactusMailable($request);

        Mail::to('espaciocrecer@gmail.com')->send($correo);
            
        return "correo enviado";
    }
}

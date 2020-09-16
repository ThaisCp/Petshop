<?php

namespace PetShop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    public function home (){

        if(Auth::check() === true) {
            return view( 'site.home');
    }
        return redirect()->route('site.login');
}
    public function showLoginForm(){
        return view ('site.login');
    }

    public function login (Request $request){

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return redirect()->back()->withInput()->withErrors(['O e-mail informado não existe!']);

        }
        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if(Auth::attempt($credentials)){
            return redirect()->route('site');
        }
        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('site');
    }
}


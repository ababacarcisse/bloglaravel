<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //La fonction login
    public function login(){
return view('auth.login'); 
}
 //fonction pour l'incription
 function register(){
    return view('auth.register');
 }
}

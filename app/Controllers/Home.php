<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index(): string
    {
        return view('welcome_message');
        // return "Mujahid";
        // return view('Form');
    }
    
    public function greet($name){
        return "Hellow, " . esc($name) . "!";
    }

}   






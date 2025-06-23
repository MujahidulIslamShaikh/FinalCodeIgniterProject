<?php

namespace App\Controllers;

class GeneralController extends BaseController
{

    public function CreateProductView(){

        return view('/CreateProductView');

    }

    public function BrandView(){

        return view('brand/BrandView');

    }

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






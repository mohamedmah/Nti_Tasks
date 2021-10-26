<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //

    public function create(){
        return view('register');
    }

    public function store(Request $request){


        $this->validate($request,[

            "name"     => "required|string",
            "email"    => "required|email",
            "password" => "required|min:6",
            "address" => "required|max:10",
            "url" => "required|url",
            "gender" => "required"

        ]);

        echo 'Hello World';

    }



}

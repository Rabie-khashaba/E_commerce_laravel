<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainComtroller extends Controller
{


    public function pageSite(){
        return view('front.home');
    }

    public function showAdmin(){
        return view('layouts.admin');
    }
}

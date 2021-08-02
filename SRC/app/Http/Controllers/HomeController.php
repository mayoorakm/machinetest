<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use DB;

class HomeController extends Controller
{
    
    public function home(){
        print_r("expression");die();
        return view('home');
    }

}
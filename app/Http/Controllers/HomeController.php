<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }

    public function index()
    {
        return view('home');
    }
    
    public function home()
    {
        return view('index');
    }
}

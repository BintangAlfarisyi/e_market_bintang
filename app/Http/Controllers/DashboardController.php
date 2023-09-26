<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('templates.dashboard');
    }

    public function blog(){
        return view('templates.blog');
    }
}

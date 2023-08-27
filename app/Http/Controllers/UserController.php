<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('index')->with('title', 'Eskwela4EveryJuan');
    }
}

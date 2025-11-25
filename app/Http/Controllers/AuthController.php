<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use function Termwind\render;

class AuthController extends Controller
{
    public function create():View
    {
        return view('auth.login');
    }
}

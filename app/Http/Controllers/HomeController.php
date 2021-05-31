<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Post Authentication

        if(Auth::user()->hasAnyRole('teacher', 'student'))
        {
            return redirect()->route('classroom.index');
        }

        return view('welcome-message');
    }
}

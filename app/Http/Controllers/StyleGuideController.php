<?php

namespace App\Http\Controllers;

class StyleGuideController extends Controller
{
    public function index()
    {
        return redirect()->route('styleguide.student');
    }

    public function student()
    {
        return view('styleguide.student');
    }

    public function admin()
    {
        return view('styleguide.admin');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeBuilderController extends Controller
{
    public function index()
    {
        return view('front.user.resume_builder');
    }
}


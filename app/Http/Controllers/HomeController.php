<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //This method will shows our Home page
    public function index(){
    $categories = Category::all(); // or whatever query you need to get the categories
    $featuredJobs = Job::where('featured', true)->get();
    $latestJobs = Job::latest()->get();

    return view('your-view-name', compact('categories', 'featuredJobs', 'latestJobs'));
        return view ('front.home');
    }
}

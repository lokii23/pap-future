<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get(); // or limit with ->take(5)
        return view('welcome', compact('testimonials'));
    }
}

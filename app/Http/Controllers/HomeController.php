<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Facebook;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get(); // or limit with ->take(5)
        $posts = Facebook::latest()->take(3)->get(); // Or all posts if you want
        
        return view('welcome', compact('posts','testimonials'));
    }

}

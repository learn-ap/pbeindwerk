<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::inRandomOrder()->take(4)->get();
        return view('frontend.index', compact('featuredProducts'));
    }
}

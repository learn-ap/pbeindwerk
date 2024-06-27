<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Telt het aantal gebruikers, het aantal producten en het aantal categories en steek ze in een var, die we dan overdragen aan de blade = backend.index
        $userCount = User::count();
        $productCount = Product::count();
        $categoryCount = Category::count();

        return view('backend.index', compact('userCount', 'productCount', 'categoryCount'));
    }
}

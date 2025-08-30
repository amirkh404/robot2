<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        $products = Product::all();
        return view('home', compact('users', 'products'));
    }
}

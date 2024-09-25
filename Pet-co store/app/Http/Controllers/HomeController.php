<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\ProductController;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){ // admin landing page
            return view('dashboard');

        } else { // user landing page
            //return view('landing');
            //return ProductController::index();
            $products = Product::all(); // Assuming you have a Product model
            return view('landing', compact('products'));
        }
    }

}

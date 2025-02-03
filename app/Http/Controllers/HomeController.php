<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Check if the user is an admin
        if(auth()->user()->isAdmin()) {
            return view('dashboard');
        } else {
            // Redirect non-admin users to the landing page
            $products = Product::all(); // Assuming you have a Product model
            return view('landing', compact('products'));
        }
    }

    public function handle(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/landing'); // Redirect non-admin users
        }

        return ($request);
    }
}
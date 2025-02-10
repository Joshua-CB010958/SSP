<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Method to fetch the authenticated user's data
    public function show(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
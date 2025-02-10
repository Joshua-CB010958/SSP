<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }

    public function index()
    {
        if (request()->wantsJson()) {
            // Return products as JSON for API calls
            return response()->json(Product::all());
        }
    
        // Return the view if it's not an API call
        return view('product.index');

    }
    

    public function getProducts()
    {
        return response()->json(Product::all());
    }

    public function save(Request $req)
    {
        $path = $req->file('product_image')->store('product_images', 'public');
        $fileUrl = Storage::url($path);

        Product::create([
            'pro_name' => $req->input('product_name'),
            'pro_price' => $req->input('product_price'),
            'pro_image_url' => $fileUrl,
        ]);

        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
        ]);
    
 
        $product = Product::findOrFail($id);
    
        
        $product->pro_name = $validated['product_name'];
        $product->pro_price = $validated['product_price'];

        if ($request->hasFile('product_image')) {
       
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $product->pro_image_url = $imagePath;
        }
    
        
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete the product image from the storage
        if (Storage::exists($product->pro_image_url)) {
            Storage::delete($product->pro_image_url);
        }
        
        // Force delete the product from the database (completely remove it)
        $product->forceDelete();
        
        return response()->json(['message' => 'Product deleted successfully']);
    }
    
    
    
    
    public function count()
    {
        \Log::info('Count route accessed');
        try {
            $productCount = Product::count(); 
            return response()->json(['count' => $productCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function customerCount()
    {
        try {
            $customerCount = User::where('user_type', 0)->count();
            return response()->json(['count' => $customerCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function customerCountries()
    {
        // Fetch customers, excluding admin users (where user_type = 1)
        $customerData = DB::table('users')
            ->select('country', DB::raw('count(*) as count'))
            ->where('user_type', 0) // Exclude admins (user_type = 1)
            ->groupBy('country')
            ->get();

        return response()->json($customerData);
    }

    public function getAppProducts()
    {
        try {
            $products = Product::all();
    
            // Prepend the base URL to the image URLs without the extra "storage/" part
            $products->each(function ($product) {
                $product->pro_image_url = asset('storage/' . basename($product->pro_image_url));
            });
    
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}

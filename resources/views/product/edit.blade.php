@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1a202c; /* Dark background */
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-200">
    <div class="container mx-auto p-4" style="min-height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-lg">
            <div class="text-center mb-4">
                <h2 class="text-2xl text-white font-bold">Edit Product</h2> 
                <hr class="border-gray-600">
            </div>

            <!-- Product Image Display (Show current image) -->
            <div class="flex justify-center mb-4">
                <img src="{{ url($product->pro_image_url) }}" alt="Product Image" class="w-full max-h-64 object-contain rounded-lg shadow-lg">
            </div>

            <!-- Form Section -->
            <form action="{{ url('product/update/'.$product->id) }}" enctype="multipart/form-data" method="post" class="grid gap-4">
                @csrf

                <!-- Product Name -->
                <div>
                    <label for="product_name" class="block text-white mb-2">Product Name:</label>
                    <input type="text" name="product_name" id="product_name" class="w-full p-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{$product->pro_name}}" required>
                </div>

                <!-- Product Price -->
                <div>
                    <label for="product_price" class="block text-white mb-2">Product Price:</label>
                    <input type="number" name="product_price" id="product_price" class="w-full p-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{$product->pro_price}}" required>
                </div>

                <!-- Submit Button -->
                <input type="submit" class="w-full p-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-500 transition duration-300">
            </form>

            <!-- Go Back Button -->
            <div class="w-full text-center mt-6">
                <a href="{{ url('/home') }}" class="inline-block w-full">
                    <button class="w-full p-2 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-500 transition duration-300">
                        Go Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

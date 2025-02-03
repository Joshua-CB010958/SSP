@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            background-color: #1a202c; /* Dark background */
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-200">
    <div class="container mx-auto p-4" style="min-height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-lg">
            <div class="m-2 text-center">
                <h2 class="mb-4 text-2xl text-white font-bold">Create Products</h2> 
                <hr class="border-gray-600">
            </div>

            <!-- Form Section -->
            <div>
                <form id="product-form" class="grid gap-4" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div>
                        <label for="product_name" class="block text-white mb-2">Product Name:</label>
                        <input type="text" name="product_name" id="product_name" class="w-full p-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Product Price -->
                    <div>
                        <label for="product_price" class="block text-white mb-2">Product Price:</label>
                        <input type="number" name="product_price" id="product_price" class="w-full p-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label for="product_image" class="block text-white mb-2">Product Image:</label>
                        <input type="file" name="product_image" id="product_image" class="w-full p-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="button" id="create-product-btn" class="w-full p-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-500 transition duration-300">
                        Create Product
                    </button>
                </form>
            </div>
        </div>

        <!-- Go Back Button -->
        <div class="w-full max-w-md text-center mt-6">
            <a href="{{ url('/home') }}" class="inline-block w-full">
                <button class="w-full p-2 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-500 transition duration-300">
                    Go Back
                </button>
            </a>
        </div>
    </div>

    <script>
        document.getElementById('create-product-btn').addEventListener('click', function() {
            const form = document.getElementById('product-form');
            const formData = new FormData(form);

            axios.post('/product/save', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function(response) {
                alert('Product created successfully!');
                form.reset(); // Clear the form after successful submission
            })
            .catch(function(error) {
                console.error('There was an error creating the product:', error);

                if (error.response && error.response.data) {
                    alert('Error: ' + error.response.data.message);
                } else {
                    alert('An unknown error occurred. Please try again.');
                }
            });
        });
    </script>
</body>
</html>

@endsection

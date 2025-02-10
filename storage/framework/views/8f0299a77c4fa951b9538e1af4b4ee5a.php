

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-gray-200 p-4 shadow-md mt-5">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-center w-full">Store Page</h1>
            <a href="<?php echo e(url('/cart')); ?>" id="cart-btn" class="relative flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                Cart 
                <span id="cart-count" class="ml-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">0</span>
            </a>
        </div>
    </header>


    <div class="container mx-auto py-20">
        <main class="w-full">
            <div class="flex justify-between mb-4">
                <h2 class="font-bold text-lg">Products</h2>
            </div>
            <div id="loading" class="text-center text-gray-600">Loading products...</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="product-container">

            </div>
        </main>
    </div>

   
    <footer class="bg-gray-800 p-6 text-gray-400 mt-20">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo and Description -->
            <div class="flex flex-col items-center md:items-start">
                <img src="<?php echo e(asset('Images/AnimalCarePet.png')); ?>" alt="Animal Care Pet Logo" class="w-20 h-20 mb-4">
                <p class="text-center md:text-left">
                    At PET-CO, we're passionate about pets! Our mission is to provide the highest quality products, food, and care essentials to keep your furry, feathered, and scaly friends happy and healthy. With a wide selection of toys, accessories, and premium nutrition, we cater to all kinds of pets, from dogs and cats to birds, reptiles, and small animals.
                </p>
            </div>

            <!-- Solutions Section -->
            <div class="flex flex-col items-center md:items-start">
                <h3 class="text-white font-bold mb-2">SOLUTIONS</h3>
                <ul class="space-y-2">
                    <li>Marketing</li>
                    <li>Analytics</li>
                    <li>Commerce</li>
                    <li>Insights</li>
                </ul>
            </div>

            <!-- Support Section -->
            <div class="flex flex-col items-center md:items-start">
                <h3 class="text-white font-bold mb-2">SUPPORT</h3>
                <ul class="space-y-2">
                    <li>Pricing</li>
                    <li>Guides</li>
                    <li>API Status</li>
                </ul>
            </div>
        </div>

      
        <p class="text-center mt-8 text-gray-500">© PET-CO - All Rights Reserved</p>
    </footer>

    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.addEventListener('DOMContentLoaded', function () {
            const productContainer = document.getElementById('product-container');
            const loading = document.getElementById('loading');
            const cartCountEl = document.getElementById('cart-count');

            function fetchProducts() {
                axios.get('/api/products')
                    .then(response => {
                        const products = response.data;
                        productContainer.innerHTML = '';
                        loading.style.display = 'none';

                        products.forEach(product => {
                            productContainer.innerHTML += `
                                <div class="bg-white p-4 shadow-md rounded-lg">
                                    <div class="w-full h-48 overflow-hidden mb-4">
                                        <img src="${product.pro_image_url}" alt="${product.pro_name}" class="w-full h-full object-contain">
                                    </div>
                                    <h3 class="font-bold text-lg mb-2">${product.pro_name}</h3>
                                    <p class="text-blue-500 text-xl font-bold">Rs.${product.pro_price}</p>
                                    <button class="add-to-cart bg-blue-500 text-white py-2 px-4 w-full rounded-md hover:bg-blue-600" 
                                        data-id="${product.id}" 
                                        data-name="${product.pro_name}" 
                                        data-price="${product.pro_price}" 
                                        data-image="${product.pro_image_url}">
                                        Add to cart
                                    </button>
                                </div>
                            `;
                        });

                        
                        attachCartListeners();
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                        loading.innerHTML = '<p class="text-red-500">No products available.</p>';
                    });
            }

            function attachCartListeners() {
                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function () {
                        const product = {
                            id: this.getAttribute('data-id'),
                            name: this.getAttribute('data-name'),
                            price: this.getAttribute('data-price'),
                            image: this.getAttribute('data-image'),
                            quantity: 1
                        };
                        addToCart(product);
                    });
                });
            }

            function addToCart(product) {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const existingProduct = cart.find(item => item.id === product.id);

                if (existingProduct) {
                    existingProduct.quantity += 1;
                } else {
                    cart.push(product);
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
            }

            function updateCartCount() {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cartCountEl.innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
            }

            
            updateCartCount();

            
            fetchProducts();
        });
    </script>

</body>
</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\josh2\Desktop\SSP II\PetCo\PetCo\resources\views/landing.blade.php ENDPATH**/ ?>
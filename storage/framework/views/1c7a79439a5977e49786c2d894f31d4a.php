<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-gray-200 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Shopping Cart</h1>
            <a href="<?php echo e(url('/home')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Back to Store
            </a>
        </div>
    </header>

    <!-- Cart Content -->
    <div class="container mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

        <div id="cart-container" class="bg-white p-6 rounded-lg shadow-md">
            <div id="cart-items">
                <p class="text-gray-600">Your cart is empty.</p>
            </div>

            <!-- Total Price & Checkout Button -->
            <div class="mt-6 border-t pt-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Total: <span id="cart-total" class="text-blue-500">Rs. 0.00</span></h3>
                <button id="checkout-btn" class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 hidden">
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 p-6 text-gray-400 mt-20">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center md:items-start">
                <img src="<?php echo e(asset('Images/AnimalCarePet.png')); ?>" alt="Animal Care Pet Logo" class="w-20 h-20 mb-4">
                <p class="text-center md:text-left">
                    At PET-CO, we're passionate about pets! Our mission is to provide the highest quality products, food, and care essentials to keep your furry, feathered, and scaly friends happy and healthy.
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
        document.addEventListener('DOMContentLoaded', function () {
            const cartContainer = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');

            function loadCart() {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cartContainer.innerHTML = '';

                if (cart.length === 0) {
                    cartContainer.innerHTML = '<p class="text-gray-600">Your cart is empty.</p>';
                    cartTotal.innerText = 'Rs. 0.00';
                    checkoutBtn.classList.add('hidden');
                    return;
                }

                let total = 0;

                cart.forEach((item, index) => {
                    total += item.price * item.quantity;

                    cartContainer.innerHTML += `
                        <div class="flex justify-between items-center border-b py-4">
                            <div class="flex items-center">
                                <img src="${item.image}" class="w-16 h-16 object-cover rounded mr-4">
                                <div>
                                    <h3 class="font-bold">${item.name}</h3>
                                    <p class="text-gray-600">Rs. ${item.price}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button class="decrease-qty bg-gray-300 text-gray-700 px-2 rounded-md mr-2" data-index="${index}">-</button>
                                <span class="text-lg font-bold">${item.quantity}</span>
                                <button class="increase-qty bg-gray-300 text-gray-700 px-2 rounded-md ml-2" data-index="${index}">+</button>
                            </div>
                            <button class="remove-item bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" data-index="${index}">
                                Remove
                            </button>
                        </div>
                    `;
                });

                cartTotal.innerText = `Rs. ${total.toFixed(2)}`;
                checkoutBtn.classList.remove('hidden');

                attachCartListeners();
            }

            function attachCartListeners() {
                document.querySelectorAll('.increase-qty').forEach(button => {
                    button.addEventListener('click', function () {
                        let cart = JSON.parse(localStorage.getItem('cart')) || [];
                        cart[this.dataset.index].quantity += 1;
                        localStorage.setItem('cart', JSON.stringify(cart));
                        loadCart();
                    });
                });

                document.querySelectorAll('.decrease-qty').forEach(button => {
                    button.addEventListener('click', function () {
                        let cart = JSON.parse(localStorage.getItem('cart')) || [];
                        if (cart[this.dataset.index].quantity > 1) {
                            cart[this.dataset.index].quantity -= 1;
                        } else {
                            cart.splice(this.dataset.index, 1);
                        }
                        localStorage.setItem('cart', JSON.stringify(cart));
                        loadCart();
                    });
                });

                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function () {
                        let cart = JSON.parse(localStorage.getItem('cart')) || [];
                        cart.splice(this.dataset.index, 1);
                        localStorage.setItem('cart', JSON.stringify(cart));
                        loadCart();
                    });
                });
            }

            checkoutBtn.addEventListener('click', function () {
                alert("Checkout is not implemented as a payment gateway is needed!!!");
            });

            loadCart();
        });
    </script>

</body>
</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Desktop folder\Uni coursework\Year 2\Sem 2\SSP II\PetCo\PetCo\resources\views\cart.blade.php ENDPATH**/ ?>
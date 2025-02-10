<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body class="bg-gray-900 text-gray-200 font-sans">
    <!-- Navbar or Top Bar -->
    <div class="bg-gray-800 p-4 flex justify-between items-center">
        <h1 class="text-lg font-bold text-white">PET-CO</h1>
        <div class="flex items-center space-x-4">
            <p class="text-sm"></p>
            <img src="<?php echo e(asset('Images/ADMIN icon.png')); ?>" class="w-8 h-8 rounded-full" alt="User Avatar">
            <ul class="flex items-center space-x-4">
                <!-- Authentication Links -->
                <!-- Check if the user is logged in -->
                <?php if(auth()->guard()->guest()): ?>
                    <?php if(Route::has('login')): ?>
                        <li>
                            <a class="text-white hover:text-blue-500" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(Route::has('register')): ?>
                        <li>
                            <a class="text-white hover:text-blue-500" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="relative">
                        <button id="dropdownButton" class="text-white hover:text-blue-500 cursor-pointer focus:outline-none" onclick="toggleDropdown()">
                            <?php echo e(Auth::user()->name); ?>

                        </button>
                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden">
                            <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Content -->
    <main class="py-0">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- JavaScript to toggle dropdown -->
    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden'); // Toggles the hidden class
        }

        // Optional: Close the dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('#dropdownButton')) {
                const dropdowns = document.getElementsByClassName("absolute");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('hidden')) {
                        openDropdown.classList.add('hidden');
                    }
                }
            }
        }
    </script>
</body>
</html><?php /**PATH C:\Users\josh2\Desktop\SSP II\PetCo\PetCo\resources\views\layouts\manage.blade.php ENDPATH**/ ?>
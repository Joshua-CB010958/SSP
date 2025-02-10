<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Pet-Co')); ?></title>
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--<?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>-->
     <?php echo $__env->yieldContent('js'); ?>
    <!--Extra-->
    

</head>
<body>
    <div id="landing">
    <nav class="bg-white shadow-sm">
    <div class="container mx-auto flex justify-between items-center py-4">
        <!-- Brand Logo -->
        <a class="text-xl font-bold text-gray-800" href="<?php echo e(url('/home')); ?>">
            Pet-Co
        </a>

        <!-- Hamburger Menu for Mobile View -->
        <div class="md:hidden">
            <button class="text-gray-600 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-6" id="navbarSupportedContent">
        
            <ul class="flex items-center space-x-4">
             
                <?php if(auth()->guard()->guest()): ?>
                    <li>
                        <a class="text-gray-800 hover:text-blue-500" href="#">Store</a>
                    </li>
                    <li>
                        <a class="text-gray-800 hover:text-blue-500" href="<?php echo e(url('/home')); ?>">About us</a>
                    </li>
                    <img src="<?php echo e(asset('Images/GUEST icon.png')); ?>" class="w-8 h-8 rounded-full" alt="User Avatar">
                    <?php if(Route::has('login')): ?>
                        <li>
                            <a class="text-gray-800 hover:text-blue-500" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(Route::has('register')): ?>
                        <li>
                            <a class="text-gray-800 hover:text-blue-500" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                <li>
                        <a class="text-gray-800 hover:text-blue-500" href="#">Store</a>
                    </li>
                    <li>
                        <a class="text-gray-800 hover:text-blue-500" href="<?php echo e(url('/home')); ?>">About us</a>
                    </li>
                    <img src="<?php echo e(asset('Images/USER icon.png')); ?>" class="w-8 h-8 rounded-full" alt="User Avatar">
                    <li class="relative">
                        <button id="dropdownButton" class="text-gray-800 hover:text-blue-500 cursor-pointer focus:outline-none" onclick="toggleDropdown()">
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
</nav>


<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
        <main class="py-0">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\Users\josh2\Desktop\SSP II\PetCo\PetCo\resources\views\layouts\landing.blade.php ENDPATH**/ ?>
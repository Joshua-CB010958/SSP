<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        
        <div class="h-screen w-1/2 bg-cover bg-center" style="background-image: url('<?php echo e(asset('Images/loginbackgroundimage.jpg')); ?>');">
            <span class="sr-only">Friendly pet image</span>
        </div>

        <div class="w-1/2 flex flex-col justify-center items-center bg-white">
            <div class="w-full max-w-md bg-white p-8 rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="<?php echo e(asset('Images/AnimalCarePet.png')); ?>" alt="Animal Care Pet Logo" class="w-20 h-20">
                </div>
                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Log in to your account</h2>

                <?php if($errors->any()): ?>
                    <div class="mb-4 text-red-500 text-sm">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="login-form" method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    
                    <div>
                        <input id="email" type="email" name="email" required autofocus placeholder="Enter Email Address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <input id="password" type="password" name="password" required placeholder="Enter Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                            <span class="ml-2 text-gray-700">Remember Me</span>
                        </label>
                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-indigo-500 hover:underline">Forgot Password?</a>
                        <?php endif; ?>
                    </div>

                    <div>
                        <button type="submit" id="login-button" class="w-full bg-black text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                            Log In
                        </button>
                    </div>
                </form>

                <!-- Footer Section -->
                <div class="text-center mt-6">
                    <p class="text-gray-600">Need an account? <a href="<?php echo e(route('register')); ?>" class="text-indigo-600 hover:underline">Register</a></p>
                </div>
                <div class="text-center mt-4 text-gray-400">
                    © 2024 PET-CO - All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Desktop folder\Uni coursework\Year 2\Sem 2\SSP II\PetCo\PetCo\resources\views\auth\login.blade.php ENDPATH**/ ?>
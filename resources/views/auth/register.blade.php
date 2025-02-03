<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('Images/loginbackgroundimage.jpg') }}');">
            <span class="sr-only">Friendly pet image</span>
        </div>

        <div class="w-1/2 flex flex-col justify-center items-center bg-white p-8">
            <div class="w-full max-w-md bg-white p-8 rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('Images/AnimalCarePet.png') }}" alt="Animal Care Pet Logo" class="w-20 h-20">
                </div>

                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Create a New Account</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" placeholder="Enter Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" placeholder="Enter Email Address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="country" value="{{ __('Country') }}" />
                        <select id="country" name="country" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            <option value="" disabled selected>Select your country</option>
                            <option value="United States">United States</option>
                            <option value="Canada">Canada</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Australia">Australia</option>
                            <option value="India">India</option>
                        </select>
                    </div>


                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" placeholder="Enter Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"/>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div>
                        <button type="submit" class="w-full bg-black text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200 mt-6">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a></p>
                </div>

                <div class="text-center mt-4 text-gray-400">
                    © 2024 PET-CO - All Rights Reserved.
                </div>
            </div>
        </div>
    </div>

</body>
</html>

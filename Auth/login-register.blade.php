// resources/views/auth/login-register.blade.php


<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>შესვლა / რეგისტრაცია</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
    <!-- Toggle Buttons -->
    <div class="flex justify-around mb-6">
        <button id="showLogin" class="text-sm font-bold uppercase text-gray-700 hover:text-blue-600">შესვლა</button>
        <button id="showRegister" class="text-sm font-bold uppercase text-gray-700 hover:text-blue-600">რეგისტრაცია</button>
    </div>

    {{-- Login Form --}}
    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4 transition-all duration-300">
        @csrf
        <input type="email" name="email" placeholder="ელფოსტა"
               value="{{ old('email') }}"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="password" name="password" placeholder="პაროლი"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('password')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <a href="{{ route('password.email') }}"><p class="text-blue-500 text-sm">დაგავიწყდა პაროლი?</p></a>

        <button type="submit"
                class="w-full bg-gray-900 text-white py-2 rounded-md uppercase font-semibold hover:bg-pink-500 transition duration-300 tracking-wider">
            შესვლა
        </button>
    </form>

    {{-- Register Form --}}
    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4 transition-all duration-300 hidden">
        @csrf
        <input type="text" name="name" placeholder="სახელი"
               value="{{ old('name') }}"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="email" name="email" placeholder="ელფოსტა"
               value="{{ old('email') }}"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="password" name="password" placeholder="პაროლი"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('password')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="password" name="password_confirmation" placeholder="გაიმეორე პაროლი"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>

        <button type="submit"
                class="w-full bg-gray-900 text-white py-2 rounded-md uppercase font-semibold hover:bg-pink-500 transition duration-300 tracking-wider">
            რეგისტრაცია
        </button>
    </form>
</div>

<script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const showLogin = document.getElementById('showLogin');
    const showRegister = document.getElementById('showRegister');

    showLogin.addEventListener('click', () => {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    });

    showRegister.addEventListener('click', () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
    });
</script>
</body>
</html>

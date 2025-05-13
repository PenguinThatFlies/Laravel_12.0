// resources/views/auth/reset-password.blade.php

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>პაროლის განახლება</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">პაროლის განახლება</h2>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" placeholder="ელფოსტა"
               value="{{ old('email') }}"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="password" name="password" placeholder="ახალი პაროლი"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>
        @error('password')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <input type="password" name="password_confirmation" placeholder="გაიმეორე პაროლი"
               class="w-full p-3 border border-gray-200 rounded-md focus:outline-none focus:border-gray-700 text-gray-800 placeholder-gray-400" required>

        <button type="submit"
                class="w-full bg-gray-900 text-white py-2 rounded-md uppercase font-semibold hover:bg-pink-500 transition duration-300 tracking-wider">
            განახლება
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">დაბრუნება შესვლის გვერდზე</a>
    </div>
</div>

</body>
</html>

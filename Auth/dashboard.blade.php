// resources/views/dashboard.blade.php

<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>მთავარი გვერდი</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md text-center">
    <h2 class="text-3xl font-bold mb-4 text-gray-800">მთავარი გვერდი</h2>

    <p class="text-lg text-gray-600 mb-6">მოგესალმებით, <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span></p>

    <form method="POST" action="{{ route('logout') }}" class="space-y-4">
        @csrf
        <button type="submit"
                class="w-full bg-red-600 text-white py-2 rounded-md uppercase font-semibold hover:bg-red-700 transition duration-300 tracking-wider">
            გამოსვლა
        </button>
    </form>
</div>

</body>
</html>

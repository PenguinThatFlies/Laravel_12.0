<x-layout>
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-xl font-bold mb-4">პროდუქტის დამატება</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block">სახელი</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border px-3 py-2 rounded" required>
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block">ფასი</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                       class="w-full border px-3 py-2 rounded" required>
                @error('price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block">სურათი</label>
                <input type="file" name="image" class="w-full">
                @error('image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">დამატება</button>
        </form>
    </div>
</x-layout>

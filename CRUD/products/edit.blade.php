<x-layout>
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-xl font-bold mb-4">პროდუქტის რედაქტირება</h1>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block">სახელი</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="w-full border px-3 py-2 rounded" required>
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block">ფასი</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       class="w-full border px-3 py-2 rounded" required>
                @error('price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block">სურათი</label>
                <input type="file" name="image" class="w-full">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="h-16 mt-2">
                @endif
                @error('image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">განახლება</button>
        </form>
    </div>
</x-layout>

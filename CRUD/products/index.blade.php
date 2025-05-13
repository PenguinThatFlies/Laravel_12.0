<x-layout>
    <div class="max-w-5xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">პროდუქტების სია</h1>

        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('products.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">პროდუქტის დამატება</a>

            <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="ძებნა სახელი"
                       class="border px-3 py-2 rounded" />
                <button type="submit"
                        class="bg-gray-500 text-white px-4 py-2 rounded">ძებნა</button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full border border-gray-300 text-sm">
            <thead>
            <tr class="bg-gray-100">
                <x-th-sortable label="სახელი" field="name" />
                <x-th-sortable label="ფასი" field="price" />
                <th class="p-2 border">სურათი</th>
                <th class="p-2 border">მოქმედება</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr class="border-t">
                    <td class="p-2">{{ $product->name }}</td>
                    <td class="p-2">{{ $product->price }} ₾</td>
                    <td class="p-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="h-16 w-16 object-cover">
                        @endif
                    </td>
                    <td class="p-2">
                        <a href="{{ route('products.edit', $product) }}"
                           class="text-blue-500">რედაქტირება</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2"
                                    onclick="return confirm('დარწმუნებული ხარ?')">წაშლა</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-4 text-center text-gray-500">პროდუქტები ვერ მოიძებნა</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-layout>

<x-guest-layout>
    <h1 class="dark:text-white text-2xl">Products</h1>
    @isset($products)
        @foreach ($products as $product)
        <div class="w-full dark:bg-gray-700 hover:bg-gray-500 dark:text-white rounded overflow-hidden mb-8">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2 hover:text-gray-400"> <a href="{{ route('products.show', $product->id) }}">{{ $product->name ?? '' }}</a></div>
              <p class="text-gray-700 dark:text-white text-base">
                {{ $product->description ?? '' }}
              </p>
            </div>
            <div class="px-6 pt-4 pb-2">
              {{-- Tags and categories would go here --}}
            </div>
        </div>
        @endforeach
    @else
        <div class="text-base">Oops! There seems to be no products at the moment. Check back later.</div>
    @endisset
</x-guest-layout>
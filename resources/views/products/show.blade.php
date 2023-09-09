<x-guest-layout>
    <h1 class="dark:text-white text-2xl">Product</h1>
    @isset($product)
        <div class="w-full dark:bg-gray-700 hover:bg-gray-500 dark:text-white rounded overflow-hidden mb-8">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2 hover:text-gray-400"> <a href="{{ route('products.show', $product->id) }}">{{ $product->name ?? '' }}</a></div>
              <p class="text-gray-700 dark:text-white text-base">
                {{ $product->description ?? '' }}
              </p>
              <div class="flex">
                  <div class="text-gray-700 bg-gray-300 rounded-full p-3 text-base my-3">
                    Price: USD {{ $product->price ?? '' }}
                  </div>
                  <div class="text-gray-700 bg-gray-300 rounded-full p-3 text-base my-3">
                    In-stock: {{ $product->stock ?? '' }}
                  </div>
              </div>
            </div>
            <div class="px-6 pt-4 pb-2">
              {{-- Tags and categories would go here --}}
            </div>
        </div>

        <div class="flex">
          <a href="{{ route('products.index') }}"><x-primary-button class="mx-2"> Go back </x-primary-button></a>
          <a href="{{ route('products.index') }}"><x-primary-button class="mx-2" disabled> Add to cart </x-primary-button></a>
          @auth
            @can('edit-product')
              <a href="{{ route('products.edit', $product->id) }}"><x-primary-button class="mx-2"> Edit </x-primary-button></a>
            @endcan
            @can('delete-product')
              <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button class="mx-2"> Delete </x-primary-button>
              </form>
            @endcan
          @endauth
        </div>
    @else
        <div class="text-base">Oops! There seems to be no product specified. Try again please.</div>
    @endisset
</x-guest-layout>
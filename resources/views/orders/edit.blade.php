<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit an order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @isset($order)
                        <form method="POST" action="{{ route('orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')
                            {{-- Customer --}}
                            <div class="mt-4">
                                <x-input-label for="customer_id" :value="__('Customer')" />
                    
                                <select name="customer_id" id="customer_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option selected>Select a customer</option>
                                    @isset($customers)
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ $order->customer_id === $customer->id ? 'selected' : '' }}>{{ $customer->first_name ?? '' }} {{ $customer->last_name ?? '' }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                    
                                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                            </div>
                    
                            <!-- Shipping date -->
                            <div class="mt-4">
                                <x-input-label for="shipping_due_date" :value="__('Shipping due date')" />             
                                <input type="date" name="shipping_due_date" id="shipping_due_date" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ $order->shipping_due_date }}">
                                <x-input-error :messages="$errors->get('shipping_due_date')" class="mt-2" />
                            </div>

                            <!-- Shipping address -->
                            <div class="mt-4">
                                <x-input-label for="shipping_address" :value="__('Shipping address (optional)')" />
                                <x-textarea-input name="shipping_address" class="block mt-1 w-full">{{ $order->shipping_address ?? '' }}</x-textarea-input>
                                <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                            </div>
                    
                        
                    
                            <!-- Delivery method -->
                            <div class="mt-4">
                                <x-input-label for="delivery_method" :value="__('Delivery method')" />
                    
                                <select name="delivery_method" id="delivery_method" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'">
                                    <option value="pickup" {{ $order->delivery_method == 'pickup' ? 'selected':'' }}>Pick up</option>
                                    <option value="delivery" {{ $order->delivery_method == 'delivery' ? 'selected':'' }}>Door delivery</option>
                                </select>
                    
                                <x-input-error :messages="$errors->get('delivery_method')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="products" :value="__('Products')" />
                                <table class="block mt-4 table-auto border border-collapse">
                                    <thead>
                                        <tr class="border border-collapse border-grey-500">
                                            <th class="border border-collapse border-grey-500">Select</th>
                                            <th class="border border-collapse border-grey-500">Product name</th>
                                            <th class="border border-collapse border-grey-500">Product quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($products)
                                            @foreach ($products as $product)
                                                <tr class="border border-collapse border-grey-500">
                                                    <td class="border border-collapse border-grey-500">
                                                        <input type="checkbox" value="{{ $product->id }}" name='products[{{ $loop->index }}][id]' id="{{ $product->id }}" {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="border border-collapse border-grey-500">{{ $product->name }}</td>
                                                    <td class="border border-collapse border-grey-500">
                                                        <x-text-input type="number" name="products[{{ $loop->index }}][quantity]" :value="$order->products->where('id', $product->id)->first()?->pivot->quantity"></x-text-input>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                    
                            <div class="flex items-center justify-end mt-4">
                                
                                <x-primary-button class="ml-4">
                                    {{ __('Update order') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endisset
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

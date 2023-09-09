<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf
                
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input name="description" class="block mt-1 w-full"></x-textarea-input>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                
                        <!-- Price -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                
                            <x-text-input id="price" class="block mt-1 w-full"
                                            type="number"
                                            name="price"
                                            required autocomplete="" />
                
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- In stock -->
                        <div class="mt-4">
                            <x-input-label for="stock" :value="__('Stock')" />
                
                            <x-text-input id="stock" class="block mt-1 w-full"
                                            type="number"
                                            name="stock"
                                            required autocomplete="" />
                
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                
                        <!-- Publish status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Publish status')" />
                
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'">
                                <option value="draft" selected>Draft</option>
                                <option value="published">Published</option>
                            </select>
                
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            
                            <x-primary-button class="ml-4">
                                {{ __('Create product') }}
                            </x-primary-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

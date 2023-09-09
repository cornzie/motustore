<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                
                        <!-- First name -->
                        <div>
                            <x-input-label for="first_name" :value="__('First name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last name -->
                        <div>
                            <x-input-label for="last_name" :value="__('Last name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone_number" :value="__('Phone number')" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="phone_number" name="phone_number" :value="old('phone_number')" required autocomplete="phone_number" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                
                        <!-- Address 1 -->
                        <div>
                            <x-input-label for="address_1" :value="__('Street Address')" />
                            <x-text-input id="address_1" class="block mt-1 w-full" type="text" name="address_1" :value="old('address_1')" required autocomplete="address_1" />
                            <x-input-error :messages="$errors->get('address_1')" class="mt-2" />
                        </div>

                        <!-- Address 2 -->
                        <div>
                            <x-input-label for="address_2" :value="__('Address line 2 (optional)')" />
                            <x-text-input id="address_2" class="block mt-1 w-full" type="text" name="address_2" :value="old('address_2')" autocomplete="address_2" />
                            <x-input-error :messages="$errors->get('address_2')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div>
                            <x-input-label for="city" :value="__('City (optional)')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autocomplete="city" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Region -->
                        <div>
                            <x-input-label for="region" :value="__('State/Region (optional)')" />
                            <x-text-input id="region" class="block mt-1 w-full" type="text" name="region" :value="old('region')" autocomplete="region" />
                            <x-input-error :messages="$errors->get('region')" class="mt-2" />
                        </div>

                        {{-- TODO: Use a dropdown of country codes --}}
                        <!-- Country -->
                        <div>
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required autocomplete="country" />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            
                            <x-primary-button class="ml-4">
                                {{ __('Create customer') }}
                            </x-primary-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="my-4">
                        @can('create-customer')
                            <a href="{{ route('customers.create') }}"><x-primary-button>Create a customer</x-primary-button></a>
                        @endcan
                    </div>
                    <table class="table-auto border-collapse border border-slate-500">
                        <thead>
                            <tr>
                                <th class="border border-slate-500">First name</th>
                                <th class="border border-slate-500">Last name</th>
                                <th class="border border-slate-500">Email</th>
                                <th class="border border-slate-500">Phone number</th>
                                <th class="border border-slate-500">Address</th>
                                <th class="border border-slate-500">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($customers)
                                @foreach ($customers as $customer)
                                    <tr class="border border-slate-500">
                                        <td class="border border-slate-500"><a href="{{ route('customers.show', $customer->id) }}">{{ $customer->first_name ?? '' }}</a></td>
                                        <td class="border border-slate-500">{{ $customer->last_name ?? '' }}</td>
                                        <td class="border border-slate-500">{{ $customer->email ?? '' }}</td>
                                        <td class="border border-slate-500">{{ $customer->phone_number ?? '' }}</td>
                                        <td class="border border-slate-500">
                                            {{ $customer->address_1 ?? '' }} <br>
                                            {{ $customer->address_2 ?? '' }} <br>
                                            {{ $customer->city ?? '' }} <br>
                                            {{ $customer->region ?? '' }} <br>
                                            {{ $customer->country ?? '' }}
                                        </td>
                                        <td>
                                            @can('view-customer-detail')
                                                <a href="{{ route('customers.show', $customer->id) }}"><x-primary-button>View details</x-primary-button></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
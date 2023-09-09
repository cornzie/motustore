<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Viewing a customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table-auto border-collapse border border-slate-500">
                        <thead>
                            <tr>
                                <td class="border border-slate-500">First name</td>
                                <td class="border border-slate-500">Last name</td>
                                <td class="border border-slate-500">Email</td>
                                <td class="border border-slate-500">Phone number</td>
                                <td class="border border-slate-500">Address</td>
                                <td class="border border-slate-500">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($customer)
                                    <tr>
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
                                        <td class="border border-slate-500">
                                            @can('edit-customer')
                                                <a href="{{ route('customers.edit', $customer->id) }}">
                                                    <x-primary-button>Edit</x-primary-button>
                                                </a>
                                            @endcan
                                            @can('delete-customer')
                                                <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button>Delete</x-danger-button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
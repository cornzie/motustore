<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="my-4">
                        @can('create-order')
                            <a href="{{ route('orders.create') }}"><x-primary-button>Create an order</x-primary-button></a>
                        @endcan
                    </div>
                    <table class="table-auto border-collapse border border-slate-500">
                        <thead>
                            <tr>
                                <th class="border border-slate-500">Order #</th>
                                <th class="border border-slate-500">Customer name</th>
                                <th class="border border-slate-500">Shipping date</th>
                                <th class="border border-slate-500">Shipping adress</th>
                                <th class="border border-slate-500">Delivery method</th>
                                <th class="border border-slate-500">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($orders)
                                @foreach ($orders as $order)
                                    <tr class="border border-slate-500">
                                        <td class="border border-slate-500"><a href="{{ route('orders.show', $order->id) }}">#{{ $order->id ?? '' }}</a></td>
                                        <td class="border border-slate-500">{{ $order->customer->first_name ?? '' }} {{ $order->customer->last_name ?? '' }}</td>
                                        <td class="border border-slate-500">{{ $order->shipping_due_date ?? '' }}</td>
                                        <td class="border border-slate-500">{{ $order->shipping_address ?? '' }}</td>
                                        <td class="border border-slate-500">
                                            {{ $order->delivery_method ?? '' }}
                                        </td>
                                        <td>
                                            @can('view-order-detail')
                                                <a href="{{ route('orders.show', $order->id) }}"><x-primary-button>View details</x-primary-button></a>
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
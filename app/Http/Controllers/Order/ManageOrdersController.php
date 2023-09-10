<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Actions\CreateOrder;
use App\Actions\UpdateOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class ManageOrdersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create', [
            'products' => Product::paginate(100),
            'customers'=>Customer::paginate(100),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request, CreateOrder $createOrder)
    {
        $request->validated();
        $createOrder($request->all());
        return back()->with('success', 'Order created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order'=>$order,
            'products'=>Product::paginate(100),
            'customers'=>Customer::paginate(100),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order, UpdateOrder $updateOrder)
    {
        $request->validated();
        $updateOrder($request->except('_token', '_method'), $order);
        return back()->with('success', 'Order created successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect(route('orders.index'))->with('success', 'Order was deleted successfully!');
    }
}
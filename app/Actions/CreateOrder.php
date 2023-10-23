<?php

namespace App\Actions;

use App\Models\Order;
use App\Actions\Contracts\Actions;
use Illuminate\Support\Facades\Log;

class CreateOrder implements Actions
{
    public function __invoke(array $data)
    {
        try {
            // Create order
            $order =  Order::create([
                'customer_id' => $data['customer_id'] ?? null,
                'shipping_due_date' => $data['shipping_due_date'] ?? null,
                'shipping_address' => $data['shipping_address'] ?? null,
                'delivery_method' => $data['delivery_method'] ?? null,
            ]);

            // Create product order pivot
            foreach($data['products'] as $product)
            {
                if(isset($product['id']) && isset($product['quantity']))
                {
                    $order->products()->attach([
                        $product['id'] => ['quantity' => $product['quantity']]
                    ]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;

            Log::debug('Create order failed', [
                'Exception' => $th
            ]);

            return back()->withErrors('Create order failed');
        }

    }
}
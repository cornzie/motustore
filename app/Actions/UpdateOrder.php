<?php

namespace App\Actions;

use App\Models\Order;
use App\Actions\Contracts\Actions;
use Illuminate\Support\Facades\Log;

class UpdateOrder implements Actions
{
    public function __invoke(array $data, Order $order = null)
    {
        try {
            

            foreach($data as $key => $value)
            {
                if($key !== 'products')
                {
                    $order->$key = $value;

                }
            }
    
            $order->save();

            $productsToSync = [];

            // Create product order pivot
            foreach($data['products'] as $product)
            {
                

                if(isset($product['id']) && isset($product['quantity']))
                {

                    $productsToSync[$product['id']] = ['quantity' => $product['quantity']];
                    
                }
            }

            $order->products()->sync($productsToSync);
            
        } catch (\Throwable $th) {
            //throw $th;

            Log::debug('Create order failed', [
                'Exception' => $th
            ]);

            return back()->withErrors('Create order failed');
        }


    }
}
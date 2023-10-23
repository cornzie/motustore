<?php

namespace App\Actions;

use App\Models\Product;
use App\Services\CurrencyService;
use App\Actions\Contracts\Actions;
use Illuminate\Support\Facades\Log;

class UpdateProduct implements Actions
{
    public function __invoke(array $data, Product $product = null)
    {
        try {
            foreach($data as $key => $value)
            {
                switch ($key) {
                    case 'price':
                        $product->$key = (new CurrencyService($value))->getSubUnitAmount();
                        break;
    
                    default:
                        $product->$key = $value;
                        break;
                }
                
            }
    
            $product->save();

            return $product;
            
        } catch (\Throwable $th) {

            Log::debug('Update product Failed', [
                'exception' => $th
            ]);

            return back()->withErrors('An error occured while updating product!');
        }

    }
}
<?php

namespace App\Actions;

use App\Models\Customer;
use App\Actions\Contracts\Actions;
use Illuminate\Support\Facades\Log;

class UpdateCustomer implements Actions
{
    public function __invoke(array $data, Customer $customer = null)
    {
        try {
            foreach($data as $key => $value)
            {
                $customer->$key = $value;
            }
    
            $customer->save();

            return $customer;
            
        } catch (\Throwable $th) {

            Log::debug('Update customer failed', [
                'exception' => $th
            ]);

            return back()->withErrors('An error occured while updating customer!');
        }
    }
}
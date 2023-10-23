<?php

namespace App\Actions;

use App\Models\Customer;
use App\Actions\Contracts\Actions;
use Illuminate\Support\Facades\Log;

class CreateCustomer implements Actions
{
    public function __invoke(array $data)
    {
        try {
            return Customer::create($data);
        } catch (\Throwable $th) {
            
            Log::debug('Create customer action failed', [
                'Exception' => $th
            ]);

            return back()->withErrors('Something went wrong while creating this customer.');
        }
    }
}
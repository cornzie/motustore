<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Services\CurrencyService;
use App\Actions\Contracts\Actions;

class CreateProduct implements Actions
{
    public function __invoke(array $data) : Product
    {
        $data['price'] = (new CurrencyService($data['price']))->getSubUnitAmount();
        
        return Product::create($data+[
            'slug' => Str::slug($data['name']),
        ]);
    }
}
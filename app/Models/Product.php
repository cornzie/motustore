<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'status',
    ];

    /**
     * Get the products price
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (new CurrencyService($value, true))->getBaseUnitAmount(),
        );
    }


    /**
     * Product belongs in many orders
     *
     * @return BelongsToMany
     */
    public function orders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

}

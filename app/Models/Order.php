<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'shipping_due_date',
        'shipping_address',
        'delivery_method',
    ];


    /**
     * One order has many products
     *
     * @return BelongsToMany
     */
    public function products() :  BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * One order belongs to customer
     *
     * @return BelongsTo
     */
    public function customer() :  BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}

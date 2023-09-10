<?php

namespace App\Models;

use App\Models\Order;
use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
     * Scope this query to only include published products.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }

    /**
     * Scope this query to only include draft products.
     */
    public function scopeDraft(Builder $query): void
    {
        $query->where('status', 'draft');
    }

    /**
     * Scope this query to only include disabled products.
     */
    public function scopeDisabled(Builder $query): void
    {
        $query->where('status', 'disabled');
    }


    /**
     * Product belongs in many orders
     *
     * @return BelongsToMany
     */
    public function orders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

}

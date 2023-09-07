<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer = Customer::factory()->create();
        $deliver_methods = ['delivery', 'pickup'];

        return [
            'customer_id' => $customer->id,
            'shipping_due_date' => $this->date('Y_m_d'),
            'shipping_address' => $this->faker->address(),
            'delivery_method' => $deliver_methods[array_rand($$deliver_methods)],
        ];
    }
}

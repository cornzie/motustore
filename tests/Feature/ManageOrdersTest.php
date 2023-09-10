<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageOrdersTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * Order creation form page loads.
     */
    public function test_create_order_form_loads_for_manager(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $response = $this->get(route('orders.create'));

        $response->assertStatus(200);
    }

    /**
     * Order creation form page loads for logged user.
     */
    public function test_create_order_form_loads_for_logged_user(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $response = $this->get(route('orders.create'));

        $response->assertStatus(200);
    }

    /**
     * Manager can create an order.
     */
    public function test_manager_can_create_order(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $shippingAddress = $this->faker->address();
        $shippingDate = $this->faker->date();
        $shippingMethods = ['pickup', 'delivery'];
        $shippingMethod = $shippingMethods[array_rand($shippingMethods)];

        $orderData = [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => rand(1,10),
                ]
            ]
        ];

        $response = $this->post(route('orders.store'), $orderData);

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
        ]);

        $response->assertRedirect()->assertSessionHas('success');
    }

    /**
     * Logged user can create an order.
     */
    public function test_logged_user_can_create_order(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $shippingAddress = $this->faker->address();
        $shippingDate = $this->faker->date();
        $shippingMethods = ['pickup', 'delivery'];
        $shippingMethod = $shippingMethods[array_rand($shippingMethods)];

        $orderData = [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => rand(1,10),
                ]
            ]
        ];

        $response = $this->post(route('orders.store'), $orderData);

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
        ]);

        $response->assertRedirect()->assertSessionHas('success');
    }

    /**
     * @dataProvider createOrderValidationProvider
     */
    public function test_required_inputs_are_validated($formInput): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $response = $this->post(route('orders.store'), [
            $formInput => '',
        ])->assertSessionHas("errors");
    }

    public static function createOrderValidationProvider()
    {
        return [
            ['customer_id'],
            ['shipping_due_date'],
            ['delivery_method'],
            ['products'],
        ];
    }


    /**
     * Non manager cannot update order
     *
     * @return void
     */
    public function test_non_manager_cannot_update_order(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        $order = Order::factory()->create();
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $shippingAddress = $this->faker->address();
        $shippingDate = $this->faker->date();
        $shippingMethods = ['pickup', 'delivery'];
        $shippingMethod = $shippingMethods[array_rand($shippingMethods)];

        $orderData = [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => rand(1,10),
                ]
            ]
        ];

        $response = $this->put(route('orders.update', $order->id), $orderData);

        $response->assertStatus(403);
    }

    /**
     * Manager can update an order.
     */
    public function test_manager_can_update_order(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $customer = Customer::factory()->create();
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $shippingAddress = $this->faker->address();
        $shippingDate = $this->faker->date();
        $shippingMethods = ['pickup', 'delivery'];
        $shippingMethod = $shippingMethods[array_rand($shippingMethods)];

        $orderData = [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => rand(1,10),
                ]
            ]
        ];

        $response = $this->put(route('orders.update', $order->id), $orderData);

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'shipping_due_date' => $shippingDate,
            'shipping_address' => $shippingAddress,
            'delivery_method' => $shippingMethod,
        ]);

        $response->assertRedirect()->assertSessionHas('success');

    }
}

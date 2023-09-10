<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewOrdersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * List of orders loads successfully.
     */
    public function test_order_list_loads_successfully_for_manager(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        Order::factory()->count(10)->create();

        $response = $this->get(route('orders.index'));

        $response->assertStatus(200)
        ->assertSee('orders')
        ->assertSee('products')
        ->assertSee('customers');
    }

    /**
     * List of customers loads successfully for logged user.
     */
    public function test_order_list_loads_successfully_for_logged_user(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        Order::factory()->count(10)->create();

        $response = $this->get(route('orders.index'));

        $response->assertStatus(200)
        ->assertSee('orders')
        ->assertSee('products')
        ->assertSee('customers');
    }
}

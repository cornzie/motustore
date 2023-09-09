<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Product listing page loads.
     */
    public function test_create_product_form_loads_for_manager(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
    }

    /**
     * Manager can create product.
     */
    public function test_manager_can_create_product(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $productName = $this->faker->words(2, true);
        $productPrice = $this->faker->randomNumber(3, false);

        $response = $this->post(route('products.store'), [
            'name' => $productName,
            'description' => $this->faker->paragraph(),
            'price' => $productPrice,
            'stock' => $this->faker->randomFloat(2),
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $productName,
            'price' => $productPrice*100,
            'status' => 'published',
        ]);

        $response->assertRedirect()->assertSessionHas('success');
    }

    /**
     * @dataProvider createProductValidationProvider
     */

    public function test_required_inputs_are_validated($formInput): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $productName = $this->faker->words(2, true);
        $productPrice = $this->faker->randomFloat(2);

        $response = $this->post(route('products.store'), [
            $formInput => '',
        ])->assertSessionHas("errors");
    }

    public static function createProductValidationProvider()
    {
        return [
            ['name'],
            ['description'],
            ['price'],
            ['stock'],
            ['status'],
        ];
    }

    /**
     * Non manager cannot create product
     *
     * @return void
     */
    public function test_non_manager_cannot_create_product(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        $productName = $this->faker->words(2, true);
        $productPrice = $this->faker->randomFloat(2);

        $response = $this->post(route('products.store'), [
            'name' => $productName,
            'description' => $this->faker->paragraph(),
            'price' => $productPrice,
            'stock' => $this->faker->randomFloat(2),
            'status' => 'published',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Non manager cannot update product
     *
     * @return void
     */
    public function test_non_manager_cannot_update_product(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        $product = Product::factory()->create();

        $productName = $this->faker->words(2, true);
        $productPrice = $this->faker->randomNumber(2, true);

        $response = $this->put(route('products.update', $product->id), [
            'name' => $productName,
            'description' => $this->faker->paragraph(),
            'price' => $productPrice,
            'stock' => $this->faker->randomNumber(2),
            'status' => 'published',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Manager can create product.
     */
    public function test_manager_can_update_product(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $product = Product::factory()->create();

        $productName = $this->faker->words(2, true);
        $productPrice = $this->faker->randomNumber(2, true);

        $response = $this->put(route('products.update', $product->id), [
            'name' => $productName,
            'description' => $this->faker->paragraph(),
            'price' => $productPrice,
            'stock' => $this->faker->randomNumber(2),
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $productName,
            'price' => $productPrice*100,
            'status' => 'published',
        ]);

        $response->assertRedirect()->assertSessionHas('success');

    }


}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCustomersTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * Customer creation form page loads.
     */
    public function test_create_customer_form_loads_for_manager(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $response = $this->get(route('customers.create'));

        $response->assertStatus(200);
    }

    /**
     * Manager can create customer.
     */
    public function test_manager_can_create_customer(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $customerFirstName = $this->faker->firstName();
        $customerLastName = $this->faker->lastName();
        $customerPhoneNumber = $this->faker->e164PhoneNumber();
        $customerEmail = $this->faker->safeEmail();
        $customerAddress1 = $this->faker->streetAddress();
        $customerCity = $this->faker->city();
        $customerRegion = $this->faker->state();
        $customerCountry = $this->faker->country();

        $customerData = [
            'first_name' => $customerFirstName,
            'last_name' => $customerLastName,
            'phone_number' => $customerPhoneNumber,
            'email' => $customerEmail,
            'address_1' => $customerAddress1,
            'city' => $customerCity,
            'region' => $customerRegion,
            'country' => $customerCountry,
        ];

        $response = $this->post(route('customers.store'), $customerData);

        $this->assertDatabaseHas('customers', $customerData);

        $response->assertRedirect()->assertSessionHas('success');
    }

    /**
     * @dataProvider createCustomerValidationProvider
     */
    public function test_required_inputs_are_validated($formInput): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $response = $this->post(route('customers.store'), [
            $formInput => '',
        ])->assertSessionHas("errors");
    }

    public static function createCustomerValidationProvider()
    {
        return [
            ['first_name'],
            ['last_name'],
            ['phone_number'],
            ['email'],
            ['address_1'],
        ];
    }

    /**
     * Non manager cannot create a customer
     *
     * @return void
     */
    public function test_non_manager_cannot_create_customer(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        $customerFirstName = $this->faker->firstName();
        $customerLastName = $this->faker->lastName();
        $customerPhoneNumber = $this->faker->e164PhoneNumber();
        $customerEmail = $this->faker->safeEmail();
        $customerAddress1 = $this->faker->streetAddress();
        $customerCity = $this->faker->city();
        $customerRegion = $this->faker->state();
        $customerCountry = $this->faker->country();

        $customerData = [
            'first_name' => $customerFirstName,
            'last_name' => $customerLastName,
            'phone_number' => $customerPhoneNumber,
            'email' => $customerEmail,
            'address_1' => $customerAddress1,
            'city' => $customerCity,
            'region' => $customerRegion,
            'country' => $customerCountry,
        ];

        $response = $this->post(route('customers.store'), $customerData);

        $response->assertStatus(403);
    }

    /**
     * Non manager cannot update customer
     *
     * @return void
     */
    public function test_non_manager_cannot_update_customer(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('loggedUser');

        $this->actingAs($user);

        $customer = Customer::factory()->create();

        $customerFirstName = $this->faker->firstName();
        $customerLastName = $this->faker->lastName();
        $customerPhoneNumber = $this->faker->e164PhoneNumber();
        $customerEmail = $this->faker->safeEmail();
        $customerAddress1 = $this->faker->streetAddress();
        $customerCity = $this->faker->city();
        $customerRegion = $this->faker->state();
        $customerCountry = $this->faker->country();

        $customerData = [
            'first_name' => $customerFirstName,
            'last_name' => $customerLastName,
            'phone_number' => $customerPhoneNumber,
            'email' => $customerEmail,
            'address_1' => $customerAddress1,
            'city' => $customerCity,
            'region' => $customerRegion,
            'country' => $customerCountry,
        ];

        $response = $this->put(route('customers.update', $customer->id), $customerData);

        $response->assertStatus(403);
    }

    /**
     * Manager can update a customer.
     */
    public function test_manager_can_update_customer(): void
    {
        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('manager');

        $this->actingAs($user);

        $customer = Customer::factory()->create();

        $customerFirstName = $this->faker->firstName();
        $customerLastName = $this->faker->lastName();
        $customerPhoneNumber = $this->faker->e164PhoneNumber();
        $customerEmail = $this->faker->safeEmail();
        $customerAddress1 = $this->faker->streetAddress();
        $customerCity = $this->faker->city();
        $customerRegion = $this->faker->state();
        $customerCountry = $this->faker->country();

        $customerData = [
            'first_name' => $customerFirstName,
            'last_name' => $customerLastName,
            'phone_number' => $customerPhoneNumber,
            'email' => $customerEmail,
            'address_1' => $customerAddress1,
            'city' => $customerCity,
            'region' => $customerRegion,
            'country' => $customerCountry,
        ];

        $response = $this->put(route('customers.update', $customer->id), $customerData);

        $this->assertDatabaseHas('customers', $customerData);

        $response->assertRedirect()->assertSessionHas('success');

    }
    
}

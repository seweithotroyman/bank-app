<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;


class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_create_a_customer()
    {
        $customer = Customer::create([
            'name' => 'John Doe',
            'id_number' => '1234567890',
            'cif_number' => 'CIF123456',
            'address' => '123 Main Street',
            'email' => 'john@example.com',
            'date_of_birth' => '1990-01-01',
        ]);

        $this->assertDatabaseHas('customers', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $customer = Customer::factory()->create();

        $customer->update([
            'name' => 'Jane Doe',
        ]);

        $this->assertEquals('Jane Doe', $customer->fresh()->name);
    }

    /** @test */
    public function it_can_delete_a_customer()
    {
        $customer = Customer::factory()->create();

        $customer->delete();

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }
}

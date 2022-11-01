<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

class ProductTest extends TestCase
{

    // GET/:ID

    //id de un producto válido
    //id de un producto que no existe

    public function test_get_valid_product(){

        $value = 2;
        $user = User::find(1);

        $response = $this->actingAs($user)
                        ->getJson("/api/v1/products/$value")
                        ->assertStatus(200)
                        ->assertJson([
                            "data" => [
                                'name' => "Gomitas",
                                'price' => 200
                            ]
                        ]);

        //$response = dd();
    }

    public function test_get_all_valid_products(){

        //$value = 999;
        $user = User::find(1);

        $response = $this->actingAs($user)
                        ->getJson("/api/v1/products/")
                        ->assertStatus(200)
                        ->assertJsonStructure([
                            'product' => [
                                'name',
                                'price',
                                'expiration'
                            ]
                        ]);


    }

    public function test_get_invalid_product(){

        $value = 999;
        $user = User::find(1);

        $response = $this->actingAs($user)
                        ->getJson("/api/v1/products/$value")
                        ->assertStatus(404)
                        ->assertJson([
                            "message" => "No query results for model [App\\Models\\Product] $value"
                        ]);
        //$response = dd();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /* public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    } */
}
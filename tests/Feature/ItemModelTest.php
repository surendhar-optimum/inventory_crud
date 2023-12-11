<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;

class ItemModelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function testCreatePost(){
        $item=[
            'name'=>'Fruit',
            'description'=>'apple',
            'price'=>'50',
            'quantity'=>'20'

        ];
        $response=$this->post('/item',$item);
        $response->assertStatus(201);
        $this->assertDatabaseHas('item',$item);
    }

}

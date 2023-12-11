<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;

class ItemModelTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/item');

        $response->assertStatus(200);
    }
    public function testCreatePost()
    {
        $item = [
            'name' => 'almonds' . time(),
            'description' => 'Green',
            'price' => '150',
            'quantity' => '1500',
            'category_id' => [1],

        ];
        $response = $this->post('/api/item', $item);
        $response->assertStatus(201);

    }
    public function testUpdatePost()
    {
        $item = Item::first();
        $updateData = [
            'name' => 'surendhar',
            'description' => 'Red in color',
            'price' => '290',
            'quantity' => '40',
            'category_id' => [1],
        ];

        $response = $this->putJson('/api/item/' . $item->id, $updateData);

        $response->assertStatus(200);

    }

    public function testGetItemList()
    {

        $response = $this->get('/api/item');

        $response->assertStatus(200);

    }
    public function testGetItemDetails()
    {

        $item = Item::first();

        $response = $this->get('/api/item/' . $item->id);

        $response->assertStatus(200);

    }
    public function testDeleteItem()
    {
        $item = Item::first();
        $response = $this->delete('/api/item/' . $item->id);
        $response->assertStatus(200);
    }
}

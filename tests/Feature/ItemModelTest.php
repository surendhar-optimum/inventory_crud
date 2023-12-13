<?php

namespace Tests\Feature;

use App\Models\Category;
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

     private $ITEM_HEADERS = [
        'Authorization' => 'Bearer xplore_inventory',
        'Accept' => 'application/json'
     ];
    public function test_itemDetails()
    {
        $response = $this->withHeaders($this->ITEM_HEADERS)->getJson('/api/item');

        $response->assertStatus(200);
    }
    public function testCreatePost()
    {
        $item=Category::pluck('id');
        $response = $this->withHeaders($this->ITEM_HEADERS)->postJson('/api/item',
       [
            'name' => 'almon' . time(),
            'description' => 'Green',
            'price' => '150',
            'quantity' => '1500',
            'category_id' => $item

        ]);

        $response->assertStatus(201);

    }
    public function testUpdatePost()
    {
        $item = Item::orderBy('id','ASC')->first();
        $categories = Category::orderBy('id','ASC')->pluck('id')->first();
        $response = $this->withHeaders($this->ITEM_HEADERS)->put('/api/item/'.$item->id,
        [
            'name' => 'lkjlkj;lkjlkj',
            'description' => 'Red in color',
            'price' => '290',
            'quantity' => '40',
            'category_id' => [$categories]
        ]);

        $response->assertStatus(200);

    }
    public function testUpdatePostNotFound(){
        $response = $this->withHeaders($this->ITEM_HEADERS)->put('/api/item/555',
        [
            'name' => 'straw',
            'description' => 'Red in color',
            'price' => '290',
            'quantity' => '40',
            'category_id' => [1],
        ]);
        $response->assertStatus(404);
    }


    public function testGetItemDetailsId()
    {

        $item = Item::OrderBy('id', 'DESC')->first();

        $response = $this->withHeaders($this->ITEM_HEADERS)->getJson('/api/item/' . $item->id);

        $response->assertStatus(200);

    }
    public function testGetItemDetailsdeleteIdNotFound()
    {



        $response = $this->withHeaders($this->ITEM_HEADERS)->delete('/api/item/555');

        $response->assertStatus(400);

    }
    public function testDeleteItem()
    {
        $item = Item::OrderBy('id', 'DESC')->first();;
        $response = $this->withHeaders($this->ITEM_HEADERS)->delete('/api/item/'. $item->id);

        $response->assertStatus(200);
    }
}

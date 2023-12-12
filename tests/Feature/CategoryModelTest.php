<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use Illuminate\Validation\Rules\Unique;

class CategoryModelTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     private $CATEGORY_HEADERS='xplore_inventory';
    public function test_CategoryDetails()
    {

        $response = $this->postJson('/api/category',[
            'name'=>'Testing',
            'description'=>'testing descp']);

        $response->assertStatus(403);
    }
    public function testCreatelist()
    {
        $response=$this->withHeaders([
            'Authorization' => 'Bearer'. $this->CATEGORY_HEADERS,])->postJson('/api/category',[
                'name' => 'almon' ,
            'description' => 'Green',
            ]);

        $response->assertStatus(403);

    }
    public function testUpdatePost()
    {
        $category = Category::orderBy('id','DESC')->first();

        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
        ])->putJson('/api/category' .$category->id,[
            'name' => 'almon'. uniqid(),
            'description' => 'Green',
        ]);



        $response->assertStatus(404);

    }
    public function testUpdatePostNotFound(){
        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
        ])->putJson('/api/category/555',[
            'name' => 'almon'.uniqid(),
            'description' => 'Green',
        ]);
        $response->assertStatus(403);
    }


    public function testGetCategoryDetailsId()
    {



        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
    ])->getJson('api/category');

        $response->assertStatus(403);

    }
    public function testGetCategoryDetailslist()
    {



        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
    ])->getJson('api/category/1');

        $response->assertStatus(403);

    }
    public function testGetCategoryDetailsdeleteIdNotFound()
    {



        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
        ])->getJson('api/category/555');
        $response->assertStatus(403);

    }
    public function testdeleteIdNotFound()
    {



        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
        ])->delete('api/category/555');
        $response->assertStatus(403);

    }
    public function testDeleteCategory()
    {
        $category = Category::OrderBy('id', 'DESC')->first();;
        $response = $this->withHeaders(['Authorization' => 'Bearer' . $this->CATEGORY_HEADERS,
        ])->delete('api/category/'. $category->id);
        $response->assertStatus(403);
    }
}

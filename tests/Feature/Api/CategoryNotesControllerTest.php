<?php

namespace Tests\Feature\Api;

use App\Models\CategoryNotes;
use App\Models\ColorOfNoteCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Str;

class CategoryNotesControllerTest extends TestCase
{

    public $headersArray;


    public function setUp () : void
    {
        parent::setUp();
        $this->headersArray = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '. env('TEST_USER_API_TOKEN', 'TEST_USER_API_TOKEN')
        ];    
    
    }

 

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_output_of_all_categories()
    {

        $this->withHeaders($this->headersArray)
        ->get('/api/categories')
        ->assertStatus(200)
        ->assertJsonStructure(
            [ 
                'embedded'=> [
                    'categories' => [] 
                ],
                'links',
                'meta'
            ]

        );

    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_a_category()
    {

        $categoryNotes = CategoryNotes::take(1)->first();

        $this->withHeaders($this->headersArray)
        ->get('/api/categories/'.$categoryNotes->id)
        ->assertStatus(200)
        ->assertJsonStructure(
            [ 
                'category',          
                'meta'
            ]

        );
 

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_showing_a_nonexistent_category()
    {        

        $this->withHeaders($this->headersArray)
        ->get('/api/categories/0')
        ->assertStatus(404)
        ->assertExactJson([
            'meta'=> [
                "status" => "error",
                "message" => "Resource not found!",
                "code" => 404              
            ],
        ]);
 

    }    


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creating_a_category()
    {        

        $color = ColorOfNoteCategory::orderBy('id', 'desc')->first();
    
        $name = 'Test Create ' . Str::random(5);
        $this->withHeaders($this->headersArray)
        ->json('POST', '/api/categories', [
            'name' => $name,
            'color_id' => $color->id,
        ])
        ->assertStatus(201)
        ->assertJsonPath('category.name', $name)
        ->assertJsonPath('category.color_id', $color->id)
        ->assertJson([            
            "meta" => [
                "status" => "success",
                "message" => "Created",
                "code" => 201
            ]             
        ]);


    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_data_when_create_a_category()
    {        

        $this->withHeaders($this->headersArray)
        ->json('POST', '/api/categories', [
            'name' => 'Немедленно',   
            'color_id' => null,   
        ])
        ->assertStatus(422)
        ->assertJsonStructure(
            [ 
                'message',          
                'errors' => [
                    'name',
                    'color_id'
                ]
            ]
        );

    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_updating_a_category()
    {
        
 
        $category = CategoryNotes::orderBy('id', 'desc')->first();
        $color = ColorOfNoteCategory::orderBy('id', 'desc')->first();

        $newName = 'Test Update ' . Str::random(5);

        $this->withHeaders($this->headersArray)
        ->json('PUT', '/api/categories/'.$category->id, [
            'name' => $newName ,
            'color_id' => $color->id,
        ])
        ->assertStatus(200)
        ->assertJsonPath('category.id', $category->id)
        ->assertJsonPath('category.name', $newName )
        ->assertJsonPath('category.color_id', $color->id)
        ->assertJson([
            "meta" => [
                "status" => "success",
                "message" => "ok",
                "code" => 200
            ] 
        ]);


    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_data_when_update_a_category()
    {        

        $category = CategoryNotes::orderBy('id', 'desc')->first();
        $this->withHeaders($this->headersArray)
        ->json('PUT', '/api/categories/'.$category->id, [
            'name' => 'Немедленно',   
            'color_id' => null,   
        ])
        ->assertStatus(422)
        ->assertJsonStructure(
            [ 
                'message',          
                'errors' => [
                    'name',
                    'color_id'
                ]
            ]
        );

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_updating_a_nonexistent_category()
    {        
   
        $this->withHeaders($this->headersArray)
        ->json('PUT', '/api/categories/0', [
            'name' => 'New name' 
        ])
        ->assertStatus(404);

    }    

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_deleting_a_category()
    {

        $category = CategoryNotes::orderBy('id', 'desc')->first();
        $this->withHeaders($this->headersArray)
        ->json('DELETE', '/api/categories/'.$category->id)
        ->assertStatus(204);


    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_deleting_a_nonexistent_category()
    {        

        $this->withHeaders($this->headersArray)
        ->json('DELETE', '/api/categories/0')
        ->assertStatus(404);

    }

}

<?php

namespace Tests\Feature\Api;

use App\Models\CategoryNotes;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class NoteControllerTest extends TestCase
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
    public function test_output_of_all_notes()
    {
        $this->withHeaders($this->headersArray)
        ->get('/api/notes')
        ->assertStatus(200)
        ->assertJsonStructure(
            [ 
                'embedded'=> [
                    'notes' => [] 
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
    public function test_show_a_note()
    {

        $note = Note::take(1)->first();
        $this->withHeaders($this->headersArray)
        ->get('/api/notes/'.$note->id)
        ->assertStatus(200)
         ->assertJsonStructure(
            [ 
                'note',          
                'meta'
            ]

        );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_showing_a_nonexistent_note()
    {
        
        $this->withHeaders($this->headersArray)
        ->get('/api/notes/0')
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
    public function test_creating_a_note()
    {        
        $category = CategoryNotes::orderBy('id', 'desc')->first();    
        $this->withHeaders($this->headersArray)
        ->json('POST', '/api/notes', [
            'title' => 'Test title',
            'text' => 'Test text',
            'category_notes_id' => $category->id,
        ])
        ->assertStatus(201)
        ->assertJsonPath('note.title', 'Test title')
        ->assertJsonPath('note.text', 'Test text')
        ->assertJsonPath('note.category_notes_id', $category->id)
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
        ->json('POST', '/api/notes', [
            'title' => null,
            'text' => null,
            'category_notes_id' => null,
        ])
        ->assertStatus(422)
        ->assertJsonStructure(
            [ 
                'message',          
                'errors' => [
                    'title',
                    'text',
                    'category_notes_id'
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
        
 
        $note = Note::orderBy('id', 'desc')->first();
        $category = CategoryNotes::orderBy('id', 'desc')->first();  

        $this->withHeaders($this->headersArray)
        ->json('PUT', '/api/notes/'.$note->id, [
            'title' => 'Title update',
            'text' => 'Text update',
            'category_notes_id' => $category->id,
        ])
        ->assertStatus(200)
        ->assertJsonPath('note.id', $note->id)
        ->assertJsonPath('note.title', 'Title update' )
        ->assertJsonPath('note.text', 'Text update')
        ->assertJsonPath('note.category_notes_id', $category->id)
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

        $note = Note::orderBy('id', 'desc')->first();
        $category = CategoryNotes::orderBy('id', 'desc')->first();  
        $this->withHeaders($this->headersArray)
        ->json('PUT', '/api/notes/'.$note->id, [
            'title' => null,
            'text' => null,
            'category_notes_id' => null,
        ])
        ->assertStatus(422)
        ->assertJsonStructure(
            [ 
                'message',          
                'errors' => [
                    'title',
                    'text',
                    'category_notes_id'
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
   
        $category = CategoryNotes::orderBy('id', 'desc')->first();  
        $this->withHeaders($this->headersArray)
        ->json('PUT', '/api/notes/0', [
            'title' => 'Title update',
            'text' => 'Text update',
            'category_notes_id' => $category->id, 
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

        $note = Note::orderBy('id', 'desc')->first();
        $this->withHeaders($this->headersArray)
        ->json('DELETE', '/api/notes/'.$note->id)
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
        ->json('DELETE', '/api/notes/0')
        ->assertStatus(404);

    }


}

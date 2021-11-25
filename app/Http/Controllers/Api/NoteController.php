<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Library\ApiResponseHelpers;
use App\Http\Requests\Api\StoreNoteRequest;
use App\Http\Requests\Api\UpdateNoteRequest;
use App\Http\Resources\Api\NoteCollection;
use App\Models\Note;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Api\NoteCollection;
     */
    public function index()
    {

        try {
            $notes = Note::with([
                                'author:id,name',                
                                'categoryNotes:id,name,img,color_id', 
                                'categoryNotes.color'
                            ])
                            ->orderBy('id')                                
                            ->paginate(10); 


            foreach ($notes as $note) {
                $note['links'] = [
                    'self' => [
                        'href' => route('api.notes.show', 
                        ['id' => $note->id
                    ])
                ]];
                if($note->categoryNotes !== null) {
                    $note->categoryNotes['links'] = ['self' => [
                        'href' => route('api.notes.show', ['id' => $note->categoryNotes->id])
                    ]];     
                        
                }
            }
            return new NoteCollection($notes);

        } catch (\Exception $e) {
            Log::error('Server error 404 | '.$e->getMessage().' | index note');
            return $this->withError(500, 'Server error');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
 
        try {            
            $note = Note::findOrFail($id);
            $note->load([
                'author:id,name',                
                'categoryNotes:id,name,img,color_id', 
                'categoryNotes.color'
            ]);
     
        } catch (\Exception $e) {
            Log::error('Server error 404 | '.$e->getMessage().' | show note');
            return $this->withError(404, 'Resource not found!');
        }

        try {
           
            $note->links = ['self' => [
                'href' => route('api.notes.show', ['id' => $note->id])
            ]]; 
            return $this->withSuccess(200, 'ok', ['note' => $note]);

        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | show note');
            return $this->withError(500, 'Server error');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoteRequest $request)
    {        
        try {
            $note = Note::create(
                Arr::collapse([
                    $request->only(["title","text","category_notes_id"]),            
                    ['author_id'=> Auth::id()]
                ])
            );
           
            return $this->withSuccess(201, 'Created', [
                'note' => $note,
                'links' => ['self' => [
                    'href' => route('api.notes.index')
                ]]    
            ]);          

        } catch (\Exception $e) {
            
            Log::error('Server error 500 | '.$e->getMessage().' | store note');
            return $this->withError(500, 'Server error');
        }
   

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UpdateNoteRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, int $id)
    {
        try {
            $note = Note::findOrFail($id); 

        } catch (\Exception $e) {
            Log::error('Resource not found! 404 | '.$e->getMessage().' | update notes');
            return $this->withError(404, 'Resource not found!');
        }

        try {   
            $note->update($request->only(["title","text","category_notes_id"])) ;
            return $this->withSuccess(200, 'ok', [
                'note' => $note,
                'links' => ['self' => [
                    'href' => route('api.notes.index')
                ]]   
            ]);  

        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | update notes');
            return $this->withError(500, 'Server error');
        }
 
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $note = Note::findOrFail($id); 
        } catch (\Exception $e) {
            Log::error('Resource not found! 404 | '.$e->getMessage().' | destroy notes');
            return $this->withError(404, 'Resource not found!');
        }        
        try {

            $result = $note->delete();
            return $this->withSuccess(204, 'ok', ['note' => $result]);  

        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | destroy notes');
            return $this->withError(500, 'Server error');
        }

    }

}

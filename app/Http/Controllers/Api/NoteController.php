<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Library\ApiResponseHelpers;
use App\Http\Requests\Api\StoreNoteRequest;
use App\Http\Requests\Api\UpdateNoteRequest;
use App\Http\Resources\Api\Note\NoteCollection;
use App\Http\Resources\Api\Note\NoteResource;
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
     * @return \App\Http\Resources\Api\Note\NoteCollection;
     */
    public function index()
    {
        $notes = Note::orderBy('id')->paginate(10); 
        return new NoteCollection($notes);        
    }

    /**
     * Display the specified resource.
     *
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return new NoteResource($note);
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
            return response()->json(new NoteResource($note), 204);        

        } catch (\Exception $e) {            
            Log::error('Server error 500 | '.$e->getMessage());
            abort(500, 'Something went wrong.');   
        }
   

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UpdateNoteRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        try {   
            $note->update($request->only(["title","text","category_notes_id"])) ;
            return new NoteResource($note); 

        } catch (\Exception $e) {
            Log::error('Server error 500 | '.$e->getMessage());
            abort(500, 'Something went wrong.');   
        }
 
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
      
        try {
            $result = $note->delete();
            return response()->json(null, 204);
            if (!$result) {
                abort(500, 'Something went wrong.'); 
            }
        } catch (\Exception $e) {
            Log::error('Server error 500 | '.$e->getMessage());
            abort(500, 'Something went wrong.');   
        }

    }

}

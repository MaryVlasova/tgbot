<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\CategoryNotes;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('author', 'categoryNotes', 'categoryNotes.color')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
        return view('backend.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesOfNotes = CategoryNotes::all();
        return view('backend.notes.create', compact('categoriesOfNotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {   
        dd($request->file('image')->store( 'note', 'public'));
        if ($request->file('image') !== null) {
            $folder = date("Ymd");
            $request->merge([
                'img'=> $request->file('image')->store( 'note', 'public')
            ]);
        }           
        $request->merge(['author_id'=> Auth::id()]);
        Note::create($request->all()); 
        return redirect()
                        ->route('admin.notes.index')
                        ->with('success','Записка создана.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('backend.notes.show',compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $categoriesOfNotes = CategoryNotes::all();
        return view('backend.notes.edit', compact('note', 'categoriesOfNotes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NoteRequest  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, Note $note)
    {   
        if ($request->file('image') !== null) {
            $folder = date("Ymd");
            if($note->img && !Str::contains($note->img, '/examples/')) {
                if (Storage::disk('public')->exists($note->img)) {
                    Storage::disk('public')->delete($note->img);
                }                
            }  
            $request->merge([
                'img' => $request->file('image')->store('note', 'public')
            ]);  
        }         
        //DB::enableQueryLog();
        $query = $note->update($request->all());
        //dd(DB::getQueryLog());  
      
        return redirect()
                        ->route('admin.notes.edit', compact('note'))
                        ->with('success','Записка успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()
                        ->route('admin.notes.index')
                        ->with('success','Записка успешно удалена');
    }
}

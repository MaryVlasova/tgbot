<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryNotesRequest;
use App\Models\CategoryNotes;
use App\Models\ColorOfNoteCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesOfNotes = CategoryNotes::with('color')->get();        

        return view('backend.category-notes.index', compact('categoriesOfNotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = ColorOfNoteCategory::all();
        return view('backend.category-notes.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryNotesRequest $request)
    {
        if ($request->file('image') !== null) {
            $request->merge([
                'img'=> $request->file('image')->store('category-notes', 'public')
            ]);
        }   
        CategoryNotes::create($request->all());
        return redirect()
                        ->route('admin.category-notes.index')
                        ->with('success',`Категория {$request->name} создана.`);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryNotes  $categoryNotes
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryNotes $categoryNotes)
    {
        return view('backend.category-notes.show',compact('categoryNotes'));     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryNotes  $categoryNotes
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryNotes $categoryNotes)
    {        
        $colors = ColorOfNoteCategory::all();
        return view('backend.category-notes.edit', compact('categoryNotes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryNotesRequest  $request
     * @param  \App\Models\CategoryNotes  $categoryNotes
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryNotesRequest $request, CategoryNotes $categoryNotes)
    {

        
        if ($request->file('image') !== null) {
            if($categoryNotes->img && !Str::contains($categoryNotes->img, '/examples/')) {
                if (Storage::disk('public')->exists($categoryNotes->img)) {
                    Storage::disk('public')->delete($categoryNotes->img);
                }                
            }  
            $request->merge([
                'img' => $request->file('image')->store('category-notes', 'public')
            ]);  
        }  
        $categoryNotes->update($request->all()) ;

        return redirect()
                        ->route('admin.category-notes.edit', compact('categoryNotes'))
                        ->with('success','Категория успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryNotes  $categoryNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryNotes $categoryNotes)
    {
        $categoryNotes->delete();
        return redirect()
                        ->route('admin.category-notes.index')
                        ->with('success','Категория успешно удалена.');
    }
}

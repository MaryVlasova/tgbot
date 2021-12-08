<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Library\ApiResponseHelpers;
use App\Http\Requests\Api\StoreCategoryNotesRequest;
use App\Http\Requests\Api\UpdateCategoryNotesRequest;
use App\Http\Resources\Api\CategoryNotes\CategoryNotesCollection;
use App\Http\Resources\Api\CategoryNotes\CategoryNotesResource;
use App\Models\CategoryNotes;
use Illuminate\Support\Facades\Log;

class CategoryNotesController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Api\CategoryNotesCollection;
     */
    public function index()
    {  
        $categoriesOfNotes = CategoryNotes::paginate(10);            
        return new CategoryNotesCollection($categoriesOfNotes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\StoreCategoryNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryNotesRequest $request)
    {

        try {
            $categoryNotes = CategoryNotes::create($request->only(	["name","color_id"]));
            return response()->json(new CategoryNotesResource($categoryNotes), 204);        

        } catch (\Exception $e) {
      
            Log::error('Server error 500 | '.$e->getMessage().' | store category_notes');
            return $this->withError(500, 'Server error');
        }
   

    }

    /**
     * Display the specified resource.
     *
     * @param  CategoryNotes $categoryNotes
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryNotes $categoryNotes)
    {    
        return new CategoryNotesResource($categoryNotes);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UpdateCategoryNotesRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryNotesRequest $request, CategoryNotes $categoryNotes)
    {        

        try {
            $categoryNotes->update($request->only(["name","color_id"])) ;
            return new CategoryNotesResource($categoryNotes);
        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | update category_notes');
            abort(500, 'Something went wrong.');
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryNotes $categoryNotes)
    {
        try {
            $categoryNotes->delete();  
            return response()->json(null, 204);
        } catch (\Exception $e) {            
            Log::error('Server error 500 | '.$e->getMessage().' | destroy category_notes');
            abort(500, 'Something went wrong.');
        }
    }
}

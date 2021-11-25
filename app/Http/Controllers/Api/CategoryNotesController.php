<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Library\ApiResponseHelpers;
use App\Http\Requests\Api\StoreCategoryNotesRequest;
use App\Http\Requests\Api\UpdateCategoryNotesRequest;
use App\Http\Resources\Api\CategoryNotesCollection;
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
        
        try {
            $categoriesOfNotes = CategoryNotes::with('color')->paginate(10);
            foreach ($categoriesOfNotes as $category) { 
                $category->links = [
                    'self' => [
                        'href' => route('api.categories.show', ['id' => $category->id])
                    ]
                ];         
            }
            
            return new CategoryNotesCollection($categoriesOfNotes);
        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | index category_notes');
            return $this->withError(500, 'Server error');

        }

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
            return $this->withSuccess(201, 'Created', [
                    'category' => $categoryNotes->load('color'),
                    'links' => ['self' => [
                        'href' => route('api.categories.index')
                    ]]                
            ]);          

        } catch (\Exception $e) {
      
            Log::error('Server error 500 | '.$e->getMessage().' | store category_notes');
            return $this->withError(500, 'Server error');
        }
   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        
        try {
            $categoryNotes = CategoryNotes::findOrFail($id); 
            $categoryNotes->load('color');
        } catch (\Exception $e) {
            Log::error('Resource not found! 404 | '.$e->getMessage().' | show category_notes');
            return $this->withError(404, 'Resource not found!');
        }

        try {          
            $categoryNotes->links = ['self' => [
                'href' => route('api.categories.show', ['id' => $categoryNotes->id])
            ]];   
            return $this->withSuccess(200, 'ok', [
                'category' => $categoryNotes
            ]);       

        } catch (\Exception $e) {
            Log::error('Server error 500 | '.$e->getMessage().' | show category_notes');
            return $this->withError(500, 'Server error');
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UpdateCategoryNotesRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryNotesRequest $request, int $id)
    {
        
        try {
            $categoryNotes = CategoryNotes::findOrFail($id);           
        } catch (\Exception $e) {
            Log::error('Resource not found! 404 | '.$e->getMessage().' | update category_notes');
            return $this->withError(404, 'Resource not found!');
        }

        try {

            $categoryNotes->update($request->only(["name","color_id"])) ;
            return $this->withSuccess(200, 'ok', [
                    'category' => $categoryNotes,
                    'links' => ['self' => [
                        'href' => route('api.notes.index')
                    ]]
                ]
            );  

        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | update category_notes');
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
            $categoryNotes = CategoryNotes::findOrFail($id); 
        } catch (\Exception $e) {
            Log::error('Resource not found! 404 | '.$e->getMessage().' | destroy category_notes');
            return $this->withError(404, 'Resource not found!');
        }  

        try {

            $categoryNotes->delete();             
            return $this->withSuccess(204, 'ok');  

        } catch (\Exception $e) {

            Log::error('Server error 500 | '.$e->getMessage().' | destroy category_notes');
            return $this->withError(500, 'Server error');
        }

    }
}

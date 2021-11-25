<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CategoryNotesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category = $this->categoryNotes;  
        return [            
            'name' => [
                'required',  
                isset($category->id) ?           
                'unique:category_notes,name,'.$category->id : 'unique:category_notes,name', 
                'max:255'
            ],
            'color_id' => [ 
                'required', 
                'exists:colors_of_note_category,id',
                'integer'
            ] , 
            'image' => [
                'image', 
                'mimes:jpeg,png,jpg,gif,svg', 
                'max:20'
            ],
        ];
    }
    /**
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }  

    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [

            'name.required' => 'Необходимо указать название',
            'name.unique' => 'Название должно быть уникально',
            'name.max' => 'Не более 255 символов в названии',

            'color_id.required' => 'Необходимо указать цвет', 
            'color_id.exists' => 'Цвет не опознан', 
            'color_id.integer' => 'Цвет не опознан',

            'image.mimes' => 'Изображение должно быть в формате jpeg, png, jpg, gif или svg',
            'image.max' => 'максимальный размер 2048',
            'image.image' => 'Ожидается изображение'

        ];
    }       
}

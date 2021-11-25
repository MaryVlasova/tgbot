<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryNotesRequest extends FormRequest
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
                'unique:category_notes,name', 
                'max:255'
            ],
            'color_id' => [ 
                'required', 
                'exists:colors_of_note_category,id',
                'integer'
            ] 
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
            'color_id.integer' => 'Цвет не опознан'
        ];
    }    
}

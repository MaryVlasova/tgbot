<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
        
        return [ 
            'title' => [
                'sometimes',
                'required', 
                'max:255'
            ],
            'text' => [
                'sometimes',
                'required',       
                'max:300'
            ], 
            'category_notes_id' => [
                'sometimes',
                'required', 
                'integer',
                'exists:category_notes,id'
                
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
            
            'name.required' => 'Необходимо указать заголовок',
            'name.max' => 'Не более 255 символов в заголовке',

            'text.required' => 'Необходимо написать текст',            
            'text.max' => 'Текст не более 300 символов'   ,

            'category_notes_id.required' => 'Необходимо указать категорию',
            'category_notes_id.integer' => 'Ожидается число',
            'category_notes_id.exists' => 'Категория записки не существует',
            

        ];
    } 
}

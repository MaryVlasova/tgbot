<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class NoteRequest extends FormRequest
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
                'required', 
                'max:255'
            ],
            'text' => [
                'required',       
                'max:300'
            ], 
            'image' => [
                'image', 
                'mimes:jpeg,png,jpg,gif,svg', 
                'max:2048'
            ],
            'category_notes_id' => [
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

            'image.mimes' => 'Изображение должно быть в формате jpeg, png, jpg, gif или svg',
            'image.max' => 'максимальный размер 2048',
            'image.image' => 'Ожидается изображение',

            'category_notes_id.required' => 'Необходимо указать категорию',
            'category_notes_id.integer' => 'Ожидается число',
            'category_notes_id.exists' => 'Категория записки не существует',
            

        ];
    }    

}

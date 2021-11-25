<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBotSettingsRequest extends FormRequest
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
            'name' => [
                'required', 
                'max:255'
            ],
            'description' => [
                'required', 
                'max:255'
            ],
            'info' => [
                'required', 
                'max:255'
            ],
            'token' => [
                'required', 
                'max:255'
            ],
            'link' => [
                'required', 
                'max:255'
            ],
            'img' => [
                'image', 
                'mimes:jpeg,png,jpg,gif,svg','max:2048'
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
            'name.max:255' => 'Не более 255 символов в названии',

            'description.required' => 'Необходимо указать описание', 
            'description.max' => 'Не более 255 символов в описании',

            'info.required' => 'Необходимо указать краткую информацию', 
            'info.max:255' => 'Не более 255 символов в краткой информации',

            'link.required' => 'Необходимо указать ссылку', 
            'link.max' => 'Не более 255 символов в ссылке',

            'token.required' => 'Необходимо указать token', 
            'token.max' => 'Не более 255 символов в token',

            'img.mimes' => 'Изображение должно быть в формате jpeg, png, jpg, gif или svg',
            'img.max' => 'максимальный размер 2048',
            'img.image' => 'Ожидается изображение'

        ];
    }    
}

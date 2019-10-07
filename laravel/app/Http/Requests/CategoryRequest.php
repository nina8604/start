<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file' => [
                'required',
                'image',
                //'mimes:jpeg,bmp,png,jpg',
                'max:50000',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать заголовок!',
//            'slug' => 'Необходимо указать алиас!',
            'description.required' => 'Необходимо заполнить описание!',
            'file.required' => 'Необходимо выбрать изображение',
            'file.mimes' => 'Допустимые форматы загрузки излбражения: jpeg, bmp, png!',
            'file.max' => 'Допустимый размер файла 5мб !',
        ];
    }
}


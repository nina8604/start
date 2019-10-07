<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PictureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'image|mimes:jpeg,bmp,png,jpg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Необходимо выбрать изображение',
            'file.mimes' => 'Допустимые форматы загрузки излбражения: jpeg, bmp, png!',
            'file.max' => 'Допустимый размер файла 5мб !',
        ];
    }
}

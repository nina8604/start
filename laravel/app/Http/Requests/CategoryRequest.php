<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                Rule::requiredIf(function() {
                    return $this->routeIs('admin.categories.store');
                }),
                'image',
                'max:50000',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо указать заголовок!',
            'slug.required' => 'Необходимо указать псевдоним!',
            'description.required' => 'Необходимо заполнить описание!',
            'file.required' => 'Необходимо выбрать изображение',
            'file.max' => 'Допустимый размер файла 5мб !',
        ];
    }
}


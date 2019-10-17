<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sku' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'gallery' => ['required', 'array'],
            'gallery.*' => [
                Rule::requiredIf(function() {
                    return $this->routeIs('admin.products.store');
                }),
                'image',
                'max:50000',
            ],
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'Необходимо указать артикул!',
            'name.required' => 'Необходимо указать заголовок!',
            'slug.required' => 'Необходимо указать псевдоним!',
            'description.required' => 'Необходимо заполнить описание!',
            'price.required' => 'Необходимо указать цену!',
            'category_id.required' => 'Необходимо выбрать категорию!',
            'gallery.required' => 'Необходимо выбрать изображение',
            'gallery.*.image' => 'Допустимые форматы загрузки излбражения: jpeg, bmp, png!',
            'gallery.*.max' => 'Допустимый размер файла 5мб !',
        ];
    }
}


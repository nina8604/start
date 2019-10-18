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
            'sku' => ['required', 'integer', Rule::unique('products', 'sku')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
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
            'sku.integer' => 'Необходимо указать числовое значение!',
            'sku.unique' => 'Значение должно быть уникальным!',
            'name.required' => 'Необходимо указать заголовок!',
            'slug.required' => 'Необходимо указать псевдоним!',
            'description.required' => 'Необходимо заполнить описание!',
            'price.required' => 'Необходимо указать цену!',
            'price.numeric' => 'Необходимо указать числовое значение!',
            'category_id.required' => 'Необходимо выбрать категорию!',
            'gallery.required' => 'Необходимо выбрать изображение',
            'gallery.*.image' => 'Допустимые форматы загрузки излбражения: jpeg, png, bmp, gif, svg, or webp!',
            'gallery.*.max' => 'Допустимый размер файла 5мб !',
        ];
    }
}


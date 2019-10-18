<?php /* @var array $errors */ ?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST"
                      @if($product->exists)
                        action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                      @else
                        action="{{ route('admin.products.store') }}"
                      @endif
                      enctype = 'multipart/form-data' >

                    @csrf

                    @if($product->exists)
                        @method('PUT')
                    @endif

{{--                    @component('admin.includes.fileFormGroup', ['errors' => $errors, 'property' => 'file', 'label' => ''])--}}
{{--                        <input type="file" name="file" class="form-control-file" id="categoryFile" @if(!isset($category->file_name))  @endif/>--}}
{{--                    @endcomponent--}}

{{--                    <div class="col-sm-6form-group row">--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <div id="showFile" class="card card-body bg-light">--}}
{{--                                @isset($category->file_name)--}}
{{--                                    <img src="{{ $category->assetToAbsolute($category->file_name) }}" alt="" class="img-fluid">--}}
{{--                                @endisset--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <br>
                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'sku', 'label' => 'Артикул'])
                        <input type="text" class="form-control" name="sku" id="inputSku" value="{{ old('sku') ? old('sku') : $product->sku }}" >
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'name', 'label' => 'Название'])
                        <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') ? old('name') : $product->name }}" >
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'slug', 'label' => 'Псевдоним'])
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') ? old('slug') : $product->slug }}" >
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'description', 'label' => 'Описание'])
                        <textarea class="form-control" id="TextareaDescription" name="description" rows="3">{{ old('description') ? old('description') : $product->description }}</textarea>
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'price', 'label' => 'Цена'])
                        <input type="text" class="form-control" name="price" value="{{ old('price') ? old('price') : $product->price }}" >
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'category_id', 'label' => 'Категория'])
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">Выберите категорию</option>
                            @forelse($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($category->id == old('category_id'))
                                        selected
                                        @elseif(isset($product) && $category->id == $product->category_id)
                                        selected
                                    @endif
                                >{{ $category->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'gallery', 'label' => 'Изображения галереи'])
                    <input class="form-control-file" type="file" name="gallery[]" multiple />
                    @endcomponent

                    <br>
                    <div class="row">
                        <div class="col-sm-4 d-flex flex-wrap">
                            @if($product->id and count($product->pictures))
                                @foreach($product->pictures as $picture)
                                    <div class="col-sm-4">
                                        <div class="card card-body bg-light">
                                            <span class="admin-image-delete">
                                                <i class="fa fa-times-circle-o delete-action-photo" aria-hidden="true" data-id="{{ $picture->id }}"></i>
                                            </span>
                                            <img src="{{ $picture->assetToAbsolute($picture->path) }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>



                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function() {
            $('#{{$product->id}}').on("click", function(){
                let input = document.createElement('INPUT');
                input.name = "picture_id[]";
                input.type = 'hidden';
                input.value = this.id;
                $('form').appendChild(input);
            });
        });

    </script>
@endsection

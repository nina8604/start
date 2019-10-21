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
                        <div class="col-12 d-flex flex-wrap">
                            @if($product->id and count($product->pictures))
                                @foreach($product->pictures as $picture)
                                    <div  class="col-sm-4">
{{--                                        <div class="card card-body bg-light" style="display: block;">--}}
                                        <div class="card card-body bg-light" style="opacity: 1;">
                                            <div class="icons-flex" style="display: flex;">
                                                <span class="admin-image-delete" style="margin-right: 10px;">
                                                    <i class="fa fa-times-circle-o delete-action-photo" aria-hidden="true" id="{{ $picture->id }}"></i>
                                                </span>
                                                <span class="admin-image-restore">
                                                    <i class="fa fa-window-restore restore-action-photo" aria-hidden="true" data-id="{{ $picture->id }}"></i>
                                                </span>

                                            </div>
{{--                                            <span class="admin-image-delete" style="display: inline-block;">--}}
{{--                                                <i class="fa fa-times-circle-o delete-action-photo" aria-hidden="true" id="{{ $picture->id }}"></i>--}}
{{--                                            </span>--}}
                                            <img src="{{ $picture->assetToAbsolute($picture->path) }}" alt="" class="img-fluid" >
{{--                                            <img src="{{ $picture->assetToAbsolute($picture->path) }}" alt="" class="img-thumbnail">--}}
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

        function preloadPicture(evt, containerId){
            let file = evt.target.files;
            let pictureFile = file[0];

            let reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {

                    $('#' + containerId).html(['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '" />'].join(''));
                };
            })(pictureFile);
            // Read in the image file as a data URL.
            reader.readAsDataURL(pictureFile);
        }
        // $(document).ready(function() {
        //     $('#categoryFile').on("change", function(evt){
        //         preloadPicture(evt, 'showFile');
        //     });
        // });

        $(document).ready(function() {
            $('.admin-image-delete i').on("click", function() {
                let inp = $(`form input[data-id=${ $(this).attr('id') }]`);
                if ( inp.length >= 1  ) return;
                // console.log()
                // $(this).parent().parent().attr('style', 'display: none;');

                let input = document.createElement('INPUT');
                // $(this).parent().parent().attr('style', 'opacity: 0.4;');

                $(this).parent().parent().next().attr('style', 'opacity: 0.4;');
                $(this).attr('style', 'opacity: 0.4;');
                // $(this).parent().parent().prepend('<span class="admin-image-restore" style="display: inline-block;"><i class="fa fa-window-restore restore-action-photo" aria-hidden="true"></i></span>');
                $(input).attr('data-id', $(this).attr('id'));
                input.name = "pictures_id[]";
                input.type = 'hidden';
                input.value = $(this).attr('id');
                $('form').append(input);
            });
            $('.admin-image-restore i').on("click", function() {

                $(this).parent().parent().next().attr('style', 'opacity: 1;');
                $('.admin-image-delete i').attr('style', 'opacity: 1;');
                // console.log($(`form input[data-id=${ $(this).attr('data-id') }]`));
                $(`form input[data-id=${ $(this).attr('data-id') }]`).remove();
            })
        });

    </script>
@endsection

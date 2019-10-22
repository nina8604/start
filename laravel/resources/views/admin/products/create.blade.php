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
                    <input id="fileUpload" class="form-control-file" type="file" name="gallery[]" multiple />
                    @endcomponent

                    <br>
                    <div class="row">
{{--                        <div id="image-holder" class="col-12 d-flex flex-wrap ">--}}
                            <ul id="sortable" class="col-12 d-flex flex-wrap ">
                                @if($product->id and count($product->pictures))
                                    @foreach($product->pictures->orderBy('ordering', 'asc')->get() as $picture)
                                        <li class="ui-state-default">
                                            <div  class="col-sm-4">
                                                <div class="card card-body bg-light">
                                                    <div class="icons-flex" style="display: flex;">
                                                <span class="admin-image-delete" style="margin-right: 10px;">
                                                    <i class="fa fa-times-circle-o delete-action-photo" aria-hidden="true" id="{{ $picture->id }}"></i>
                                                </span>
                                                        <span class="admin-image-restore">
                                                    <i class="fa fa-window-restore restore-action-photo" aria-hidden="true" data-id="{{ $picture->id }}"></i>
                                                </span>

                                                    </div>
                                                    <img src="{{ $picture->assetToAbsolute($picture->path) }}" alt="" class="img-fluid" >
                                                    <input name="ordering[]" class="ordering-file" type="hidden" value="{{ $picture->ordering }}">
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
{{--                        </div>--}}
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
            // Predelete picture
            $('.admin-image-delete i').on("click", function() {
                let inp = $(`form input[data-id=${ $(this).attr('id') }]`);
                if ( inp.length >= 1  ) return;
                let input = document.createElement('INPUT');

                $(this).parent().parent().next().attr('style', 'opacity: 0.4;');
                $(this).attr('style', 'opacity: 0.4;');
                $(input).attr('data-id', $(this).attr('id'));
                input.name = "pictures_id[]";
                input.type = 'hidden';
                input.value = $(this).attr('id');
                $('form').append(input);
            });
            // Restore picture
            $('.admin-image-restore i').on("click", function() {

                $(this).parent().parent().next().attr('style', 'opacity: 1;');
                $('.admin-image-delete i').attr('style', 'opacity: 1;');
                $(`form input[data-id=${ $(this).attr('data-id') }]`).remove();
            })

            // Preview pictures before save to database
            $("#fileUpload").on('change', function () {

                //Get count of selected files
                let countFiles = $(this)[0].files.length;

                let imgPath = $(this)[0].value;
                let extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                let image_holder = $("#sortable");

                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof (FileReader) != "undefined") {

                        //loop for each file selected for uploaded.
                        for (let i = 0; i < countFiles; i++) {

                            let reader = new FileReader();
                            reader.onload = function (e) {
                                let liIndex = $('#sortable li:last-child').index() + 2;
                                $(image_holder).append([
                                    '<li class="ui-state-default"><div class="col-sm-4"><div class="card card-body bg-light"><img src="',
                                    e.target.result,
                                    '" class="img-fluid"/><input type="hidden" class="ordering-file" name="ordering[]" value="',
                                    liIndex,
                                    '"></div></div></li>'
                                ].join(''));
                            };
                            reader.readAsDataURL($(this)[0].files[i]);
                        }

                    } else {
                        alert("Этот браузер не поддерживает FileReader.");
                    }
                } else {
                    alert("Пожалуйста, выберите только картинки");
                }
            });

            // sortable pictures
            $( function() {
                $( "#sortable" ).sortable();
                $( "#sortable" ).disableSelection();
            } );

        });

    </script>
@endsection

<?php /* @var array $errors */ ?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST"
                      @if($category->exists)
                        action="{{ route('admin.categories.update', ['category' => $category->id]) }}"
                      @else
                        action="{{ route('admin.categories.store') }}"
                      @endif
                      enctype = 'multipart/form-data' >

                    @csrf

                    @if($category->exists)
                        @method('PUT')
                    @endif

                    @component('admin.includes.fileFormGroup', ['errors' => $errors, 'property' => 'file', 'label' => ''])
                        <input type="file" name="file" class="form-control-file" id="categoryFile" @if(!isset($category->file_name))  @endif/>
                    @endcomponent

                    <div class="col-sm-6form-group row">
                        <div class="col-sm-4">
                            @isset($category->file_name)
                                <div class="card card-body bg-light" id="showFile">
                                    <img src="{{ $category->assetToAbsolute($category->file_name) }}" alt="" class="img-fluid">
                                </div>
                            @endisset
                        </div>
                    </div>
                    <br>
                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'name', 'label' => 'Название'])
                        <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') ? old('name') : $category->name }}" >
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'slug', 'label' => 'Псевдоним'])
                        <input type="text" class="form-control" name="slug" value="{{ old('slug') ? old('slug') : $category->slug }}" >
                    @endcomponent

                    @component('admin.includes.formGroup', ['errors' => $errors, 'property' => 'description', 'label' => 'Описание'])
                        <textarea class="form-control" id="TextareaDescription" name="description" rows="3">{{ old('description') ? old('description') : $category->description }}</textarea>
                    @endcomponent

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
                    $('#' + containerId).find('img').remove();
                    $('#' + containerId).html(['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '" />'].join(''));
                };
            })(pictureFile);
            // Read in the image file as a data URL.
            reader.readAsDataURL(pictureFile);
        }
        $(document).ready(function() {
            $('#categoryFile').on("change", function(evt){
                preloadPicture(evt, 'showFile');
            });
        });

    </script>
@endsection

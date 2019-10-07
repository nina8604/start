@extends('layouts.app')

@section('content')

    <div class="container">
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

                    <div class="form-group @if($errors->has('file')) has-error @endif">
                        <label for="exampleFormControlFile1">Choose File</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        @if($errors->has('file'))
                            <div class="help-block">{{ $errors->first('file') }}</div>
                        @endif
                    </div>
                    <div class="form-group row @if($errors->has('name')) has-error @endif">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name') ? old('name') : $category->name }}" >
                            @if($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="form-group row @if($errors->has('slug')) has-error @endif">
                        <label for="inputSlug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="slug" id="inputSlug" value="{{ old('slug') ? old('slug') : $category->slug }}" >
                            @if($errors->has('slug'))
                                <div class="help-block">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                        <label for="TextareaDescription">Description</label>
                        <textarea class="form-control" id="TextareaDescription" name="description" rows="3">{{ old('description') ? old('description') : $category->description }}</textarea>
                        @if($errors->has('description'))
                            <div class="help-block">{{ $errors->first('description') }}</div>
                        @endif
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

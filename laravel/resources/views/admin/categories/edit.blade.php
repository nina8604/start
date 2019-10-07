@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.categories.update', ['category' => $categories->id]) }}" method="post" enctype = 'multipart/form-data'>
                    @method('PUT')
                    @csrf
                    <div class="form-group @if($errors->has('file')) has-error @endif">
{{--                        <div><img src="{{ $categories->assetToAbsolute($categories->file_name) }}" class="card-img-top" alt="..." width="200" height="250"></div>--}}
                        <label for="exampleFormControlFile1">Choose File</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        @if($errors->has('file'))
                            <div class="help-block">{{ $errors->first('file') }}</div>
                        @endif
                    </div>
                    <div class="form-group row @if($errors->has('name')) has-error @endif">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="inputName" value="{{ $categories->name }}">
                            @if($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row @if($errors->has('slug')) has-error @endif">
                        <label for="inputSlug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="slug" id="inputSlug" value="{{ $categories->slug }}">
                            @if($errors->has('slug'))
                                <div class="help-block">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                        <label for="TextareaDescription">Description</label>
                        <textarea class="form-control" id="TextareaDescription" name="description" rows="3">{{ $categories->description }}</textarea>
                        @if($errors->has('description'))
                            <div class="help-block">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

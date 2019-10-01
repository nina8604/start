@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.categories.update', ['category' => $categories->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="name" id="inputName" value="{{ $categories->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSlug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="slug" class="form-control" name="slug" id="inputSlug" value="{{ $categories->slug }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="TextareaDescription">Description</label>
                        <textarea class="form-control" id="TextareaDescription" name="description" rows="3">{{ $categories->description }}</textarea>
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

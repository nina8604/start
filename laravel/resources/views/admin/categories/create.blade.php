@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.categories.store') }}" method="post" enctype = 'multipart/form-data' >

                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose File</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" name="name" id="inputName" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSlug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="slug" class="form-control" name="slug" id="inputSlug" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="TextareaDescription">Description</label>
                        <textarea class="form-control" id="TextareaDescription" name="description" rows="3"></textarea>
                    </div>
{{--                    <div class="input-group">--}}
{{--                        <div class="custom-file">--}}
{{--                            <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">--}}
{{--                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>--}}
{{--                        </div>--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

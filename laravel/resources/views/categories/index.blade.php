@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Categories list</h1>
            </div>
        </div>
        <div class="row">

            @foreach($categories as $category)
                <div class="col-12">
                    <div class="card mb-3">
                        <img src="{{ $category->assetToAbsolute($category->file_name) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <p class="card-text">
                                <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="btn btn-default">Show more</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

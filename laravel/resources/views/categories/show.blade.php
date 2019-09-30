@extends('layouts.app')

@section('content')

    <div class="row ">
        <div class="col-12">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <dl class="col-12 my-2">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $category->name }}</dd>
        </dl>
        <dl class="col-12 my-2">
            <dt class="col-sm-3">Description</dt>
            <dd class="col-sm-9">{{ $category->description }}</dd>
        </dl>
    </div>
    <div class="row">

        @foreach($category->products as $product)
            <div class="col-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @if($product->picture)
                                <img src="{{ $product->picture->thumbnail }}" class="card-img" alt="...">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->price }}</p>
                                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-default">Show more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@extends('layouts.index')

@section('content')

    <div class="row ">

        <div class="col-12">
            <a href="{{ route('categories.show', ['category' => $product->category['id']]) }}" class="btn btn-secondary">Back</a>
        </div>

        <div>
{{--            <img src="{{ $product->picture['path'] }}" width="300" alt="">--}}
            <img src="" width="300" alt="">
        </div>

        <dl class="col-12 my-2">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $product->name }}</dd>
        </dl>

        <dl class="col-12 my-2">
            <dt class="col-sm-3">Category</dt>
            <dd class="col-sm-9"><a href="{{ route('categories.show', ['category' => $product->category['id']]) }}">{{ $product->category['name'] }}</a></dd>
        </dl>

        <dl class="col-12 my-2">
            <dt class="col-sm-3">SKU</dt>
            <dd class="col-sm-9">{{ $product->sku }}</dd>
        </dl>

        <dl class="col-12 my-2">
            <dt class="col-sm-3">Description</dt>
            <dd class="col-sm-9">{{ $product->description }}</dd>
        </dl>

        <dl class="col-12 my-2">
            <dt class="col-sm-3">Price</dt>
            <dd class="col-sm-9">{{ $product->price }}</dd>
        </dl>

    </div>

@endsection

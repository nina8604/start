@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Products list</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-lg" >Create new Product</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Picture</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{ $loop -> index + 1 }}</th>
                            <td>
{{--                                <img src="{{ $product->assetToAbsolute($product->file_name) }}" class="card-img-top" alt="...">--}}
                            </td>
                            <td>{{ $product -> sku }}</td>
                            <td>{{ $product -> name }}</td>
                            <td>{{ $product -> slug }}</td>
                            <td>{{ $product -> description }}</td>
                            <td>{{ $product -> price }}</td>
                            <td>{{ $product -> category -> name }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn" >Edit</a>
                                <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

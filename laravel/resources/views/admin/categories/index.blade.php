@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Categories list</h1>
            </div>
        </div>
        <div class="row">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)

                    <tr>
                        <th scope="row">{{ $loop -> index + 1 }}</th>
                        <td>{{ $category -> name }}</td>
                        <td>{{ $category -> slug }}</td>
                        <td>{{ $category -> description }}</td>
                        <td>
                            
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

            @foreach($categories as $category)
                {{--                <div class="col-12">--}}
                {{--                    <div class="card mb-3">--}}
                {{--                        <img src="{{ $category->path }}" class="card-img-top" alt="...">--}}
                {{--                        <div class="card-body">--}}
                {{--                            <h5 class="card-title">{{ $category->name }}</h5>--}}
                {{--                            <p class="card-text">{{ $category->description }}</p>--}}
                {{--                            <p class="card-text">--}}
                {{--                                <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="btn btn-default">Show more</a>--}}
                {{--                            </p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            @endforeach


        </div>
    </div>
@endsection

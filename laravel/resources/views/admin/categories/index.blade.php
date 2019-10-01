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
                                <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn" >Edit</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection

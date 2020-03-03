@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Vue.js</h1>
            </div>
        </div>
        <div id="app1" class="row">
            <h1 v-text="product"></h1>
            <button type="button" v-on:click="changeProduct">changeProduct</button>
        </div>
    </div>
@endsection

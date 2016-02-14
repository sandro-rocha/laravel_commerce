@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@stop

@if (session('product_destroy'))
    <div class="alert alert-success">
        {{ session('product_destroy') }}
    </div>
@endif

@section('content')
    <div class="col-sm-10 padding-right">
        <div class="features_items">
            <h2 class="title text-center">{{  $category->name }}</h2>
                @if(count($products))
                    @include('store.partial.products')

                @else
                    <div class="alert alert-warning">
                        Não há produtos cadastrado.
                    </div>
                @endif
        </div>
    </div>
@stop
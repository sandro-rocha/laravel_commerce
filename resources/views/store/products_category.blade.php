@extends('store.store')

@section('categories')
    @include('store.list.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Produtos da Categoria - </h2>

            @include('store.list.products')
        </div><!--features_items-->

    </div>
@stop
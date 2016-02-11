@extends('store.store')

@section('categories')
    @include('store.list.categories')
@stop

@section('content')
    <div class="col-sm-10 padding-right">
        <div class="features_items">
            <h2 class="title text-center">Categoria: {{  $category->name }}</h2>
            @if(count($pCategory))
              @include('store.list.products')
            @else
              <div class="alert alert-warning">
                Não há produtos cadastrado.
              </div>
            @endif
        </div>
    </div>
@stop
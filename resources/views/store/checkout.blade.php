@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            @if(isset($cart) == 'empty')
                <div class="alert alert-warning" style="margin-bottom: 50px">Carrinho de compras vazio!</div>
            @else
                <div class="alert alert-success" style="margin-bottom: 50px">Pedido realizado com sucesso!</div>
                <p>O pedido #{{ $order->id }}, foi realizado com sucesso.</p>
            @endif
        </div>
    </div>
@stop
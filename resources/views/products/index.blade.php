@extends('app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        @if (session('product_exist'))
            <div class="alert alert-danger">
                {{ session('product_exist') }}
            </div>
        @endif
        @if (session('product_destroy'))
            <div class="alert alert-success">
                {{ session('product_destroy') }}
            </div>
        @endif
        @if (session('product_edit'))
            <div class="alert alert-success">
                {{ session('product_edit') }}
            </div>
        @endif
        @if (session('product_update'))
            <div class="alert alert-success">
                {{ session('product_update') }}
            </div>
        @endif
        @if (session('product_store'))
            <div class="alert alert-success">
                {{ session('product_store') }}
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-success">New Product</a>
        <br />  <br />
        <table class="table table-responsive table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ number_format($product->price, 2,',','.') }}</td>
                <td>{{$product->category->name}}</td>
                <td>
                    <a href="{{ route('products.edit', ['id' => $product->id]) }}">Edit</a> |
                    <a href="{{ route('products.images', ['id' => $product->id]) }}">Images</a> |
                    <a href="{{ route('products.destroy', ['category' => $product->id]) }}">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>
@endsection
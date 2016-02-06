@extends('app')

@section('content')
    <div class="container">
        <h1>Products</h1>

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
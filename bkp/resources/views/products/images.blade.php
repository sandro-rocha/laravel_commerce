@extends('app')

@section('content')
    <div class="container">
        <h1>Images of: {{ $product->name }}</h1>

        <a href="{{ route('products.images.create', ['id'=>$product->id]) }}" class="btn btn-success">New Image</a>
        <br />  <br />
        <table class="table table-responsive table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Extension</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($product->images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td>
                    <img src="{{ url('uploads/'.$image->id.'.'.$image->extension) }}" width="80px">
                </td>
                <td>{{ $image->extension }}</td>
                <td>
                    <a href="{{ route('products.images.destroy', ['id'=>$image->id]) }}">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('products') }}" class="btn btn-success">Voltar</a>
    </div>
@endsection
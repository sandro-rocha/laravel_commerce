@extends('app')

@section('content')
    <div class="container">
        <h1>Create Categories</h1>

        @if($errors->any())

            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li style="margin-left: 20px">{{ $error }}</li>
                @endforeach
            </ul>

        @endif

        {!! Form::open(['url'=>'admin\categories']) !!}

        @include('categories._form')

        <div class="form-group">

            {!! Form::submit('Add Category', ['class'=>'btn btn-primary']) !!}
            <a href="{{ route('categories') }}" class="btn btn-default">Voltar</a>

        </div>

        {!! Form::close() !!}

    </div>
@endsection
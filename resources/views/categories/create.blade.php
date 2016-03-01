@extends('app')

@section('content')
    <div class="container">
        <h1>Create Categories</h1>

        @if($errors->any())

            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li style="margin-left: 20px>{{ $error }}</li>
                @endforeach
            </ul>

        @endif

        {!! Form::open(['route'=>'categories', 'method'=>'post']) !!}

        <div class="form-group">

            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            <br />
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::submit('Add Category', ['class'=>'btn btn-primary']) !!}
            <a href="{{ route('categories') }}" class="btn btn-success">Voltar</a>

        </div>

        {!! Form::close() !!}

    </div>
@endsection
@extends('items::main')

@section('content')
    <div class="form-group">

        {!! Form::open(['url' => route('itemAdd'), 'method' => 'post', 'files' => TRUE, 'class' => 'form-horizontal']) !!}

        <div class="form-group">
            {{  Form::label('title', 'Title', ['class' => 'col-sm-1 test-title'])}}
            <div class="col-sm-10">
                {{  Form::text('title', '',  ['class' => 'form-control'])}}
            </div>

        </div>

        <div class="form-group">
            {{  Form::label('title', 'Second title', ['class' => 'col-sm-1 test-title'])}}
            <div class="col-sm-10">
                {{  Form::text('second_title', '',  ['class' => 'form-control'])}}
            </div>

        </div>

        <div class="form-group">
            {{  Form::label('image', 'Image', ['class' => 'col-sm-1 test-title'])}}
            <div class="col-sm-10">
                {{  Form::file('image', ['class' => 'form-control'])}}
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-10">
                {{  Form::submit('Submit', ['class' => 'btn btn-default'])}}
            </div>


        </div>

        {!! Form::close() !!}
    </div>

@endsection
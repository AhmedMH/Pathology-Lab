@extends('layouts.app')

@section('content')

    <h1>Add Patient</h1>
    {!! Form::open(['url' => 'patients']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control' , 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-mail:') !!}
        {!! Form::email('email',null,['class'=>'form-control' , 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('mobile', 'Mobile:') !!}
        {!! Form::number('mobile',null,['class'=>'form-control' , 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password',['class'=>'form-control' , 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password:') !!}
        {!! Form::password('password_confirmation',['class'=>'form-control' , 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@endsection
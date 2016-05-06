@extends('layouts.app')

@section('content')

    <h1>Create Patient</h1>
    {!! Form::model($patient,['method' => 'PATCH','route'=>['patients.update',$patient->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control','required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-mail:') !!}
        {!! Form::email('email',null,['class'=>'form-control','required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('mobile', 'Mobile:') !!}
        {!! Form::number('mobile',null,['class'=>'form-control','required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
    </div>
    {!! Form::close() !!}

@endsection
@extends('layouts.app')

@section('content')

    <h1>Edit Test</h1>
    {!! Form::model($test,['method' => 'PATCH','route'=>['tests.update',$test->id]]) !!}
         <div class="form-group">
            {!! Form::text('name',null,['placeholder' => 'Test Name', 'class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('result',null,['placeholder' => 'Test Result', 'class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
        </div>
    {!! Form::close() !!}

@endsection
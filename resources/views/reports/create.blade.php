@extends('layouts.app')

@section('content')

    <h1>Create Report</h1>
    {!! Form::open(['url' => 'reports']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('patient', 'Patient') !!}
        {!! Form::select('patient_id', [null=>'Please Select'] + $patients->toArray(), null , ['class'=>'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@endsection
@extends('layouts.app')

@section('content')

    <h1>Create Report</h1>
    {!! Form::model($report,['method' => 'PATCH','route'=>['reports.update',$report->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('patient', 'Patient') !!}
        {!! Form::select('patient_id', [null=>'Please Select'] + $patients->toArray(), $report->patient->id , ['class'=>'form-control', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
    </div>
    {!! Form::close() !!}

@endsection
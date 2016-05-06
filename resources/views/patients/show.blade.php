@extends('layouts.app')

@section('content')

<h1>Patient Information</h1>

    <form class="form-horizontal">
        <div class="form-group">
            <label for="id" class="col-sm-2 control-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id" value={{$patient->id}} readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" value={{$patient->name}} readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" value={{$patient->email}} readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="mobile" class="col-sm-2 control-label">Mobile</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mobile" value={{$patient->mobile}} readonly>
            </div>
        </div>
    </form>
        <br/>
    <a href="{{ url('patients') }}" class="btn btn-info"><i class="fa fa-btn fa-arrow-left"></i> Back to all patients</a>
    <a href="{{route('patients.edit',$patient->id)}}" class="btn btn-primary"><i class="fa fa-btn fa-edit"></i> Edit Patient</a>

    <div class="pull-right">
        {!! Form::open(['method' => 'DELETE', 'route'=>['patients.destroy', $patient->id]]) !!}
        {!! Form::button('<i class="fa fa-btn fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger','onclick' => 'return confirm("Are you sure you want to delete this patient?");']) !!}
        {!! Form::close() !!}
    </div>

@endsection
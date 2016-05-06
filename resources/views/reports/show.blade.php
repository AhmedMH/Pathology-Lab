@extends('layouts.app')

@section('content')
    <div class="row well">
        <a href="{{ url('reports') }}" class="btn btn-info"><i class="fa fa-btn fa-arrow-left"></i> Back to all reports</a>

        @role('operator')
        <a href="{{route('reports.edit',$report->id)}}" class="btn btn-primary"><i class="fa fa-btn fa-edit"></i> Edit Report</a>

        <div class="pull-right">
            {!! Form::open(['method' => 'DELETE', 'route'=>['reports.destroy', $report->id]]) !!}
            {!! Form::button('<i class="fa fa-btn fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger','onclick' => 'return confirm("Are you sure you want to delete this report?");']) !!}
            {!! Form::close() !!}
        </div>
        @endrole

        @role('patient')
            <a href="{{url('pdf/'.$report->id)}}" class="btn btn-success"><i class="fa fa-btn fa-download"></i> Export as PDF</a>
            <div class="pull-right">
                {!! Form::open(['url' => 'mail/'.$report->id,'class'=>'form-inline']) !!}
                    <div class="form-group">
                        <label class="sr-only">Email address</label>
                        <input type="email" required value="{{$report->patient->email}}" class="form-control" name="email" placeholder="Email">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-send"></i> Send to E-mail</button>
                {!! Form::close() !!}
            </div>
        @endrole
    </div>

    <div class="row">
        <div class="col-md-3">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Report Details:</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12"><strong>Report ID: </strong>{{$report->id}}</div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12"><strong>Report Name: </strong>{{$report->name}}</div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12"><strong>Patient name: </strong>{{$report->patient->name}}</div>
                    </div>  
                    <br/>
                    <div class="row">
                        <div class="col-md-12"><strong>Created by: </strong>{{$report->operator->name}}</div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12"><strong>Created At: </strong>{{$report->created_at->format('d M Y - g:i A')}}</div>
                    </div>  
                    <br />
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <table class="table table-bordered">
                <thead> 
                    <tr class="info"> 
                        <th>Test Name</th> 
                        <th>Test Result</th>
                        @role('operator')
                            <th colspan="2">Actions</th>
                        @endrole
                    </tr> 
                </thead>
                @role('operator')
                    <tr> 
                        {!! Form::open(['url' => 'tests']) !!}
                        {!! Form::text('report_id',$report->id,['hidden' => 'hidden']) !!}
                        <td>
                            <div class="form-group">
                                {!! Form::text('name',null,['placeholder' => 'Test Name', 'class'=>'form-control', 'required']) !!}
                            </div>
                        </td> 
                        <td>
                            <div class="form-group">
                                {!! Form::text('result',null,['placeholder' => 'Test Result', 'class'=>'form-control', 'required']) !!}
                            </div>
                        </td>
                        <td colspan="2" align="center">
                            <div class="form-group">
                                {!! Form::submit('Add New Test', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </td>
                        {!! Form::close() !!}
                    </tr> 
                @endrole
                @forelse ($tests as $test)
                    <tr>
                        <td>{{$test->name}}</td>
                        <td>{{$test->result}}</td>
                        @role('operator')
                            <td align="center"><a href="{{route('tests.edit',$test->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-btn fa-edit"></i> Update</a></td>
                            <td align="center">
                               {!! Form::open(['method' => 'DELETE', 'route'=>['tests.destroy', $test->id]]) !!}
                               {!! Form::button('<i class="fa fa-btn fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm','onclick' => 'return confirm("Are you sure you want to delete this test?");']) !!}
                               {!! Form::close() !!}
                            </td>
                        @endrole
                    </tr>
                @empty
                    <br>
                    <h1 style="text-align:center;" class="text-muted">No tests yet in this report!</h1>
                @endforelse
            </table>
        </div>
    </div>
@endsection
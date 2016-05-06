@extends('layouts.app')

@section('content')

    <h1>Reports</h1>
    @role('operator')
        <a href="{{url('/reports/create')}}" class="btn btn-success">Create Report</a>
    @endrole
    <hr>
    <table class="table table-striped table-bordered table-hover">
       <thead>
           <tr class="bg-info">
            <th>#</th>
            <th>Name</th>
            <th>Patient</th>
            <th>Operator</th>
            <th colspan="3">Actions</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($reports as $index => $report)
       <tr>
           <td>{{ $index+1 }}</td>
           <td>{{ $report->name }}</td>
           <td>{{ $report->patient->name }}</td>
           <td>{{ $report->operator->name }}</td>

           <td><a href="{{url('reports',$report->id)}}" class="btn btn-primary"><i class="fa fa-btn fa-eye"></i> View</a></td>
           @role('operator')
               <td><a href="{{route('reports.edit',$report->id)}}" class="btn btn-warning"><i class="fa fa-btn fa-edit"></i> Update</a></td>
               <td>
                   {!! Form::open(['method' => 'DELETE', 'route'=>['reports.destroy', $report->id]]) !!}
                   {!! Form::button('<i class="fa fa-btn fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger','onclick' => 'return confirm("Are you sure you want to delete this report?");']) !!}
                   {!! Form::close() !!}
               </td>
           @endrole
       </tr>
       @empty
            <h1 style="text-align:center;" class="text-muted">No reports yet!</h1>
       @endforelse
    </tbody>

    </table>

    {!! $reports->links() !!}
@endsection
@extends('layouts.app')

@section('content')

    <h1>Patients</h1>
    <a href="{{url('/patients/create')}}" class="btn btn-success">Add Patient</a>
    <hr>
    <table class="table table-striped table-bordered table-hover">
       <thead>
           <tr class="bg-info">
               <th>#</th>
               <th>Name</th>
               <th>E-mail</th>
               <th>Mobile</th>
               <th colspan="3">Actions</th>
           </tr>
       </thead>
       <tbody>
           @forelse ($patients as $index => $patient)
           <tr>
               <td>{{ $index+1 }}</td>
               <td>{{ $patient->name }}</td>
               <td>{{ $patient->email }}</td>
               <td>{{ $patient->mobile }}</td>

               <td><a href="{{url('patients',$patient->id)}}" class="btn btn-primary"><i class="fa fa-btn fa-eye"></i> View</a></td>
               <td><a href="{{route('patients.edit',$patient->id)}}" class="btn btn-warning"><i class="fa fa-btn fa-edit"></i> Update</a></td>
               <td>
                   {!! Form::open(['method' => 'DELETE', 'route'=>['patients.destroy', $patient->id]]) !!}
                   {!! Form::button('<i class="fa fa-btn fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger','onclick' => 'return confirm("Are you sure you want to delete this patient?");']) !!}
                   {!! Form::close() !!}
               </td>
           </tr>
           @empty
           <h1 style="text-align:center;" class="text-muted">No patients yet!</h1>
           @endforelse

       </tbody>

    </table>

    {!! $patients->links() !!}

@endsection
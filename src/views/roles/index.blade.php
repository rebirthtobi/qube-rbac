@extends('layout.app')

@section('title', 'Roles')

@section('datatable-css')
    <link href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Roles
                </div>
                <div class="panel-body">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td> {{$role->name}} </td>
                                    <td> {{str_limit($role->description, 50)}} </td>
                                    <td>
                                        <a href="{{route('role.edit', $role->id)}}" class="btn btn-xs btn-info">Edit</a>
                                        <a href="{{route('role.view', $role->id)}}" class="btn btn-xs btn-success">View</a>
                                        <a href="{{route('role.delete', $role->id)}}" class="btn btn-xs btn-danger">Delete</a>
                                        @if(is_null($role->deleted_at))
                                            <a href="{{route('role.deactivate', $role->id)}}" class="btn btn-xs btn-danger">Deactivate</a>  
                                        @else
                                            <a href="{{route('role.activate', $role->id)}}" class="btn btn-xs btn-primary">Activate</a>  
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
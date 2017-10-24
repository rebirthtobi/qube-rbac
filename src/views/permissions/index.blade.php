@extends('layout.app')

@section('title', 'Permissions')

@section('datatable-css')
    <!--TODO input links for datatables -->
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
                    All Permission
                </div>
                <div class="panel-body">
                    <table id="myTable" class="table table-striped myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Controller</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td> {{$permission->name}} </td>
                                    <td> {{substr($permission->controller, strripos($permission->controller, '@') + 1)}} </td>
                                    <td> {{str_limit($permission->description, 50)}} </td>
                                    <td>
                                        <a href="{{route('permission.edit', $permission->id)}}" class="btn btn-xs btn-info">Edit</a>
                                        <a href="{{route('permission.delete', $permission->id)}}" class="btn btn-xs btn-danger">Delete</a>
                                        @if(is_null($permission->deleted_at))
                                            <a href="{{route('permission.deactivate', $permission->id)}}" class="btn btn-xs btn-danger">Deactivate</a>  
                                        @else
                                            <a href="{{route('permission.activate', $permission->id)}}" class="btn btn-xs btn-primary">Activate</a>  
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
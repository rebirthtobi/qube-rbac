@extends('layout.app')

@section('title', 'Edit Permission')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Permission</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('permission.update', $permission->id) }}">
                            <input name="_method" type="hidden" value="PATCH" />
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('controller') ? ' has-error' : '' }}">
                                <label for="controller" class="col-md-4 control-label">Controller</label>

                                <div class="col-md-6">
                                    <select id="controller" class="form-control" name="controller" required>
                                        @foreach($rbacs as $rbac)
                                            @if($rbac->controller == old(controller))
                                                <option value="{{ $rbac->controller }}" selected> {{ $rbac->value }} </option>
                                            @else
                                                <option value="{{ $rbac->controller }}"> {{ $rbac->value }} </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('controller'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('controller') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" rows="2">
                                        {{ old('description') }}
                                    </textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
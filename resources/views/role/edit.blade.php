@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('role.update',['id'=> $role->id])}}">
                @csrf
                <div class="form-group">
                    <label for="Role Name">Role Name</label>
                <input type="text" name="name" class="form-control" value='{{$role->name}}' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Guard Name</label>
                    <input type="text" name="guard_name" class="form-control" value='{{$role->guard_name}}'>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Permission Name</label>
                    <div class="container">
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-2 col-xs-3">
                            <input type="checkbox" class="form-check-input" name="permissions[]" value ="{{$permission->id}}" id="permission_{{$permission->id}}"
                            {{ $role->hasPermissionTo($permission->name)?'checked':'' }}>
                                <label class="form-check-label" for="exampleCheck1">{{ $permission->name}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

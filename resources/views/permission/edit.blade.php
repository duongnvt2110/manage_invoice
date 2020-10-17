@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('permission.update',['id'=> $permission->id])}}">
                @csrf
                <div class="form-group">
                    <label for="Permission Name">Permission Name</label>
                <input type="text" name="name" class="form-control" value='{{$permission->name}}' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Guard Name</label>
                    <input type="text" name="guard_name" class="form-control" value='{{$permission->guard_name}}'>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

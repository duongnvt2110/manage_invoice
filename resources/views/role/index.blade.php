@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-group">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success')}}
      </div>
    @endif
    <div class="pb-2">
        <a href="{{route('role.create')}}" class="btn btn-primary float-left">Create</a>
        <form class="form-inline float-right">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
    </div>

    </div>
    <table id="example" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Permission Name</th>
                <th>Guard Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <th>
                    @foreach($role->getPermissionNames() as $permission)
                        <span class="badge badge-primary">{{ $permission }}</span>
                    @endforeach
                </th>
                <td>{{ $role->guard_name }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="pr-2">
                            <a href="{{ route('role.edit',['id'=> $role->id ])}}" class="btn btn-primary">Edit</a>
                        </div>
                        <form method="POST" action="{{ route('role.delete',['id'=> $role->id ])}}" style="display: inline-flex;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>.
    </table>
</div>
@endsection

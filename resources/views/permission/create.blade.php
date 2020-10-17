@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('permission.store')}}">
                @csrf
                <div class="form-group">
                    <label for="Permssion Name">Permssion Name</label>
                    <input type="text" name="name" class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Guard Name</label>
                    <input type="text" name="guard_name" class="form-control" value=''>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

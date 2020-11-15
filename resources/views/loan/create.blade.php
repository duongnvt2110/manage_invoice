@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('loan.store')}}">
                @csrf
                <div class="form-group">
                    <label for="Role Name">Ammout</label>
                    <input type="text" name="amount" class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Description</label>
                    <textarea name="description" class="form-control" value=''></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

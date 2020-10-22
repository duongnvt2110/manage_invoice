@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('loan.update',['id'=> $loanApplication->id])}}">
                @csrf
                <div class="form-group">
                    <label for="Role Name"></label>
                    <a>{{$loanApplication->id }}</a>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Guard Name</label>
                    <a>{{$loanApplication->id }}</a>
                </div>
                @if($user->is_admin)
                    <div class="form-group">
                        <label for="Guard Name">Method</label>
                        <select  class="form-group" name="other_accept" id="method_accept">
                            <option value="0">Approve</option>
                            <option value="1">Reject</option>
                        </select>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

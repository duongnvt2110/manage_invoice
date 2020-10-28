@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Choose User</div>
        <div class="card-body">
                <form method="POST" action="{{route('loan.update',['id'=>$loanApplication->id])}}">
                    @csrf
                <div class="form-group" style="display:inline-flex;">
                    <div class="form-group">
                        <select class="form-control" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{ $user->user_name }} </option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                </form>
            </form>
        </div>
    </div>
</div>
@endsection

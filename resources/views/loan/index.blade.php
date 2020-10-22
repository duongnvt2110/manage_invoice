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
        @if(auth()->user()->hasRole('user'))
            <a href="{{route('loan.create')}}" class="btn btn-primary float-left">Create</a>
        @endif
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
                <th>Amount</th>
                @if($user->is_admin)
                <th>Analyst</th>
                <th>CFO</th>
                @endif
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loanApps as $loanApp)
            <tr>
                <td>{{ $loanApp->id }}</td>
                <td>{{ $loanApp->amount }}</td>
                @if($user->is_admin)
                    <td>{{ ($loanApp->userAnalyst->user_name)??'' }}</td>
                    <td>{{ $loanApp->userCfo->user_name??'' }}</td>
                @endif
                <th>{{ $loanApp->status->status }}</th>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="pr-2">
                            <a href="{{ route('loan.show',['id'=>$loanApp->id]) }}" class="btn btn-primary">View</a>
                        </div>
                        <div class="pr-2">
                            @if($user->is_admin && in_array($loanApp->status_id,[1,3,4]))
                                <a  href="{{ route('loan.analyzeEdit',['id'=>$loanApp->id])}}" class="btn btn-primary">
                                    @if($loanApp->status_id == 1)
                                        Send to Analyst
                                    @else
                                        Send to CFO
                                    @endif
                                </a>
                            @endif
                        </div>
                        <div class="pr-2">
                            @if(($user->is_analyst && in_array($loanApp->status_id,[2])) || ($user->is_cfo && in_array($loanApp->status_id,[5])))
                                <a  href="{{ route('loan.edit',['id'=>$loanApp->id])}}" class="btn btn-primary">
                                    Submit Analyze
                                </a>
                            @endif
                        </div>
                        <div class="pr-2">
                        @if($user->is_admin)
                            <form method="POST" action="{{ route('loan.delete',['id'=> $loanApp->id ])}}" style="display: inline-flex;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>.
    </table>
</div>
@endsection

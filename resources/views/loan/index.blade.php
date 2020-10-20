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
                @if(auth()->user()->hasRole('admin'))
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
                @if(auth()->user()->hasRole('admin'))
                    <td>{{ ($loanApp->userAnalyst->user_name)??'' }}</td>
                    <td>{{ $loanApp->userCfo->user_name??'' }}</td>
                @endif
                <th>{{ $loanApp->status->status }}</th>
                <td>
                    <div class="d-flex justify-content-center">

                            <div class="pr-2">
                                <form method="POST" action="{{ route('loan.update',['id'=> $loanApp->id ])}}" style="display: inline-flex;">
                                    @csrf
                                    @if(auth()->user()->hasRole('admin') && $loanApp->status_id == 2)
                                        <button type="submit" class="btn btn-primary">Send to Analyst</button>
                                    @endif
                                    @if(auth()->user()->hasRole('admin') && in_array($loanApp->status_id,[3,4]))
                                        <button type="submit" class="btn btn-primary">Send to CFO</button>
                                    @endif
                                    @if(auth()->user()->hasRole('admin') && in_array($loanApp->status_id,[6,7]))
                                        <button type="submit" class="btn btn-primary">Aprroved</button>
                                    @endif
                                </form>
                            </div>
                        @if(auth()->user()->hasRole('analyst') && $loanApp->status_id == 2)
                            <div class="pr-2">
                                <form method="POST" action="{{ route('loan.update',['id'=> $loanApp->id,'status'=>'3' ])}}" style="display: inline-flex;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Approved</button>
                                </form>
                                <form method="POST" action="{{ route('loan.update',['id'=> $loanApp->id,'status'=>'4'])}}" style="display: inline-flex;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Reject</button>
                                </form>
                            </div>
                        @endif
                        @if(auth()->user()->hasRole('cfo') && $loanApp->status_id == 5 )
                        <div class="pr-2">
                            <form method="POST" action="{{ route('loan.update',['id'=> $loanApp->id,'status'=>'6' ])}}" style="display: inline-flex;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Approved</button>
                            </form>
                            <form method="POST" action="{{ route('loan.update',['id'=> $loanApp->id,'status'=>'7'])}}" style="display: inline-flex;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Reject</button>
                            </form>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('loan.delete',['id'=> $loanApp->id ])}}" style="display: inline-flex;">
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

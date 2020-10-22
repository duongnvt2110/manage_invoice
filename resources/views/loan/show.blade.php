@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            View Loan Info
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $loanApplication->id }}</td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>{{ $loanApplication->amount }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $loanApplication->description }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th>{{ $loanApplication->status->status }}</th>
                    </tr>
                </tbody>.
            </table>
            @if($user->is_admin)
                <form method="POST" action="{{ route('loan.update',['id'=>$loanApplication->id]) }} ">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" name="status" id="">
                            <option value="1">Processing</option>
                            <option value="8">Approved</option>
                            <option value="9">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('loan.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection

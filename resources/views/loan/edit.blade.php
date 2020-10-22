@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Analyze</div>
        <div class="card-body">
                <div class="form-group" style="display:inline-flex;">
                    <form method="POST" action="{{route('loan.updateAnalyze',['id'=>$loanApplication->id,'status'=>0])}}">
                        @csrf
                            <button type="submit" class="btn btn-primary">Approved</button>
                    </form>
                </div>
                <div class="form-group" style="display:inline-flex;">
                    <form method="POST" action="{{route('loan.updateAnalyze',['id'=>$loanApplication->id,'status'=>1])}}">
                        @csrf
                            <button type="submit" class="btn btn-danger">Rejected</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

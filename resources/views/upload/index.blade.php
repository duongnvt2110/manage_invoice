@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('upload.upload') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="file" class="form-control-file" name="files" id="inputFile" required="true">
                </div>
                <br/>
                <input type="submit" class="btn btn-primary" value="Upload">
            </form>
        </div>
    </div>
</div>
@endsection

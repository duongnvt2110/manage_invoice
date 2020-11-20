@extends('layouts.app')

@section('content')
<div class="container">
    <div class="input-group" style="width:100%;margin-top:30px;">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success')}}
        </div>
        @endif
        <div style="width:100%;">
            <div class="form-inline float-left">
                <a href="{{route('customer.create')}}" class="btn btn-primary float-left">Tạo mới</a>
            </div>
            <div class="form-inline float-right">

                <form method="get" action="{{ route('customer.index') }}" style="display: inline-flex;">
                    {{-- @csrf --}}
                    <input class="form-control mr-sm-2" id="search" type="search_keyword" name="search_keyword" value="{{ old('search_keyword') }}" placeholder="Search" aria-label="Search">
                    <button type="submit" class="btn btn-success">Tìm Kiếm</button>
                </form>
            </div>
        </div>
    </div>
    <table id="example" class="table table-bordered" style="width:100%;margin-top:30px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->customer_name }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="pr-2">
                            <a href="{{ route('export.index',['id'=> $customer->id ])}}" class="btn btn-success">Export</a>
                        </div>
                        <div class="pr-2">
                            <a href="{{ route('customer.edit',['id'=> $customer->id ])}}" class="btn btn-primary">Sửa</a>
                        </div>
                        <form method="POST" action="{{ route('customer.delete',['id'=> $customer->id ])}}" style="display: inline-flex;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
</div>
<script>
    // $(document).ready(function(){
    //     $('#search').keyup(function(){
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         keyword = $('#search').val();
    //         $.ajax({
    //             method: "POST",
    //             url: "#",
    //             data: {keyword: keyword},
    //             success: function(result){
    //                 if(result['status'] == 0){
    //                     $customers = result['customer'];
    //                 }
    //             }
    //         });
    //     });
    // });
</script>
@endsection

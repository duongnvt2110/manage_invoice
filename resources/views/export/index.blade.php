@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" id='alert-success' role="alert">
            {{ Session::get('success')}}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
                <a type="submit" class="btn btn-secondary" href="{{ route('customer.index') }}">Quay về</a>
                <div class="customer-form">
                    <div class="form-group" style="padding-top:20px;">
                        <label for="Role Name"><span class="badge badge-secondary">Tên Khách Hàng<span></label>
                    <input type="text" name="customer_name" class="form-control" value='{{$customer->customer_name}}' required>
                    </div>
                    <table id="customer" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Vị</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($customer->invoices))
                                @foreach ($customer->invoices as $invoice)
                                    <tr><th><span class="badge badge-secondary">Ngày khởi tạo: {{$invoice->create_date}}</span></th></tr>
                                    @foreach($invoice->products as $key =>$item)
                                            <tr>
                                            <td><input type="text" name="product_name[]" class="form-control" value='{{ $item['product_name']}}' required></td>
                                            <td><input type="text" name="product_unit[]" class="form-control" value='{{ $item['product_unit']}}' required></td>
                                            <td><input type="numberic" pattern="[0-9]" name="product_amount[]" class="form-control" value='{{ $item['product_amount']}}' required></td>
                                            <td><input type="numberic" name="product_price[]" class="form-control" value='{{ $item['product_price']}}' required></td>
                                            <input type="hidden" name="product_id[]" class="form-control" value='{{ $item['id']}}' required>
                                        <tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('export.download',['id'=>$customer->id])}}">
                @csrf
                <div class="customer-form" style="display:inline-block;">
                    <input type="date" name="date_from" class="form-control">
                </div>
                <div class="customer-form" style="display:inline-block;">
                    <input type="date" name="date_to" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Xuất File Excel</button>
            </form>
        </div>
    </div>
</div>
@endsection

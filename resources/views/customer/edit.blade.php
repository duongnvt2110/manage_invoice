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
            <form method="POST" action="{{route('customer.update',['id'=>$customer->id])}}">
                @csrf
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a type="submit" class="btn btn-secondary" href="{{ route('customer.index') }}">Quay về</a>
                <div class="customer-form">
                    <div class="form-group" style="padding-top:20px;">
                        <label for="Role Name"><span class="badge badge-secondary">Tên Khách Hàng<span></label>
                    <input type="text" name="customer_name" class="form-control" value='{{$customer->customer_name}}' required>
                    </div>
                    <table id="customer" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Action</th>
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
                                            <td><input type="button" class="btn btn-primary" onclick="removeRow(this,{{$item['id']}})" value="Xóa dòng"></td>
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
                    <div class="btn-customer" style="padding-top:20px;">
                        <input type="button" class="btn btn-primary" id="add_row" onclick="addRow()" value="Thêm dòng">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>
<script>
    function addRow(){
        var table = document.getElementById("customer");
        var length = table.rows.length;
        var row = table.insertRow(length);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        cell1.innerHTML = `<td></td>`;
        cell2.innerHTML = `<td><input type="text" name="product_name[]" class="form-control" value='' required></td>`;
        cell3.innerHTML = `<td><input type="text" name="product_unit[]" class="form-control" value='' required></td>`;
        cell4.innerHTML = `<td><input type="number" name="product_amount[]" class="form-control" value='' required></td>`;
        cell5.innerHTML = `<td><input type="number" name="product_price[]" class="form-control" value='' required></td>`;
    }

    function removeRow(btn,productId){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "{{ route('product.delete')}}",
            data: {product_id: productId},
            success: function(result){
                if(result['status'] == 0){
                    location.reload();
                }
            }
        });
    }
    window.onload = function(){
        var alert = document.getElementById('alert-success');
        if(alert){
            setTimeout(function(){
                alert.style.display = "none";
            },2000);
        }
    }
</script>
@endsection

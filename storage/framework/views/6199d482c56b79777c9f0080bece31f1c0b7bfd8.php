<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('customer.store')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">Create</button>
                <div class="form-group">
                    <label for="Role Name">Tên Khách Hàng</label>
                    <input type="text" name="customer_name" class="form-control" value='' required>
                </div>
                <table id="customer" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Đơn Vị</th>
                            <th>Sô Lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <input type="button" class="btn btn-primary" id="add-row" onclick="addRow()" value="Thêm dòng">
                <input type="button" class="btn btn-primary" id="add-row" onclick="removeRow(this)" value="Xóa dòng">
            </form>
        </div>
    </div>
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
        cell1.innerHTML = `<td><input type="text" name="product_name[]" class="form-control" value='' required></td>`;
        cell2.innerHTML = `<td><input type="text" name="product_unit[]" class="form-control" value='' required></td>`;
        cell3.innerHTML = `<td><input type="number" name="product_amount[]" class="form-control" value='' required></td>`;
        cell4.innerHTML = "<td><input type='number'' name='product_price[]' class='form-control' value='' required>"+
            "<input type='hidden' name='product_id[]'' class='form-control' value='"+length+"' required></td>";
    }

    function removeRow(btn){
        var table = document.getElementById("customer");
        var row = table.rows.length;
        if(row > 1){
            table.deleteRow(row-1);
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/customer/create.blade.php ENDPATH**/ ?>
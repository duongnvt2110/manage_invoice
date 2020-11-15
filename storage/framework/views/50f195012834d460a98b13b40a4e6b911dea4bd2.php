<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success" id='alert-success' role="alert">
            <?php echo e(Session::get('success')); ?>

        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('customer.update',['id'=>$customer->id])); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a type="submit" class="btn btn-secondary" href="<?php echo e(route('customer.index')); ?>">Quay về</a>
                <div class="customer-form">
                    <div class="form-group" style="padding-top:20px;">
                        <label for="Role Name"><span class="badge badge-secondary">Tên Khách Hàng<span></label>
                    <input type="text" name="customer_name" class="form-control" value='<?php echo e($customer->customer_name); ?>' required>
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
                            <?php if(isset($customer->invoices)): ?>
                                <?php $__currentLoopData = $customer->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr><th><span class="badge badge-secondary">Ngày khởi tạo: <?php echo e($invoice->create_date); ?></span></th></tr>
                                    <?php $__currentLoopData = $invoice->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                            <td><input type="button" class="btn btn-primary" onclick="removeRow(this,<?php echo e($item['id']); ?>)" value="Xóa dòng"></td>
                                            <td><input type="text" name="product_name[]" class="form-control" value='<?php echo e($item['product_name']); ?>' required></td>
                                            <td><input type="text" name="product_unit[]" class="form-control" value='<?php echo e($item['product_unit']); ?>' required></td>
                                            <td><input type="numberic" pattern="[0-9]" name="product_amount[]" class="form-control" value='<?php echo e($item['product_amount']); ?>' required></td>
                                            <td><input type="numberic" name="product_price[]" class="form-control" value='<?php echo e($item['product_price']); ?>' required></td>
                                            <input type="hidden" name="product_id[]" class="form-control" value='<?php echo e($item['id']); ?>' required>
                                        <tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('customer.export',['id'=>$customer->id])); ?>">
                <?php echo csrf_field(); ?>
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
            url: "<?php echo e(route('product.delete')); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/customer/edit.blade.php ENDPATH**/ ?>
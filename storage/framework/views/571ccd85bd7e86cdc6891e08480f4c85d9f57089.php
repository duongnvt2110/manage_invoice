<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="input-group" style="width:100%;margin-top:30px;">
        <?php if(Session::has('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(Session::get('success')); ?>

        </div>
        <?php endif; ?>
        <div style="width:100%;">
            <div class="form-inline float-left">
                <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-primary float-left">Tạo mới</a>
            </div>
            <div class="form-inline float-right">

                <form method="get" action="<?php echo e(route('customer.index')); ?>" style="display: inline-flex;">
                    
                    <input class="form-control mr-sm-2" id="search" type="search_keyword" name="search_keyword" value="<?php echo e(old('search_keyword')); ?>" placeholder="Search" aria-label="Search">
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

            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($customer->id); ?></td>
                <td><?php echo e($customer->customer_name); ?></td>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="pr-2">
                            <a href="<?php echo e(route('customer.edit',['id'=> $customer->id ])); ?>" class="btn btn-primary">Edit</a>
                        </div>
                        <form method="POST" action="<?php echo e(route('customer.delete',['id'=> $customer->id ])); ?>" style="display: inline-flex;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?php echo e($customers->links()); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/customer/index.blade.php ENDPATH**/ ?>
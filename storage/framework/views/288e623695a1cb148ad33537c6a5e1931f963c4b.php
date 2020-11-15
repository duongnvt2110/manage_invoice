<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('loan.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="Role Name">Ammout</label>
                    <input type="text" name="amount" class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Description</label>
                    <textarea name="description" class="form-control" value=''></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/loan/create.blade.php ENDPATH**/ ?>
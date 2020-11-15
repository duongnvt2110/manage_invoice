<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        Send to <?php echo e($role); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.loan-applications.send", $loanApplication)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="user_id"><?php echo e($role); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('user_id') ? 'is-invalid' : ''); ?>" name="user_id" id="user_id">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('user_id') == $id ? 'selected' : ''); ?>><?php echo e($user); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('user_id')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('user_id')); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/admin/loanApplications/send.blade.php ENDPATH**/ ?>
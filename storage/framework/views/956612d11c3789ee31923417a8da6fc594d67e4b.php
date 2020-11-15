<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">Choose User</div>
        <div class="card-body">
                <form method="POST" action="<?php echo e(route('loan.update',['id'=>$loanApplication->id])); ?>">
                    <?php echo csrf_field(); ?>
                <div class="form-group" style="display:inline-flex;">
                    <div class="form-group">
                        <select class="form-control" name="user_id">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->user_name); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                </form>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/loan/analyze.blade.php ENDPATH**/ ?>
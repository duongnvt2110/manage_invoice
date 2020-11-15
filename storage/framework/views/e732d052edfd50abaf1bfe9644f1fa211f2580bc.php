<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('role.update',['id'=> $role->id])); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="Role Name">Role Name</label>
                <input type="text" name="name" class="form-control" value='<?php echo e($role->name); ?>' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Guard Name</label>
                    <input type="text" name="guard_name" class="form-control" value='<?php echo e($role->guard_name); ?>'>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Permission Name</label>
                    <div class="container">
                        <div class="row">
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2 col-xs-3">
                            <input type="checkbox" class="form-check-input" name="permissions[]" value ="<?php echo e($permission->id); ?>" id="permission_<?php echo e($permission->id); ?>"
                            <?php echo e($role->hasPermissionTo($permission->name)?'checked':''); ?>>
                                <label class="form-check-label" for="exampleCheck1"><?php echo e($permission->name); ?></label>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/role/edit.blade.php ENDPATH**/ ?>
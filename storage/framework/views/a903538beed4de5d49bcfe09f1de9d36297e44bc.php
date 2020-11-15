<?php $__env->startPush('script'); ?>
<script src="https://cdn.tiny.cloud/1/1n5vmu7nzek25j0mvzd0di8pz3zsb84njeot137ma5mcsk32/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?php echo e(asset('js/tinymce.js')); ?>" defer></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('post.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="Role Name">Title</label>
                    <input type="text" name="title" class="form-control" value='' required>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Content</label>
                    <textarea type="text" name="content" class="form-control" value=''></textarea>
                </div>
                <div class="form-group">
                    <label for="Guard Name">Status</label>
                    <select name="status" id="status-select">
                        <option value="0">Raw</option>
                        <option value="1">Public</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/post/create.blade.php ENDPATH**/ ?>
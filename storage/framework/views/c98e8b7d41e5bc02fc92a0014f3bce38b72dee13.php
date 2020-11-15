<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="form-group">
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('success')); ?>

      </div>
    <?php endif; ?>
    <div class="pb-2">
        <a href="<?php echo e(route('post.create')); ?>" class="btn btn-primary float-left">Create</a>
        <form class="form-inline float-right">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
    </div>

    </div>
    <table id="example" class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created By</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($post->id); ?></td>
                <td><?php echo e($post->title); ?></td>
                <td><?php echo Str::limit(html_entity_decode($post->content),15); ?></td>
                <td><?php echo e($post->user->user_name); ?></td>
                <td><?php echo e($post->status); ?></td>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="pr-2">
                            <a href="<?php echo e(route('post.edit',['id'=> $post->id ])); ?>" class="btn btn-primary">Edit</a>
                        </div>
                        <form method="POST" action="<?php echo e(route('post.delete',['id'=> $post->id ])); ?>" style="display: inline-flex;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>.
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/post/index.blade.php ENDPATH**/ ?>
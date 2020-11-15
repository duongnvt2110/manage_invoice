<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="form-group">
    <?php if(Session::has('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('success')); ?>

      </div>
    <?php endif; ?>
    <div class="pb-2">
        <?php if(auth()->user()->hasRole('user')): ?>
            <a href="<?php echo e(route('loan.create')); ?>" class="btn btn-primary float-left">Create</a>
        <?php endif; ?>
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
                <th>Amount</th>
                <?php if($user->is_admin): ?>
                <th>Analyst</th>
                <th>CFO</th>
                <?php endif; ?>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $loanApps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanApp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loanApp->id); ?></td>
                <td><?php echo e($loanApp->amount); ?></td>
                <?php if($user->is_admin): ?>
                    <td><?php echo e(($loanApp->userAnalyst->user_name)??''); ?></td>
                    <td><?php echo e($loanApp->userCfo->user_name??''); ?></td>
                <?php endif; ?>
                <th><?php echo e($loanApp->status->status); ?></th>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="pr-2">
                            <a href="<?php echo e(route('loan.show',['id'=>$loanApp->id])); ?>" class="btn btn-primary">View</a>
                        </div>
                        <div class="pr-2">
                            <?php if($user->is_admin && in_array($loanApp->status_id,[1,3,4])): ?>
                                <a  href="<?php echo e(route('loan.analyzeEdit',['id'=>$loanApp->id])); ?>" class="btn btn-primary">
                                    <?php if($loanApp->status_id == 1): ?>
                                        Send to Analyst
                                    <?php else: ?>
                                        Send to CFO
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="pr-2">
                            <?php if(($user->is_analyst && in_array($loanApp->status_id,[2])) || ($user->is_cfo && in_array($loanApp->status_id,[5]))): ?>
                                <a  href="<?php echo e(route('loan.edit',['id'=>$loanApp->id])); ?>" class="btn btn-primary">
                                    Submit Analyze
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="pr-2">
                        <?php if($user->is_admin): ?>
                            <form method="POST" action="<?php echo e(route('loan.delete',['id'=> $loanApp->id ])); ?>" style="display: inline-flex;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        <?php endif; ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>.
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/loan/index.blade.php ENDPATH**/ ?>
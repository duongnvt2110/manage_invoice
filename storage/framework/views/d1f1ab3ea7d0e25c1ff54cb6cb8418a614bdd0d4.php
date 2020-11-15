<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            View Loan Info
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td><?php echo e($loanApplication->id); ?></td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td><?php echo e($loanApplication->amount); ?></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><?php echo e($loanApplication->description); ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th><?php echo e($loanApplication->status->status); ?></th>
                    </tr>
                </tbody>.
            </table>
            <?php if($user->is_admin): ?>
                <form method="POST" action="<?php echo e(route('loan.update',['id'=>$loanApplication->id])); ?> ">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <select class="form-control" name="status" id="">
                            <option value="1">Processing</option>
                            <option value="8">Approved</option>
                            <option value="9">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        <div class="card-footer">
            <a href="<?php echo e(route('loan.index')); ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/loan/show.blade.php ENDPATH**/ ?>
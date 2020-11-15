<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">Analyze</div>
        <div class="card-body">
                <div class="form-group" style="display:inline-flex;">
                    <form method="POST" action="<?php echo e(route('loan.updateAnalyze',['id'=>$loanApplication->id,'status'=>0])); ?>">
                        <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary">Approved</button>
                    </form>
                </div>
                <div class="form-group" style="display:inline-flex;">
                    <form method="POST" action="<?php echo e(route('loan.updateAnalyze',['id'=>$loanApplication->id,'status'=>1])); ?>">
                        <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">Rejected</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/loan/edit.blade.php ENDPATH**/ ?>
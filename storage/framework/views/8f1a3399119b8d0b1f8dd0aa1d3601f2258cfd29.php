<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.loanApplication.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.loan-applications.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($loanApplication->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.loan_amount')); ?>

                        </th>
                        <td>
                            <?php echo e($loanApplication->loan_amount); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.description')); ?>

                        </th>
                        <td>
                            <?php echo e($loanApplication->description); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.status')); ?>

                        </th>
                        <td>
                            <?php echo e($user->is_user && $loanApplication->status_id < 8 ? $defaultStatus->name : $loanApplication->status->name); ?>

                        </td>
                    </tr>
                    <?php if($user->is_admin): ?>
                        <tr>
                            <th>
                                <?php echo e(trans('cruds.loanApplication.fields.analyst')); ?>

                            </th>
                            <td>
                                <?php echo e($loanApplication->analyst->name ?? ''); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?php echo e(trans('cruds.loanApplication.fields.cfo')); ?>

                            </th>
                            <td>
                                <?php echo e($loanApplication->cfo->name ?? ''); ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if($user->is_admin && count($logs)): ?>
                <h3>Logs</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Changes</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($log['user']); ?>

                                </td>
                                <td>
                                    <ul>
                                        <?php $__currentLoopData = $log['changes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <?php echo $change; ?>

                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($log['comment']): ?>
                                            <li>
                                                <b>Comment</b>: <?php echo e($log['comment']); ?>

                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </td>
                                <td>
                                    <?php echo e($log['time']); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <div class="form-group">
                <?php if($user->is_admin && in_array($loanApplication->status_id, [1, 3, 4])): ?>
                    <a class="btn btn-success" href="<?php echo e(route('admin.loan-applications.showSend', $loanApplication->id)); ?>">
                        Send to
                        <?php if($loanApplication->status_id == 1): ?>
                            analyst
                        <?php else: ?>
                            CFO
                        <?php endif; ?>
                    </a>
                <?php elseif(($user->is_analyst && $loanApplication->status_id == 2) || ($user->is_cfo && $loanApplication->status_id == 5)): ?>
                    <a class="btn btn-success" href="<?php echo e(route('admin.loan-applications.showAnalyze', $loanApplication->id)); ?>">
                        Submit analysis
                    </a>
                <?php endif; ?>

                <?php if(Gate::allows('loan_application_edit') && in_array($loanApplication->status_id, [6,7])): ?>
                    <a class="btn btn-info" href="<?php echo e(route('admin.loan-applications.edit', $loanApplication->id)); ?>">
                        <?php echo e(trans('global.edit')); ?>

                    </a>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_delete')): ?>
                    <form action="<?php echo e(route('admin.loan-applications.destroy', $loanApplication->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="submit" class="btn btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                    </form>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.loan-applications.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/laravel/resources/views/admin/loanApplications/show.blade.php ENDPATH**/ ?>
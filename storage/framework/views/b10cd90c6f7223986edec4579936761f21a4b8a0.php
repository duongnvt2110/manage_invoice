<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            <?php echo e(trans('panel.site_title')); ?>

        </a>
    </div>

    <ul class="c-sidebar-nav">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.userManagement.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.permissions.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.permission.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.roles.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.role.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.users.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : ''); ?>">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.user.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status_access')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route("admin.statuses.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is('admin/statuses') || request()->is('admin/statuses/*') ? 'active' : ''); ?>">
                    <i class="fa-fw fas fa-check c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.status.title')); ?>

                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_access')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route("admin.loan-applications.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is('admin/loan-applications') || request()->is('admin/loan-applications/*') ? 'active' : ''); ?>">
                    <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.loanApplication.title')); ?>

                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comment_access')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route("admin.comments.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is('admin/comments') || request()->is('admin/comments/*') ? 'active' : ''); ?>">
                    <i class="fa-fw fas fa-comment c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.comment.title')); ?>

                </a>
            </li>
        <?php endif; ?>
        <?php if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile_password_edit')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : ''); ?>" href="<?php echo e(route('profile.password.edit')); ?>">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        <?php echo e(trans('global.change_password')); ?>

                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                <?php echo e(trans('global.logout')); ?>

            </a>
        </li>
    </ul>

</div>
<?php /**PATH /var/www/laravel/resources/views/partials/menu.blade.php ENDPATH**/ ?>
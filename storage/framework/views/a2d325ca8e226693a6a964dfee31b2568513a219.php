<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
</head>
<body>
    <div id="app">
        <div id='wrapper'>
                <!-- Sidebar -->
            <?php if(auth()->user()): ?>
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">Dashboard</div>
                <div class="list-group list-group-flush">
                    <a href="<?php echo e(route('home')); ?> " class="list-group-item list-group-item-action bg-light">Home</a>
                    <?php if(auth()->user()->hasRole('admin')): ?>
                        <a href="<?php echo e(route('role.index')); ?> " class="list-group-item list-group-item-action bg-light">Roles</a>
                        <a href="<?php echo e(route('permission.index')); ?> " class="list-group-item list-group-item-action bg-light">Permissions</a>
                        <a href="<?php echo e(route('user.index')); ?> " class="list-group-item list-group-item-action bg-light">Users</a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('loan.index')); ?> " class="list-group-item list-group-item-action bg-light">Loan Applications</a>
                    <a href="<?php echo e(route('post.index')); ?> " class="list-group-item list-group-item-action bg-light">Post</a>
                </div>
            </div>
            <?php endif; ?>

            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                            <?php echo e(config('app.name', 'Laravel')); ?>

                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                <?php if(auth()->guard()->guest()): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                    </li>
                                    <?php if(Route::has('register')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <?php echo e(Auth::user()->user_name); ?>

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <?php echo e(__('Logout')); ?>

                                            </a>

                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <main class="py-4">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>
        
    </div>
</body>
</html>
<?php /**PATH /var/www/laravel/resources/views/layouts/app.blade.php ENDPATH**/ ?>
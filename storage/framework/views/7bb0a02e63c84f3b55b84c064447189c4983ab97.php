<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/adminlte/plugins/fontawesome-free/css/all.min.css">

    <!-- jQuery -->
    <script src="<?php echo e(url('/')); ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    
    <style>
        .grecaptcha-badge {
            z-index: 99999;
            display:block !important;
        }
        
        .logo {
            width: auto;
            max-width: 25%;
            height: auto;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info text-white shadow-sm">
            <div class="container">
                <ul class="nav navbar-nav mx-auto justify-content-center text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/')); ?>">
                            <img class="logo" src="<?php echo e(url('/')); ?>/Logo.svg" alt="JIREH">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    
</body>
</html>
<?php /**PATH /var/www/laravel/jireh/resources/views/layouts/app.blade.php ENDPATH**/ ?>
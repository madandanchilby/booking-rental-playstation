<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="<?php echo e(asset('/assets') . '/'); ?>"
    data-base-url="<?php echo e(url('/')); ?>" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description"
        content="<?php echo e(config('variables.description') ? config('variables.description') : ''); ?>" />
    <meta name="keywords"
        content="<?php echo e(config('variables.keyword') ? config('variables.keyword') : ''); ?>">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.ico')); ?>" />

    <!-- Include Styles -->
    <?php echo $__env->make('layouts/sections/styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Include Scripts for customizer, helper, analytics, config -->
    <?php echo $__env->make('layouts/sections/scriptsIncludes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>


    <?php echo e($slot); ?>




    <!-- Include Scripts -->
    <?php echo $__env->make('layouts/sections/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/components/layouts/blank.blade.php ENDPATH**/ ?>
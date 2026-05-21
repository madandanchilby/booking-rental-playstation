<?php
    /* Display elements */
    $contentNavbar = true;
    $containerNav = $containerNav ?? 'container-xxl';
    $isNavbar = $isNavbar ?? true;
    $isMenu = $isMenu ?? true;
    $isFlex = $isFlex ?? false;
    $isFooter = $isFooter ?? true;

    /* HTML Classes */
    $navbarDetached = 'navbar-detached';

    /* Content classes */
    $container = $container ?? 'container-xxl';

?>

<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="<?php echo e(asset('/assets') . '/'); ?>"
    data-base-url="<?php echo e(url('/')); ?>" data-framework="laravel" data-template="vertical-menu-laravel-template-free"
    lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

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
    <!-- Canonical SEO -->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.ico')); ?>" />



    <!-- Include Styles -->
    <?php echo $__env->make('layouts/sections/styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Include Scripts for customizer, helper, analytics, config -->
    <?php echo $__env->make('layouts/sections/scriptsIncludes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</head>

<body>
    <!-- Layout Content -->
    <div class="layout-wrapper layout-content-navbar <?php echo e($isMenu ? '' : 'layout-without-menu'); ?>">
        <div class="layout-container">
            
            <?php if($isMenu): ?>
                <?php echo $__env->make('layouts/sections/menu/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>


            <!-- Layout page -->
            <div class="layout-page">
                <!-- BEGIN: Navbar-->
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.navbar', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-4279031837-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <!-- END: Navbar-->


                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <?php if($isFlex): ?>
                        <div class="<?php echo e($container); ?> d-flex align-items-stretch flex-grow-1 p-0">
                        <?php else: ?>
                            <div class="<?php echo e($container); ?> flex-grow-1 container-p-y">
                    <?php endif; ?>

                    <?php echo e($slot); ?>


                </div>
                <!-- / Content -->

                <!-- Footer -->
                <?php if($isFooter): ?>
                    <?php echo $__env->make('layouts/sections/footer/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!--/ Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <?php if($isMenu): ?>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    <?php endif; ?>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    <!--/ Layout Content -->

    <!-- Include Scripts -->

    <?php echo $__env->make('layouts/sections/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>
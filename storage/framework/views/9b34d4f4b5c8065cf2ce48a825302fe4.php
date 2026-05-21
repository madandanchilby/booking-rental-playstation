<?php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';

?>

<div>


    <!-- Navbar -->
    <!--[if BLOCK]><![endif]--><?php if(isset($navbarDetached) && $navbarDetached == 'navbar-detached'): ?>
        <nav class="layout-navbar <?php echo e($containerNav); ?> navbar navbar-expand-xl <?php echo e($navbarDetached); ?> align-items-center bg-navbar-theme"
            id="layout-navbar">
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php if(isset($navbarDetached) && $navbarDetached == ''): ?>
        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="<?php echo e($containerNav); ?>">
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--  Brand demo (display only for navbar-full and hide on below xl) -->
    <!--[if BLOCK]><![endif]--><?php if(isset($navbarFull)): ?>
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="<?php echo e(url('/')); ?>" class="app-brand-link gap-2">
                <span class="app-brand-logo demo"><?php echo $__env->make('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span>
                <span class="app-brand-text demo menu-text fw-bold"><?php echo e(config('variables.name')); ?></span>
            </a>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- ! Not required for layout-without-menu -->
    <!--[if BLOCK]><![endif]--><?php if(!isset($navbarHideToggle)): ?>
        <div
            class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0<?php echo e(isset($menuHorizontal) ? ' d-xl-none ' : ''); ?> <?php echo e(isset($contentNavbar) ? ' d-xl-none ' : ''); ?>">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="<?php echo e(asset('assets/img/avatars/1.png')); ?>" alt class="w-px-40 h-auto rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="<?php echo e(asset('assets/img/avatars/1.png')); ?>" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">

                                    <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
                                        <span class="fw-medium d-block"><?php echo e(auth()->user()->name); ?></span>
                                        
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    
                    <li wire:click="logout" class="cursor">
                        <a class="dropdown-item">
                            <i class='bx bx-power-off me-2'></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!--[if BLOCK]><![endif]--><?php if(!isset($navbarDetached)): ?>
</div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</nav>
<!-- / Navbar -->

</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/components/navbar.blade.php ENDPATH**/ ?>
<div>
    <?php $__env->startSection('title', 'Customer Login'); ?>

    <?php $__env->startSection('page-style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
    <?php $__env->stopSection(); ?>

    <div class="d-flex" style="min-height: 100vh;">
        <div class="col-12 col-md-6">
            <div class="m-2">
                <img src="<?php echo e(asset('/assets/img/ps-logo.png')); ?>" alt="Logo" style="width: 250px; height: 100px;"
                    class="rounded-pill">
            </div>
            <div class="w-100 mt-4">
                <div class="authentication-wrapper authentication-basic container">
                    <div class="authentication-inner">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Login</h4>

                                <form wire:submit="login" class="mb-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('auth.error')): ?>
                                        <div class="alert alert-danger" role="alert"><?php echo e(session('auth.error')); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                                        <div class="alert alert-success" role="alert"><?php echo e(session('status')); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="form.username" type="text" class="form-control"
                                            id="username" name="username" placeholder="Masukkan username" autofocus>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input wire:model="form.password" type="password" id="password"
                                                class="form-control" name="password"
                                                placeholder="Masukkan password" aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                                    </div>
                                </form>

                                <p class="text-center">
                                    <span>Belum memiliki akun?</span>
                                    <a href="<?php echo e(route('customer.auth.register')); ?>">
                                        <span>Buat akun di sini</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-0 col-md-6">
            <img src="<?php echo e(asset('/assets/img/Internet-Cafe.jpg')); ?>" alt="Logo" class="w-100 h-100">
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/customer/auth/login.blade.php ENDPATH**/ ?>
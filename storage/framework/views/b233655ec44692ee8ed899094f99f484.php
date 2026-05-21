<?php
    use App\Enums\Gender;
?>

<div>
    <?php $__env->startSection('title', 'Customer Registrasi'); ?>

    <?php $__env->startSection('page-style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('page-script'); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php $__env->stopSection(); ?>

    <div class="d-flex" style="min-height: 100vh;">
        <div class="col-12 col-md-6">
            <div class="w-100 mt-4">
                <div class="m-2">
                    <img src="<?php echo e(asset('/assets/img/ps-logo.png')); ?>" alt="Logo"
                        style="width: 250px; height: 100px;" class="rounded-pill">
                </div>
                <div class="authentication-wrapper authentication-basic container-p-y">
                    <div class="authentication-inner">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Daftar Akun</h4>
                                <p class="mb-4">Setelah daftar, akun akan meminta verifikasi email sebelum bisa dipakai booking.</p>

                                <form wire:submit="register" class="mb-3">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input wire:model="form.name" type="text" class="form-control" id="name"
                                            name="name" placeholder="Masukkan nama" autofocus>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="form.username" type="text" class="form-control"
                                            id="username" name="username" placeholder="Masukkan username">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input wire:model="form.email" type="email" class="form-control"
                                            id="email" name="email" placeholder="Masukkan email">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mb-3 form-password-toggle">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input wire:model="form.password" type="password" id="password"
                                                class="form-control" name="password"
                                                placeholder="Minimal 8 karakter" aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select wire:model="form.gender" id="gender" class="form-select">
                                            <option value="">Pilih gender</option>
                                            <option value="<?php echo e(Gender::MALE->value); ?>">Laki-laki</option>
                                            <option value="<?php echo e(Gender::FEMALE->value); ?>">Perempuan</option>
                                        </select>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor HP</label>
                                        <input wire:model="form.phone" type="text" class="form-control" id="phone"
                                            name="phone" placeholder="Contoh: 081234567890">
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea wire:model="form.address" class="form-control" id="address" name="address" rows="3"
                                            placeholder="Masukkan alamat"></textarea>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="mb-3" wire:ignore>
                                    <div class="g-recaptcha"
                                        data-sitekey="<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>"
                                        data-callback="captchaCallback">
                                    </div>
                                </div>

                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                <script>
                                    function captchaCallback(token) {
                                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('captchaToken', token);
                                    }
                                </script>
                                  
                                    

                                    <button type="submit" class="btn btn-primary d-grid w-100">
                                        Daftar
                                    </button>
                                </form>

                                <p class="text-center">
                                    <span>Sudah memiliki akun?</span>
                                    <a href="<?php echo e(route('customer.auth.login')); ?>">
                                        <span>Login di sini</span>
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
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/customer/auth/register.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Booking Customer'); ?>

<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible mb-3">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Ketersediaan PlayStation</h5>
            
        </div>
    </div>

    <div class="row">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $availability = $this->getAvailability($computer);
            ?>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">
                                    <?php echo e($computer->computer_number); ?>

                                </h5>
                                <small class="text-muted">
                                    Rp. <?php echo e(number_format($computer->booking_price_per_hour, 0, ',', '.')); ?> / jam
                                </small>
                            </div>

                            <span class="badge <?php echo e($availability['badge_class']); ?>">
                                <?php echo e($availability['badge']); ?>

                            </span>
                        </div>

                        <div class="alert <?php echo e($availability['alert_class']); ?> py-2 mb-3">
                            <i class="bx bx-info-circle me-1"></i>
                            <?php echo e($availability['label']); ?>

                        </div>

                        <a href="<?php echo e(route('admin.booking.customer.create', $computer->id)); ?>"
                           class="btn btn-primary w-100">
                            <i class="bx bx-calendar-plus me-1"></i>
                            Booking untuk Customer
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    Data PlayStation belum tersedia.
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div><?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/booking/admin-booking-list.blade.php ENDPATH**/ ?>
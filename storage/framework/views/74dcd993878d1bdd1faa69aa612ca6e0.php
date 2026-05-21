<?php $__env->startSection('title', 'List PlayStation'); ?>

<div>
    <div class="row">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $availability = $this->getAvailability($computer);
                $status = $availability['status'];
                $upcoming = $availability['upcoming'];
            ?>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1"><?php echo e($computer->computer_number); ?></h5>
                                <small class="text-muted">Rp. <?php echo e(number_format($computer->booking_price_per_hour, 0, ',', '.')); ?> / jam</small>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'available'): ?>
                                <span class="badge bg-success" style="font-size: 0.75rem;">
                                    <i class="bx bx-check-circle me-1"></i>Tersedia
                                </span>
                            <?php elseif($status === 'in_use'): ?>
                                <span class="badge bg-danger" style="font-size: 0.75rem;">
                                    <i class="bx bx-loader-circle me-1"></i>Digunakan
                                </span>
                            <?php else: ?>
                                <span class="badge bg-success" style="font-size: 0.75rem;">
                                    <i class="bx bx-check-circle me-1"></i>Tersedia
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'in_use'): ?>
                            <div class="rounded p-3 mb-3" style="background-color: rgba(234,84,85,0.08); border-left: 3px solid #ea5455;">
                                <div class="fw-semibold text-danger" style="font-size: 0.85rem;">
                                    <i class="bx bx-time-five me-1"></i>
                                    Sedang digunakan
                                </div>
                                <div class="text-muted mt-1" style="font-size: 0.8rem;">
                                    Sampai <?php echo e(\Carbon\Carbon::parse($availability['current']->booking_end_date)->format('H:i')); ?> WIB
                                </div>
                            </div>
                        <?php elseif($status === 'available'): ?>
                            <div class="rounded p-3 mb-3" style="background-color: rgba(40,199,111,0.08); border-left: 3px solid #28c76f;">
                                <div class="fw-semibold text-success" style="font-size: 0.85rem;">
                                    <i class="bx bx-check-circle me-1"></i>
                                    Tersedia sekarang
                                </div>
                                <div class="text-muted mt-1" style="font-size: 0.8rem;">
                                    Tidak ada booking hari ini
                                </div>
                            </div>
                        <?php else: ?> 
                            <div class="rounded p-3 mb-3" style="background-color: rgba(40,199,111,0.08); border-left: 3px solid #28c76f;">
                                <div class="fw-semibold text-success" style="font-size: 0.85rem;">
                                    <i class="bx bx-check-circle me-1"></i>
                                    Tersedia sekarang
                                </div>
                                <div class="text-muted mt-1" style="font-size: 0.8rem;">
                                    Booking berikutnya pukul <?php echo e(\Carbon\Carbon::parse($upcoming->first()->booking_start_date)->format('H:i')); ?> WIB
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($upcoming->isNotEmpty()): ?>
                            <div class="mb-3">
                                <small class="fw-semibold text-muted d-block mb-2">Jadwal hari ini:</small>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex align-items-center mb-1" style="font-size: 0.8rem;">
                                        <i class="bx bx-calendar text-muted me-2" style="font-size: 0.85rem;"></i>
                                        <span class="text-muted">
                                            <?php echo e(\Carbon\Carbon::parse($booking->booking_start_date)->format('H:i')); ?>

                                            - <?php echo e(\Carbon\Carbon::parse($booking->booking_end_date)->format('H:i')); ?>

                                        </span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="mt-auto">
                            <a href="<?php echo e(route('customer.booking.create', ['computer' => $computer])); ?>"
                               class="btn btn-primary w-100">
                                <i class="bx bx-calendar-plus me-1"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/customer/booking-list.blade.php ENDPATH**/ ?>
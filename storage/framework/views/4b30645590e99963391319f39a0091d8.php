<?php $__env->startSection('title', 'Detail Invoice'); ?>

<div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card" id="invoice-card">
                
                <div class="card-header text-center pb-2">
                    <h4 class="mb-1">Detail Invoice</h4>
                    <small class="text-muted">Tunjukkan invoice ini kepada operator saat tiba di lokasi.</small>
                </div>

                <div class="card-body">
                    
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <small class="text-muted">Nomor Invoice</small>
                                <div class="fw-semibold"><?php echo e($invoiceNumber); ?></div>
                            </div>
                            <div class="col-sm-6 mb-2">
                            <small class="text-muted">ID Booking</small>
                            <div class="fw-semibold"><?php echo e($bookingId); ?></div>
                            </div>
                        </div>
                    </div>

                    
                    <h6 class="mb-3"><i class="bx bx-user me-1"></i> Informasi Pelanggan</h6>
                    <div class="row mb-4">
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Nama</small>
                            <div class="fw-semibold"><?php echo e($customerName); ?></div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Telepon</small>
                            <div class="fw-semibold"><?php echo e($customerPhone); ?></div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Email</small>
                            <div class="fw-semibold"><?php echo e($customerEmail); ?></div>
                        </div>
                    </div>

                    <hr>

                    
                    <h6 class="mb-3"><i class="bx bx-credit-card me-1"></i> Informasi Pembayaran</h6>
                    <div class="row mb-4">
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Tanggal Pembayaran</small>
                            <div class="fw-semibold"><?php echo e($paymentDate); ?></div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Metode Pembayaran</small>
                            <div class="fw-semibold"><?php echo e($paymentMethod); ?></div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <small class="text-muted">Status Pembayaran</small>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php if($paymentStatus === 'paid'): ?>
                                    <span class="badge bg-success">LUNAS</span>
                                <?php else: ?>
                                    <span class="badge bg-warning"><?php echo e(strtoupper($paymentStatus)); ?></span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>

                    <hr>

                    
                    <h6 class="mb-3"><i class="bx bx-calendar me-1"></i> Detail Booking</h6>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-2">
                            <small class="text-muted">PlayStation</small>
                            <div class="fw-semibold"><?php echo e($playstationName); ?></div>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">Durasi</small>
                            <div class="fw-semibold"><?php echo e($totalDuration); ?> jam</div>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">Status Booking</small>
                            <div>
                                <!--[if BLOCK]><![endif]--><?php if($bookingStatus === 'done'): ?>
                                    <span class="badge bg-info">DONE</span>
                                <?php elseif($bookingStatus === 'confirmed'): ?>
                                    <span class="badge bg-success">DIKONFIRMASI</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(strtoupper($bookingStatus)); ?></span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">Jadwal Booking:</small>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $bookingSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-1">
                                <i class="bx bx-time-five text-primary me-2"></i>
                                <span><?php echo e($slot['label']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Harga per Jam</span>
                            <span>Rp. <?php echo e(number_format($pricePerHour, 0, ',', '.')); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Durasi</span>
                            <span><?php echo e($totalDuration); ?> jam</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between">
                            <strong>Total Dibayar</strong>
                            <strong class="text-primary" style="font-size: 1.25rem;">Rp. <?php echo e(number_format($totalPaid, 0, ',', '.')); ?></strong>
                        </div>
                    </div>

                    
                    <div class="text-center mb-3">
                        <small class="text-muted d-block mb-1">Kode Verifikasi</small>
                        <span class="d-inline-block px-4 py-2 rounded fw-bold"
                              style="font-size: 1.5rem; letter-spacing: 4px; background-color: #f0f0f0; border: 2px dashed #ccc;">
                            <?php echo e($verificationCode); ?>

                        </span>
                        <div class="text-muted mt-1" style="font-size: 0.75rem;">
                            Tunjukkan kode ini kepada operator untuk verifikasi booking Anda.
                        </div>
                    </div>
                </div>

                
                <div class="card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <a href="<?php echo e(route('customer.history')); ?>" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bx bx-printer me-1"></i> Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('pricing-script'); ?>
<style>
    @media print {
        body * { visibility: hidden; }
        #invoice-card, #invoice-card * { visibility: visible; }
        #invoice-card { position: absolute; left: 0; top: 0; width: 100%; }
        .card-footer { display: none !important; }
        .layout-menu, .layout-navbar, .content-footer { display: none !important; }
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/customer/booking-invoice.blade.php ENDPATH**/ ?>
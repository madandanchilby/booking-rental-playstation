<?php $__env->startSection('title', 'Booking Walk-in'); ?>

<div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form wire:submit="createWalkinBooking">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bx bx-walk me-1"></i> Booking Walk-in
                        </h5>
                        <span class="badge bg-info">Pelanggan Datang Langsung</span>
                    </div>

                    <div class="card-body">
                        
                        <div class="alert alert-primary mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bx bx-time-five me-2" style="font-size: 1.5rem;"></i>
                                <div>
                                    <strong>Waktu Mulai (otomatis)</strong>
                                    <div class="small">Sistem menggunakan waktu saat ini sebagai waktu mulai</div>
                                </div>
                            </div>
                            <div class="row mt-2" wire:poll.5s>
                                <div class="col-sm-4">
                                    <small class="text-primary-emphasis">Tanggal</small>
                                    <div class="fw-semibold"><?php echo e($time_preview['date']); ?></div>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-primary-emphasis">Mulai</small>
                                    <div class="fw-semibold"><?php echo e($time_preview['start']); ?></div>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-primary-emphasis">Selesai (estimasi)</small>
                                    <div class="fw-semibold"><?php echo e($time_preview['end']); ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                                <input wire:model="customer_name" type="text" class="form-control" id="customer_name"
                                    placeholder="Masukkan nama pelanggan">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            
                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input wire:model="customer_phone" type="text" class="form-control" id="customer_phone"
                                    placeholder="08xxxxxxxxxx">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            
                            <div class="col-md-6">
                                <label for="computer_id" class="form-label">Pilih PlayStation <span class="text-danger">*</span></label>
                                <select wire:model.live="computer_id" class="form-select" id="computer_id">
                                    <option value="">-- Pilih PlayStation --</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($computer->id); ?>">
                                            Komputer <?php echo e($computer->computer_number); ?>

                                            (Rp. <?php echo e(number_format($computer->booking_price_per_hour, 0, ',', '.')); ?>/jam)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['computer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                                
                                <!--[if BLOCK]><![endif]--><?php if($availability === 'available'): ?>
                                    <div class="mt-2">
                                        <span class="badge bg-success"><i class="bx bx-check me-1"></i> Tersedia</span>
                                    </div>
                                <?php elseif($availability === 'unavailable'): ?>
                                    <div class="mt-2">
                                        <span class="badge bg-danger"><i class="bx bx-x me-1"></i> Sedang digunakan</span>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            
                            <div class="col-md-6">
                                <label for="duration" class="form-label">Durasi <span class="text-danger">*</span></label>
                                <select wire:model.live="duration" class="form-select" id="duration">
                                    <!--[if BLOCK]><![endif]--><?php for($i = 1; $i <= 8; $i++): ?>
                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?> jam</option>
                                    <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        
                        <!--[if BLOCK]><![endif]--><?php if($total_price > 0): ?>
                            <hr class="my-4">
                            <div class="bg-light rounded p-3">
                                <h6 class="mb-2">Ringkasan</h6>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <small class="text-muted">Waktu</small>
                                        <div class="fw-semibold"><?php echo e($time_preview['start_full']); ?> - <?php echo e($time_preview['end_full']); ?></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <small class="text-muted">Durasi</small>
                                        <div class="fw-semibold"><?php echo e($duration); ?> jam</div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <small class="text-muted">Pembayaran</small>
                                        <div><span class="badge bg-info">Bayar di Kasir</span></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Total Biaya</strong>
                                    <strong class="text-primary" style="font-size: 1.25rem;">
                                        Rp. <?php echo e(number_format($total_price, 0, ',', '.')); ?>

                                    </strong>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="<?php echo e(route('admin.history')); ?>" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary"
                            <?php if($availability !== 'available' || blank($customer_name) || blank($customer_phone)): echo 'disabled'; endif; ?>>
                            <i class="bx bx-check me-1"></i> Buat Booking Walk-in
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/booking/walkin-booking-create.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Booking Customer'); ?>

<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Booking Customer</h5>
            <small class="text-muted">
                Admin membuat booking terjadwal untuk customer.
            </small>
        </div>

        <div class="card-body">
            <div class="alert alert-info">
                <strong>PlayStation:</strong> <?php echo e($computer->computer_number); ?>

                <br>
                <strong>Harga per Jam:</strong> Rp. <?php echo e(number_format($computer->booking_price_per_hour, 0, ',', '.')); ?>

            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Nama Customer</label>
                    <input type="text"
                        class="form-control <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        wire:model.live="customer_name"
                        placeholder="Masukkan nama customer">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

        
             <div class="col-md-4">
                    <label class="form-label">No. HP Customer</label>
                    <input type="text"
                        class="form-control <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        wire:model.live="customer_phone"
                        placeholder="Masukkan nomor HP">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Booking</label>
                    <input type="date"
                        class="form-control <?php $__errorArgs = ['booking_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        wire:model.live="booking_date">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['booking_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <h6 class="mb-1">Pilih Timeslot</h6>
                <small class="text-muted">
                    Admin dapat memilih satu atau beberapa timeslot yang tersedia.
                </small>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['booking_times'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="row g-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $time_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $isAvailable = $slot['is_available'] ?? false;
                        $isSelected = in_array($slot['value'], $booking_times ?? [], true) && $isAvailable;
                        $isTooSoon = $slot['is_too_soon'] ?? false;
                        $isBooked = $slot['is_booked'] ?? false;

                         if ($isSelected) {
                                $btnClass = 'btn-primary';
                            } elseif ($slot['is_available']) {
                                $btnClass = 'btn-outline-primary';
                            } elseif ($isTooSoon) {
                                $btnClass = 'btn-outline-warning disabled';
                            } else {
                                $btnClass = 'btn-outline-secondary';
                            }
                    ?>

                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <button type="button"
                                class="btn w-100 border px-3 py-3 <?php echo e($btnClass); ?>"
                                <?php if($isAvailable): ?>
                                    wire:click="toggleTimeSlot('<?php echo e($slot['value']); ?>')"
                                <?php else: ?>
                                    onclick="alert('Slot ini tidak tersedia. Silakan pilih jadwal lain.'); return false;"
                                <?php endif; ?>>
                            <span class="fw-semibold d-block text-center">
                                <?php echo e($slot['label']); ?>

                            </span>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isTooSoon): ?>
                                <small class="d-block text-center text-warning fw-bold" style="font-size: 0.65rem;">
                                    &lt; 2 jam
                                </small>
                            <?php elseif($isBooked): ?>
                                <small class="d-block text-center" style="font-size: 0.65rem;">
                                    Sudah dibooking
                                </small>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            Pilih tanggal terlebih dahulu untuk melihat timeslot.
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <hr>

            <div class="bg-light rounded p-3 mb-3">
                <h6>Ringkasan Booking</h6>

                <div class="mb-2">
                    <small class="text-muted">Timeslot Dipilih</small>
                    <div class="d-flex flex-wrap gap-2 mt-1">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $selected_slot_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <span class="badge bg-primary"><?php echo e($label); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span class="text-muted">Belum ada timeslot dipilih.</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <strong>Total Harga</strong>
                    <strong class="text-primary">
                        Rp. <?php echo e(number_format($total_price, 0, ',', '.')); ?>

                    </strong>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="button"
                        class="btn btn-primary"
                        wire:click="booking"
                        wire:loading.attr="disabled">
                    <i class="bx bx-save me-1"></i>
                    Simpan Booking
                </button>

                <a href="<?php echo e(route('admin.booking.customer')); ?>" class="btn btn-outline-secondary">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/booking/admin-booking-create.blade.php ENDPATH**/ ?>
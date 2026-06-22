<?php
    $minDate = now()->format('Y-m-d');
    $selectedDuration = count($this->new_booking_times ?? []);
?>

<?php $__env->startSection('title', 'Reschedule Booking'); ?>

<div>
    <div class="row justify-content-center">
        <div class="col-lg-10">

            
            <div class="card mb-3 border-warning">
                <div class="card-header bg-warning bg-opacity-10">
                    <h6 class="mb-0"><i class="bx bx-info-circle me-1"></i> Booking Asal yang Akan Di-Reschedule</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">PlayStation</small>
                            <div class="fw-semibold"><?php echo e($booking->computer->computer_number); ?></div>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <small class="text-muted">Waktu Asal</small>
                            <div class="fw-semibold"><?php echo e($booking->booking_start_date->format('d-m-Y H:i')); ?> - <?php echo e($booking->booking_end_date->format('H:i')); ?></div>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <small class="text-muted">Durasi</small>
                            <div class="fw-semibold"><?php echo e($booking->booking_hour); ?> jam</div>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <small class="text-muted">Biaya</small>
                            <div class="fw-semibold">Rp. <?php echo e(number_format($booking->total_booking_fee, 0, ',', '.')); ?></div>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <small class="text-muted">Status Bayar</small>
                            <div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'paid'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge bg-warning"><?php echo e(ucfirst($booking->payment_status)); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <form wire:submit="rescheduleBooking">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bx bx-calendar-edit me-1"></i> Pilih Jadwal Baru</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="new_computer_id" class="form-label">PlayStation</label>
                                <select wire:model.live="new_computer_id" class="form-select" id="new_computer_id">
                                    <option value="">Pilih PlayStation</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($computer->id); ?>">
                                            Komputer <?php echo e($computer->computer_number); ?>

                                            (Rp. <?php echo e(number_format($computer->booking_price_per_hour, 0, ',', '.')); ?>/jam)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['new_computer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="new_booking_date" class="form-label">Tanggal Baru</label>
                                <input wire:model.live="new_booking_date" class="form-control" type="date"
                                    id="new_booking_date" min="<?php echo e($minDate); ?>" />
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['new_booking_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="col-12">
                                <div class="w-100 rounded border p-3 bg-light">
                                    <div class="fw-semibold mb-1">Jadwal Baru Dipilih</div>
                                    <div class="small text-muted mb-2">
                                        Dipilih: <?php echo e($selectedDuration); ?> / <?php echo e($max_slots); ?> timeslot
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($total_price > 0): ?>
                                            &bull; Total: <strong>Rp. <?php echo e(number_format($total_price, 0, ',', '.')); ?></strong>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selected_slot_labels->isNotEmpty()): ?>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $selected_slot_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slotLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="badge bg-primary"><?php echo e($slotLabel); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">Belum memilih timeslot baru.</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0">Pilih Timeslot Pengganti</h6>
                            <span class="badge bg-dark">Maks. <?php echo e($max_slots); ?> timeslot</span>
                        </div>
                        <small class="text-muted d-block mb-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($max_slots === 1): ?>
                                Pilih <strong>1 timeslot</strong> pengganti untuk menggantikan jadwal asal. Booking minimal <strong>2 jam sebelum</strong> waktu timeslot dimulai.
                            <?php else: ?>
                                Pilih tepat <strong><?php echo e($max_slots); ?> timeslot</strong> pengganti sesuai durasi booking asal. Booking minimal <strong>2 jam sebelum</strong> waktu timeslot dimulai.
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </small>

                        
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <small><span class="badge bg-primary">&nbsp;&nbsp;</span> Dipilih</small>
                            <small><span class="badge bg-outline-primary border border-primary">&nbsp;&nbsp;</span> Tersedia</small>
                            <small><span class="badge bg-secondary">&nbsp;&nbsp;</span> Sudah dibooking</small>
                            <small><span class="badge bg-warning">&nbsp;&nbsp;</span> Kurang dari 2 jam</small>
                        </div>

                        <div class="row g-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $time_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isSelected = in_array($slot['value'], $this->new_booking_times, true);
                                    $isTooSoon = $slot['is_too_soon'] ?? false;
                                    $isBooked = $slot['is_booked'] ?? false;
                                    $isLocked = $slot['is_locked'] ?? false;

                                    if ($isSelected) {
                                        $btnClass = 'btn-primary';
                                    } elseif ($slot['is_available']) {
                                        $btnClass = 'btn-outline-primary';
                                    } elseif ($isLocked) {
                                        $btnClass = 'btn-outline-secondary disabled';
                                    } elseif ($isTooSoon) {
                                        $btnClass = 'btn-outline-warning disabled';
                                    } else {
                                        $btnClass = 'btn-outline-secondary disabled';
                                    }
                                ?>
                                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                    <button type="button"
                                        class="btn w-100 border px-3 py-3 <?php echo e($btnClass); ?>"
                                        wire:click="toggleTimeSlot('<?php echo e($slot['value']); ?>')"
                                        <?php if(!$slot['is_available'] && !$isSelected): echo 'disabled'; endif; ?>
                                        <?php if($isTooSoon): ?> title="Tidak bisa booking, kurang dari 2 jam dari sekarang" <?php endif; ?>
                                        <?php if($isLocked): ?> title="Batas maksimal <?php echo e($max_slots); ?> timeslot sudah tercapai" <?php endif; ?>>
                                        <span class="fw-semibold d-block text-center"><?php echo e($slot['label']); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isTooSoon): ?>
                                            <small class="d-block text-center" style="font-size: 0.65rem;">< 2 jam</small>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-12">
                                    <div class="alert alert-info mb-0">
                                        Pilih PlayStation dan tanggal untuk melihat timeslot yang tersedia.
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['new_booking_times'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger mt-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="<?php echo e(route('customer.history')); ?>" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning" <?php if($selectedDuration !== $max_slots): echo 'disabled'; endif; ?>>
                            <i class="bx bx-calendar-edit me-1"></i> Konfirmasi Reschedule
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/customer/booking-reschedule.blade.php ENDPATH**/ ?>
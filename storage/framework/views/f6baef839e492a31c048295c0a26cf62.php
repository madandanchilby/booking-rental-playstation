<?php
    $minDate = now()->format('Y-m-d');
    $selectedDuration = count($this->form->booking_times ?? []);
?>

<?php $__env->startSection('title', 'Booking PlayStation'); ?>

<div>
    <form wire:submit="booking">
        <div class="card">
            <h5 class="card-header">Booking PlayStation</h5>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="computer_id" class="form-label">PlayStation</label>
                        <select wire:model.live="form.computer_id" name="form.computer_id" id="computer_id"
                            class="form-select">
                            <option value="">Pilih PlayStation</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $available_computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($computer->id); ?>">Komputer <?php echo e($computer->computer_number); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.computer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="booking_date" class="col-form-label">Tanggal Booking</label>
                        <input wire:model.live="form.booking_date" class="form-control" type="date" id="booking_date"
                            min="<?php echo e($minDate); ?>" value="<?php echo e($minDate); ?>" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.booking_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="col-12">
                        <div class="w-100 rounded border p-3 bg-light">
                            <div class="fw-semibold mb-1">Pilihan Anda</div>
                            <div class="small text-muted mb-2">
                                Durasi terpilih: <?php echo e($selectedDuration); ?> jam
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
                                <span class="text-muted small">Belum memilih timeslot.</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h6 class="mb-1">Pilih Timeslot</h6>
                        <small class="text-muted">
                            Anda bisa memilih 1, 2, atau beberapa timeslot sekaligus. Booking minimal <strong>2 jam sebelum</strong> waktu timeslot dimulai.
                        </small>
                    </div>
                </div>

                
                <div class="d-flex flex-wrap gap-3 mb-3">
                    <small><span class="badge bg-primary">&nbsp;&nbsp;</span> Dipilih</small>
                    <small><span class="badge bg-outline-primary border border-primary">&nbsp;&nbsp;</span> Tersedia</small>
                    <small><span class="badge bg-secondary">&nbsp;&nbsp;</span> Sudah dibooking</small>
                    <small><span class="badge bg-warning">&nbsp;&nbsp;</span> Kurang dari 2 jam</small>
                </div>

                <div class="row g-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $time_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $isSelected = in_array($slot['value'], $this->form->booking_times, true);
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

                            <?php if($slot['is_available']): ?>
                                wire:click="toggleTimeSlot('<?php echo e($slot['value']); ?>')"
                            <?php else: ?>
                                onclick="alert('Slot ini sudah dibooking oleh customer lain. Silakan pilih jadwal lain.'); return false;"
                            <?php endif; ?>

                            <?php if($isTooSoon): ?>
                                title="Tidak bisa booking, kurang dari 2 jam dari sekarang"
                            <?php endif; ?>
                        >
                            <span class="fw-semibold d-block text-center">
                                <?php echo e($slot['label']); ?>

                            </span>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isTooSoon): ?>
                                <small class="d-block text-center" style="font-size: 0.65rem;">
                                    < 2 jam
                                </small>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </button>
</div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                Pilih PlayStation dan tanggal terlebih dahulu untuk melihat timeslot yang tersedia.
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.booking_times'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger mt-2"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.booking_times.*'];
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
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($total_price > 0): ?>
                        <span class="fw-semibold">Total Pembayaran: Rp. <?php echo e(number_format($total_price, 0, ',', '.')); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary" <?php if($selectedDuration === 0): echo 'disabled'; endif; ?>>
                    <i class="bx bx-credit-card me-1"></i> Lanjut ke Pembayaran
                </button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/customer/booking-create.blade.php ENDPATH**/ ?>
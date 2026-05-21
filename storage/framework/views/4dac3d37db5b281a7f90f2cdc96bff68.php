<?php $__env->startSection('title', 'Riwayat Booking'); ?>

<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible mb-3">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card mb-3">
        <h5 class="card-header">Booking Yang Berjalan</h5>
        
            <div class="table-responsive">
                <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>PlayStation</th>
                    <th>Waktu</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                
                <tbody class="table-border-bottom-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $current_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                            <span class="badge bg-label-secondary">
                                <?php echo e(substr($booking->id, 0, 8)); ?>

                            </span>
                            </td>
                            <td><?php echo e($booking->computer->computer_number ?? '-'); ?></td>
                            <td>
                                <?php echo e($booking->booking_start_date->format('d-m-Y H:i')); ?>

                                <br>
                                <small class="text-muted">s/d <?php echo e($booking->booking_end_date->format('H:i')); ?></small>
                            </td>
                            <td>Rp. <?php echo e(number_format($booking->total_booking_fee, 0, ',', '.')); ?></td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status === 'confirmed'): ?>
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                <?php elseif($booking->status === 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($booking->status ?? '-')); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->rescheduled_from_id): ?>
                                    <br><small class="text-info"><i class="bx bx-calendar-edit"></i> Rescheduled</small>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'paid'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php elseif($booking->payment_status === 'pending'): ?>
                                    <span class="badge bg-warning">Belum</span>
                                <?php elseif($booking->payment_status === 'expired'): ?>
                                    <span class="badge bg-secondary">Expired</span>
                                <?php elseif($booking->payment_status === 'failed'): ?>
                                    <span class="badge bg-danger">Gagal</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e($booking->payment_status ?? '-'); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td style="min-width: 80px;">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'paid' && $booking->midtrans_order_id): ?>
                                            <a href="<?php echo e(route('customer.booking.invoice', ['order_id' => $booking->midtrans_order_id])); ?>"
                                                class="dropdown-item">
                                                <i class="bx bx-receipt me-1"></i> Lihat Invoice
                                            </a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'pending' && $booking->midtrans_order_id): ?>
                                            <a href="<?php echo e(route('customer.booking.payment', ['order_id' => $booking->midtrans_order_id])); ?>"
                                                class="dropdown-item">
                                                <i class="bx bx-credit-card me-1"></i> Bayar Sekarang
                                            </a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(now()->lt($booking->booking_start_date->copy()->subHours(2))): ?>

                                        <a href="<?php echo e(route('customer.booking.reschedule', $booking->id)); ?>"
                                        class="dropdown-item">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Reschedule
                                        </a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <div wire:click="cancel_booking(<?php echo e($booking); ?>)" class="dropdown-item"
                                            style="cursor: pointer;"
                                            wire:confirm="Yakin ingin membatalkan booking ini?">
                                            <i class="bx bx-trash me-1"></i> Batalkan
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Tidak ada booking yang sedang berjalan.</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-2">
            
        </div>
    </div>
   

    <div class="card">
        <h5 class="card-header">Booking Yang Telah Selesai</h5>
        
            <div class="table-responsive">
                <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>PlayStation</th>
                    <th>Waktu</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
            </tr>
        </thead>
                <tbody class="table-border-bottom-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $completed_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                            <span class="badge bg-label-secondary">
                                <?php echo e(substr($booking->id, 0, 8)); ?>

                            </span>
                            </td>
                            <td><?php echo e($booking->computer->computer_number ?? '-'); ?></td>
                            <td>
                                <?php echo e($booking->booking_start_date->format('d-m-Y H:i')); ?>

                                <br>
                                <small class="text-muted">s/d <?php echo e($booking->booking_end_date->format('H:i')); ?></small>
                            </td>
                            <td>Rp. <?php echo e(number_format($booking->total_booking_fee, 0, ',', '.')); ?></td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'paid'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($booking->payment_status ?? '-')); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'paid' && $booking->midtrans_order_id): ?>
                                    <a href="<?php echo e(route('customer.booking.invoice', ['order_id' => $booking->midtrans_order_id])); ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-receipt me-1"></i> Invoice
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat.</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-2">
            
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/customer/history-list.blade.php ENDPATH**/ ?>
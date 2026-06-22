<?php $__env->startSection('title', 'Riwayat Booking'); ?>

<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible mb-3">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Booking Yang Berjalan</h5>
            <a href="<?php echo e(route('admin.booking.walkin')); ?>" class="btn btn-primary btn-sm">
                <i class="bx bx-walk me-1"></i> Booking Walk-in
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Booking</th>
                        <th>Tipe</th>
                        <th>Customer</th>
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
                                <?php echo e(strtoupper(substr($booking->id, 0, 8))); ?>

                            </span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->booking_type === 'walk_in'): ?>
                                    <span class="badge bg-info">Walk-in</span>
                                <?php else: ?>
                                    <span class="badge bg-label-primary">Online</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($booking->getCustomerDisplayName()); ?>

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
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_status === 'paid'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php elseif($booking->payment_status === 'pending'): ?>
                                    <span class="badge bg-warning">Belum</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($booking->payment_status ?? '-')); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
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
                            <td colspan="8" class="text-center text-muted py-4">Tidak ada booking yang sedang berjalan.</td>
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
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Booking</th>
                        <th>Tipe</th>
                        <th>Customer</th>
                        <th>PlayStation</th>
                        <th>Waktu</th>
                        <th>Total Harga</th>
                        <th>Bayar</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $completed_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                            <span class="badge bg-label-secondary">
                                <?php echo e(strtoupper(substr($booking->id, 0, 8))); ?>

                            </span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->booking_type === 'walk_in'): ?>
                                    <span class="badge bg-info">Walk-in</span>
                                <?php else: ?>
                                    <span class="badge bg-label-primary">Online</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td><?php echo e($booking->getCustomerDisplayName()); ?></td>
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
</div><?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/history-list.blade.php ENDPATH**/ ?>
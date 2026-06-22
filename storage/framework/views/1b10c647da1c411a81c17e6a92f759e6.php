<?php $__env->startSection('title', 'Pembayaran Booking'); ?>

<div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentStatus === 'paid'): ?>
                <div class="card border-success">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-success mb-2">Pembayaran Berhasil!</h4>
                        <p class="text-muted mb-4">Booking Anda telah dikonfirmasi dan siap digunakan.</p>

                        <div class="bg-light rounded p-3 mb-4 text-start">
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">ID Booking</small>
                                    <div class="fw-semibold"><?php echo e($bookingId); ?></div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">PlayStation</small>
                                    <div class="fw-semibold"><?php echo e($computerNumber); ?></div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">Total Dibayar</small>
                                    <div class="fw-semibold">Rp. <?php echo e(number_format($totalFee, 0, ',', '.')); ?></div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">Status</small>
                                    <div><span class="badge bg-success">Lunas</span></div>
                                </div>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($bookingSlots)): ?>
                                <hr>
                                <small class="text-muted">Jadwal Booking</small>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $bookingSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-primary"><?php echo e($slot); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <a href="<?php echo e(route('customer.booking.invoice', ['order_id' => $order_id])); ?>" class="btn btn-primary">
                            <i class="bx bx-receipt me-1"></i> Lihat Invoice
                        </a>
                        <a href="<?php echo e(route('customer.history')); ?>" class="btn btn-outline-primary ms-2">
                            <i class="bx bx-history me-1"></i> Lihat Riwayat Booking
                        </a>
                        <a href="<?php echo e(route('customer.booking')); ?>" class="btn btn-outline-primary ms-2">
                            <i class="bx bx-home me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

            
            <?php elseif($paymentStatus === 'failed'): ?>
                <div class="card border-danger">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-x-circle text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-danger mb-2">Pembayaran Gagal</h4>
                        <p class="text-muted mb-4">Pembayaran tidak berhasil diproses. Silakan coba lagi.</p>

                        <a href="<?php echo e(route('customer.booking')); ?>" class="btn btn-primary">
                            <i class="bx bx-refresh me-1"></i> Booking Ulang
                        </a>
                    </div>
                </div>

            
            <?php elseif($paymentStatus === 'expired'): ?>
                <div class="card border-warning">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="bx bx-time-five text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-warning mb-2">Pembayaran Kedaluwarsa</h4>
                        <p class="text-muted mb-4">Batas waktu pembayaran telah habis. Silakan buat booking baru.</p>

                        <a href="<?php echo e(route('customer.booking')); ?>" class="btn btn-primary">
                            <i class="bx bx-refresh me-1"></i> Booking Ulang
                        </a>
                    </div>
                </div>

            
            <?php else: ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pembayaran Booking</h5>
                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                    </div>
                    <div class="card-body">
                        
                        <div class="bg-light rounded p-3 mb-4">
                            <h6 class="mb-3">Ringkasan Pesanan</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">Order ID</small>
                                    <div class="fw-semibold"><?php echo e($order_id); ?></div>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <small class="text-muted">PlayStation</small>
                                    <div class="fw-semibold"><?php echo e($computerNumber); ?></div>
                                </div>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($bookingSlots)): ?>
                                <div class="mb-2">
                                    <small class="text-muted">Jadwal Booking</small>
                                    <div class="d-flex flex-wrap gap-2 mt-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $bookingSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-primary"><?php echo e($slot); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total Pembayaran</strong>
                                <strong class="text-primary" style="font-size: 1.25rem;">Rp. <?php echo e(number_format($totalFee, 0, ',', '.')); ?></strong>
                            </div>
                        </div>

                        
                        <div class="alert alert-info">
                            <i class="bx bx-info-circle me-1"></i>
                            <strong>Metode Pembayaran: Bank Transfer (Virtual Account)</strong>
                            <p class="mb-0 mt-1 small">
                                Klik tombol <strong>"Bayar Sekarang"</strong> untuk memilih bank dan mendapatkan nomor Virtual Account.
                                Setelah mendapatkan nomor VA, Anda dapat mensimulasikan pembayaran melalui
                                <a href="https://simulator.sandbox.midtrans.com/" target="_blank" class="fw-semibold">
                                    Midtrans Payment Simulator
                                </a>.
                            </p>
                        </div>

                        
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($snapToken): ?>
                                <button type="button" id="btn-pay" class="btn btn-primary btn-lg flex-grow-1"
                                    onclick="payWithSnap()">
                                    <i class="bx bx-credit-card me-1"></i> Bayar Sekarang
                                </button>
                            <?php else: ?>
                                <div class="alert alert-warning w-100 mb-0">
                                    <i class="bx bx-error me-1"></i>
                                    <strong>Snap token belum tersedia.</strong>
                                    Pastikan konfigurasi Midtrans (Server Key & Client Key) sudah benar di file <code>.env</code>.
                                    <hr>
                                    <small>
                                        Anda tetap bisa mensimulasikan pembayaran dengan mengklik tombol dibawah ini.
                                    </small>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-primary" wire:click="handlePaymentSuccess('<?php echo e($order_id); ?>', 'SIMULATED-<?php echo e($order_id); ?>', 'bank_transfer')">
                                            <i class="bx bx-check me-1"></i> Simulasi Pembayaran Berhasil
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <button type="button" class="btn btn-outline-secondary btn-lg" wire:click="checkPaymentStatus">
                                <i class="bx bx-refresh me-1"></i> Cek Status
                            </button>
                        </div>

                        <hr>

                        <div class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                wire:click="cancelBooking"
                                wire:confirm="Apakah Anda yakin ingin membatalkan booking ini?">
                                <i class="bx bx-x me-1"></i> Batalkan Booking
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentStatus === 'pending' && $snapToken): ?>
    <?php $__env->startPush('pricing-script'); ?>
        <script src="<?php echo e($snapJsUrl); ?>" data-client-key="<?php echo e($clientKey); ?>"></script>
        <script>
            function payWithSnap() {
                window.snap.pay('<?php echo e($snapToken); ?>', {
                    onSuccess: function(result) {
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('handlePaymentSuccess', result.order_id, result.transaction_id, result.payment_type);
                    },
                    onPending: function(result) {
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('handlePaymentPending', result.order_id);
                    },
                    onError: function(result) {
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').call('handlePaymentError', result.order_id);
                    },
                    onClose: function() {
                        // User closed the popup without completing payment
                        console.log('Payment popup closed');
                    }
                });
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/customer/booking-payment.blade.php ENDPATH**/ ?>
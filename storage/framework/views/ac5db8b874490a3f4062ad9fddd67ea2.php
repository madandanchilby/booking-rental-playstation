<div>
    <?php $__env->startSection('title', 'Tambah PlayStation'); ?>
    <form wire:submit="save">
        <div class="card">
            <h5 class="card-header">Tambah PlayStation</h5>
            <div class="card-body">
                <div class="mb-3">
                    <label for="computer_number" class="form-label">Nama PlayStation</label>
                    <input wire:model="form.computer_number" type="text" id="computer_number" class="form-control"
                        placeholder="Masukan nama produk" required>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.computer_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?> </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <div class="mb-3">
                    <label for="booking_price_per_hour" class="form-label">Harga Per Jam</label>
                    <input wire:model="form.booking_price_per_hour" type="text" id="booking_price_per_hour"
                        class="form-control" placeholder="Masukan harga produk" required>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.booking_price_per_hour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?> </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

    
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/master-data/computer/computer-create.blade.php ENDPATH**/ ?>
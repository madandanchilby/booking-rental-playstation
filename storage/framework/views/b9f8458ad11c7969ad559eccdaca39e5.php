<?php $__env->startSection('title', 'View PlayStation'); ?>

<div class="card">
    <div class="card-header">
        <h3>Detail PlayStation</h3>
        <div class="d-flex gap-4">
            <a href="<?php echo e(route('admin.master-data.computer.edit', ['computer' => $computer])); ?>" class="btn btn-secondary">Edit</a>
            <button wire:click="delete" type="button" class="btn btn-danger">Hapus</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <h4>Nama PlayStation</h4>
                <span><?php echo e($computer->computer_number); ?></span>
            </div>
            <div class="col-3">
                <h4>Harga Sewa Per Jam</h4>
                <span>Rp. <?php echo e(number_format($computer->booking_price_per_hour, thousands_separator: '.')); ?></span>
            </div>
        </div>
    </div>

    
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/master-data/computer/computer-view.blade.php ENDPATH**/ ?>
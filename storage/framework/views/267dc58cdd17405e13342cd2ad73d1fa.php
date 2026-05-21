<div>
    <?php $__env->startSection('title', 'List PlayStation'); ?>
    <div class="card">
        <h5 class="card-header">List PlayStation</h5>
        <a class="ms-auto me-3" href="<?php echo e(route('admin.master-data.computer.create')); ?>">
            <button type="button" class="btn btn-primary">Tambah PlayStation</button>
        </a>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Harga Per Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $computers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $computer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($computer->computer_number); ?></td>
                            <td>Rp. <?php echo e(number_format($computer->booking_price_per_hour, thousands_separator: '.')); ?>

                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="<?php echo e(route('admin.master-data.computer.view', ['computer' => $computer])); ?>"
                                            class="dropdown-item" wire:navigate><i class="bx bx-note me-1"></i>
                                            Detail</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->


                </tbody>
            </table>
        </div>

        <div class="p-2">
            <?php echo e($computers->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/livewire/pages/admin/master-data/computer/computer-list.blade.php ENDPATH**/ ?>
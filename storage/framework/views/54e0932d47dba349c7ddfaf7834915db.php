<script src="<?php echo e(asset(mix('assets/vendor/libs/jquery/jquery.js'))); ?>"></script>
<script src="<?php echo e(asset(mix('assets/vendor/libs/popper/popper.js'))); ?>"></script>
<script src="<?php echo e(asset(mix('assets/vendor/js/bootstrap.js'))); ?>"></script>
<script src="<?php echo e(asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'))); ?>"></script>
<script src="<?php echo e(asset(mix('assets/vendor/js/menu.js'))); ?>"></script>
<script src="<?php echo e(asset(mix('assets/js/main.js'))); ?>"></script>
<?php echo $__env->yieldContent('vendor-script'); ?>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->


<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<?php echo $__env->yieldPushContent('pricing-script'); ?>
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<?php echo $__env->yieldContent('page-script'); ?>
<!-- END: Page JS-->
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/layouts/sections/scripts.blade.php ENDPATH**/ ?>
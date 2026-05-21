<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div class="<?php echo e((!empty($containerNav) ? $containerNav : 'container-fluid')); ?> d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div  class="d-none d-lg-inline-block">
      <a href="<?php echo e(config('variables.licenseUrl') ? config('variables.licenseUrl') : '#'); ?>" class="footer-link me-4" target="_blank">License</a>
      <a href="<?php echo e(config('variables.moreThemes') ? config('variables.moreThemes') : '#'); ?>" target="_blank" class="footer-link me-4">More Themes</a>
      <a href="<?php echo e(config('variables.documentation') ? config('variables.documentation').'/laravel-introduction.html' : '#'); ?>" target="_blank" class="footer-link me-4">Documentation</a>
      <a href="<?php echo e(config('variables.support') ? config('variables.support') : '#'); ?>" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
    </div>
  </div>
</footer>
<!--/ Footer-->
<?php /**PATH C:\laragon\www\chilby-internetcafe\resources\views/layouts/sections/footer/footer.blade.php ENDPATH**/ ?>
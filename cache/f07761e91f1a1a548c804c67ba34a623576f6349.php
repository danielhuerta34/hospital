<?php echo $__env->make('layouts/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <?php echo $render; ?>

            <?php echo $summernote; ?>

        </div>
    </div>
</div>
<script>
    let base_url = "<?php echo e(base_url); ?>";
</script>
<?php
if (!empty($script_js)) { ?>
    <script src="<?php echo e(base_url); ?>/js/<?php echo e($script_js); ?>.js"></script>
<?php } ?><?php /**PATH D:\xampp74\htdocs\FMVC\app\views/page.blade.php ENDPATH**/ ?>
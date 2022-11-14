<style>
    body {
        background-color: #dee2d5 !important;
    }

    label {
        color: #fff;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-warning" style="width: 50%; margin: 20px auto;">
                <div class="panel-body text-center" style="background-color: #34495e;">
                    <img src="<?php echo e(base_url); ?>/theme/img/logo.png" class="mt-4" alt="AdminLTE Logo" width="100">
                </div>
                <div class="panel-body" style="background-color: #099EDF;"><?= $login; ?></div>
                <div class="panel-footer" style="background-color: #34495e;!important">
                    <a href="<?php echo e(base_url); ?>/login/reset" style="color:#fff;">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let base_url = "<?php echo e(base_url); ?>";
</script>
<script src="<?php echo e(base_url); ?>/js/script.js"></script><?php /**PATH D:\xampp74\htdocs\hospital\app\views/login.blade.php ENDPATH**/ ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default" style="width: 50%; margin: 20px auto;">
                <div class="panel-heading text-center">Iniciar Sesión</div>
                <div class="panel-body"><?= $login; ?></div>
                <div class="panel-footer">
                    <a href="<?php echo e(base_url); ?>/login/reset">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let base_url = "<?php echo e(base_url); ?>";
</script>
<script src="<?php echo e(base_url); ?>/js/script.js"></script><?php /**PATH D:\xampp74\htdocs\FMVC\app\views/login.blade.php ENDPATH**/ ?>
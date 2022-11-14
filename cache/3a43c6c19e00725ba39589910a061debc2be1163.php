<?php echo $__env->make('layouts/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="card">
            <div class="card-body">
                <?php echo $render; ?>

            </div>
        </div>
    </section>
</div>
<?php echo $__env->make('layouts/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("pdocrud_after_submission", function(event, obj, data) {
        result = JSON.parse(data);
        if (result['message'] == "Usuario guardado con éxito") {
            $('.pdocrud-back').click();
            Swal.fire(
                'Genial!',
                result['message'],
                'success'
            )
        }
    });
</script><?php /**PATH D:\xampp74\htdocs\hospital\app\views/usuarios.blade.php ENDPATH**/ ?>
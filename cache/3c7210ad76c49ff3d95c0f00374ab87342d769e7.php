<?php echo $__env->make('layouts/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    .pdocrud-filters-options {
        text-align: center;
    }
</style>
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
<script>
    $(document).on("click", ".pdocrud-filter-option-remove, .pdocrud-filter-option", function() {
        $(".pdocrud-filter").val('');
    });

    $(document).on("keyup", "#pdocrud_search_box", function(event) {
        let busqueda = $("#pdocrud_search_box").val();

        if (busqueda == "") {
            $('#pdocrud_search_btn').click();
        }

    });
</script><?php /**PATH D:\xampp74\htdocs\hospital\app\views/paciente.blade.php ENDPATH**/ ?>
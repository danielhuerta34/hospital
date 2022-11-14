@include('layouts/header')
@include('layouts/sidebar')
<div class="content-wrapper">
    <section class="content">
        <div class="card">
            <div class="card-body">
                {!! $render !!}
            </div>
        </div>
    </section>
</div>
@include('layouts/footer')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("pdocrud_after_submission", function(event, obj, data) {
        result = JSON.parse(data);
        if (result['message'] == "Especialista guardado con éxito") {
            $('.pdocrud-back').click();
            Swal.fire(
                'Genial!',
                result['message'],
                'success'
            )
        }
    });
</script>
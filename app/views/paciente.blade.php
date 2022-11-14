@include('layouts/header')
@include('layouts/sidebar')
<style>
    .pdocrud-filters-options {
        text-align: center;
    }
</style>
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
</script>
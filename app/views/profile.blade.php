@include('layouts/header')
@include('layouts/sidebar')
<div class="content-wrapper">
	<section class="content">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-7">
						{!! $render !!}
					</div>
					<div class="col-md-5">
						<div class="card bg-secondary">
							<div class="row mt-3">
								<div class="col-12 text-center">
									<img src="{{ base_url }}{{ $_SESSION['usuarios'][0]->avatar }}" width="150" class="img-circle avatar border border-dark bg-white p-2" alt="...">
								</div>
							</div>
							<div class="card-body">
								<div class="alert alert-info" role="alert">
									<p class="mb-0">Nombre: <span class="nombre_usuario">{{ $_SESSION['usuarios'][0]->nombre }}</span></p>
								</div>
								<div class="alert alert-info" role="alert">
									<p class="mb-0">Correo: <span class="correo_usuario">{{ $_SESSION['usuarios'][0]->correo }}</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@include('layouts/footer')
<script>
	$(document).ready(function() {
		$(document).on("pdocrud_after_submission", function(event, obj, data) {
			$.ajax({
				type: "POST",
				url: "{{ base_url }}/home/avatar",
				dataType: "json",
				success: function(value) {
					console.log(value);
					$(".avatar").attr('src', "{{ base_url }}" + value[0].avatar);
					$('.nombre_usuario').text(value[0].nombre);
					$('.correo_usuario').text(value[0].correo);
					$('.clave').val('');
				}
			});
		});
	});
</script>
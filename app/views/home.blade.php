@include('layouts/header')
@include('layouts/sidebar')

<style>
	.guardar_datos {
		display: none !important;
	}

	.form-control:disabled,
	.form-control[readonly] {
		cursor: no-drop;
	}
</style>
<div class="content-wrapper">
	<section class="content">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-12">
						<button class="btn btn-info btn-sm liberar_consultas"><i class="fas fa-hand-holding-medical"></i> Liberar Consultas</button>
					</div>
				</div>
				{!! $render !!}
				<div class="emergente"></div>
			</div>
		</div>
	</section>
</div>
@include('layouts/footer')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).on("click", ".popup", function() {
		let id = $(this).data("id");

		$.ajax({
			type: "POST",
			url: "{{ base_url }}/home/paciente",
			data: {
				id: id
			},
			beforeSend: function() {
				$("#pdocrud-ajax-loader").show();
			},
			dataType: "html",
			success: function(data) {
				$("#pdocrud-ajax-loader").hide();
				$('.emergente').html(`
				<div class="modal fade" id="modal_pacientes" tabindex="-1" role="dialog" aria-labelledby="modal_pacientesLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								${data}
							</div>
						</div>
					</div>
				</div>`);
				$('#modal_pacientes').modal('show');
			}
		});
	});

	$('.liberar_consultas').click(function() {
		Swal.fire({
			title: 'Estas seguro que deseas liberar las consultas médicas?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) {

				$.ajax({
					type: "POST",
					url: "{{ base_url }}/home/liberar_consultas",
					dataType: "json",
					success: function(data) {
						if (data['mensaje'] == "correcto") {
							$('.busqueda').click();
							Swal.fire(
								'Genial!',
								'Se han liberado las consultas.',
								'success'
							)
						} else {
							Swal.fire(
								'Lo siento!',
								'No se concontraron estados para liberar',
								'error'
							)
						}
					}
				});
			}
		})
	});

	$(document).on("pdocrud_after_ajax_action", function(event, obj, data) {
		$('.anos_de_fumador_data').hide();
		$('.anos_de_fumador_data').attr('required', false);
		$('.label_Anos_de_fumador').hide();
		$('.group_tiene_dieta').hide();
		$('.group_fumador').hide();
		$('.fumador_data').hide();
		$('.fumador_data').attr('required', false);
		$('.label_Fumador').hide();
		$('.label_Tiene_dieta').hide();
		$('.tiene_dieta_data').hide();
		$('.tiene_dieta_data').attr('required', false);
		calculo();
	});


	function calculo() {
		let edad = $('.edad_data').val();
		let prioridad = $('.prioridad_data').val();
		let relacion_peso_data = $('.relacion_peso_data').val();
		let estatura_data = $('.estatura_data').val();
		let anos_de_fumador_data = $('.anos_de_fumador_data').val();
		let fumador = $("input[name='cGpvdmVuIyRmdW1hZG9yQDNkc2ZzZGYqKjk5MzQzMjQ=']:checked").val();
		let tiene_dieta = $("input[name='cGFuY2lhbm8jJHRpZW5lX2RpZXRhQDNkc2ZzZGYqKjk5MzQzMjQ=']:checked").val();

		if (edad <= 5) {
			let total = parseInt(relacion_peso_data) - parseInt(estatura_data) + 3 || 0;
			let riesgo = edad * prioridad / 100 || 0;
			$('.riesgo_data').val(riesgo);
			$('.prioridad_data').val(total);
			$('.anos_de_fumador_data').hide();
			$('.label_Anos_de_fumador').hide();
			$('.group_tiene_dieta').hide();
			$('.group_fumador').hide();
			$('.fumador_data').hide();
			$('.label_Fumador').hide();
			$('.label_Tiene_dieta').hide();
			$('.tiene_dieta_data').hide();
			$('.label_Relación_peso').show();
			$('.relacion_peso_data').show();

			$('.label_Estatura').show();
			$('.estatura_data').show();
		} else if (edad == 6 || edad <= 12) {
			let total = parseInt(relacion_peso_data) - parseInt(estatura_data) + 2 || 0;
			let riesgo = edad * prioridad / 100 || 0;
			$('.riesgo_data').val(riesgo);
			$('.prioridad_data').val(total);
			$('.anos_de_fumador_data').hide();
			$('.label_Anos_de_fumador').hide();
			$('.group_tiene_dieta').hide();
			$('.group_fumador').hide();
			$('.fumador_data').hide();
			$('.label_Fumador').hide();
			$('.label_Tiene_dieta').hide();
			$('.tiene_dieta_data').hide();
			$('.label_Relación_peso').show();
			$('.relacion_peso_data').show();
			$('.label_Estatura').show();
			$('.estatura_data').show();
			$('.relacion_peso_data').attr('required', true);
		} else if (edad == 13 || edad <= 15) {
			let riesgo = edad * prioridad / 100 || 0;
			$('.riesgo_data').val(riesgo);
			let total = parseInt(relacion_peso_data) - parseInt(estatura_data) + 1 || 0;
			$('.prioridad_data').val(total);
			$('.anos_de_fumador_data').hide();
			$('.label_Anos_de_fumador').hide();
			$('.group_tiene_dieta').hide();
			$('.group_fumador').hide();
			$('.fumador_data').hide();
			$('.label_Fumador').hide();
			$('.label_Tiene_dieta').hide();
			$('.tiene_dieta_data').hide();
			$('.label_Relación_peso').show();
			$('.relacion_peso_data').show();
			$('.label_Estatura').show();
			$('.estatura_data').show();
		} else if (edad == 16 || edad <= 40) {

			if (fumador == 1) {
				let total = anos_de_fumador_data / 4 + 2 || 0;
				$('.prioridad_data').val(total);
				$('.anos_de_fumador_data').show();
				$('.label_Anos_de_fumador').show();
			} else {
				$('.prioridad_data').val(2);
				$('.anos_de_fumador_data').hide();
				$('.label_Anos_de_fumador').hide();
			}

			let riesgo = edad * prioridad / 100 || 0;
			$('.riesgo_data').val(riesgo);

			$('.group_tiene_dieta').hide();
			$('.group_fumador').show();
			$('.fumador_data').show();
			$('.label_Fumador').show();
			$('.label_Tiene_dieta').hide();
			$('.tiene_dieta_data').hide();
			$('.label_Estatura').hide();
			$('.estatura_data').hide();
			$('.estatura_data').attr('required', false);
			$('.label_Relación_peso').hide();
			$('.relacion_peso_data').hide();
			$('.relacion_peso_data').attr('required', false);
			$('.relacion_peso_data').val(0);
		} else if (edad == 41 || edad <= 100) {

			if (tiene_dieta == 0) {
				if (edad == 60 || edad <= 100) {
					let total = edad / 20 + 4 || 0;
					$('.prioridad_data').val(total);
				}
			} else {
				let total = edad / 30 + 3;
				$('.prioridad_data').val(total);
			}

			let riesgo = edad * prioridad / 100 + 5.3 || 0;
			$('.riesgo_data').val(riesgo);
			$('.anos_de_fumador_data').hide();
			$('.anos_de_fumador_data').attr('required', false);
			$('.label_Anos_de_fumador').hide();
			$('.group_tiene_dieta').show();
			$('.group_fumador').hide();
			$('.fumador_data').hide();
			$('.label_Fumador').hide();
			$('.label_Estatura').hide();
			$('.estatura_data').hide();
			$('.estatura_data').attr('required', false);
			$('.relacion_peso_data').attr('required', false);
			$('.label_Relación_peso').hide();
			$('.relacion_peso_data').hide();
			$('.label_Tiene_dieta').show();
			$('.tiene_dieta_data').show();
		}
	}

	$(document).on("keyup change click", ".relacion_peso_data, .fumador_data, .edad_data, .riesgo_data, .anos_de_fumador_data, .prioridad_data, .tiene_dieta_data, .estatura_data", function() {
		calculo();
	});

	$(document).on("change", ".seleccion_estado", function() {
		$('.guardar_datos').click();
		let id_consulta = $(this).data("id");

		$.ajax({
			type: "POST",
			url: "{{ base_url }}/home/obtener_pacientes_atendidos",
			dataType: "json",
			data: {
				valor: id_consulta
			},
			beforeSend: function() {
				$("#pdocrud-ajax-loader").show();
			},
			success: function(response) {
				if (response['mensaje'] == 'correcto') {
					$("#pdocrud-ajax-loader").hide();
					$('.busqueda').click();
				} else {
					Swal.fire(
						'Lo siento!',
						'Los Pacientes atendidos sobrepasan a la cantidad de Pacientes',
						'error'
					)
				}
			}
		});

	});


	$(document).on("pdocrud_after_submission", function(event, obj, data) {
		result = JSON.parse(data);
		if (result['message'] == "Consulta guardada con éxito") {
			$('.pdocrud-back').click();
			Swal.fire(
				'Genial!',
				result['message'],
				'success'
			)
		}

		if (result['message'] == "Paciente guardado con éxito") {
			$('.pdocrud-back').click();
			Swal.fire(
				'Genial!',
				result['message'],
				'success'
			)
		}

		if (result['message'] == "Paciente Actualizado con éxito") {
			$('.pdocrud-back').click();
			Swal.fire(
				'Genial!',
				result['message'],
				'success'
			)
		}
	});
</script>
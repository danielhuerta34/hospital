<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="<?= base_url ?>/home/index" class="btn btn-info">Home</a>
			<a href="<?= base_url ?>/home/modulos" class="btn btn-warning">Modulos</a>
			<a href="<?= base_url ?>/home/profile&id=<?= $_SESSION["users"][0]->id; ?>" class="btn btn-primary">Perfil</a>
			<a href="<?= base_url ?>/login/logout" class="btn btn-danger">Salir</a>
		</div>
	</div>
</div><?php /**PATH D:\xampp74\htdocs\FMVC\app\views/layouts/header.blade.php ENDPATH**/ ?>
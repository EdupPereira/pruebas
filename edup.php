<?php include 'includes/connection.php';

?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?>
<?php
	//CONSULTAR EMPRESA
$empresa= "SELECT * FROM empresa WHERE codigo_empresa='1'";
$run_query = pg_query($conn, $empresa);
if (pg_num_rows($run_query) > 0) {
	while ($fila = pg_fetch_array($run_query)) {
		$descripcion_empresa = $fila['descripcion_empresa'];
		$mision_empresa = $fila['mision_empresa'];
		$vision_empresa = $fila['vision_empresa'];
		$historia_empresa = $fila['historia_empresa'];
		$objetivos_empresa = $fila['objetivos_empresa'];
		$funciones_empresa = $fila['funciones_empresa'];
		$organigrama_empresa = $fila['organigrama_empresa'];
		$tratamientodatos = $fila['tratamientodatos'];
		$condicionesuso = $fila['condicionesuso'];

	}
}
?>
<div class="container">
	

	<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
		<h2 class="ps-4">Edup</h2>
	</div>
	

	<div class=" col-lg-12 col-sm-12 col-xs-12 col-md-12">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Edup</button>
				<button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Misión y Visión</button>
				<button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Historia</button>
				<button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Objetivos y Funciones</button>
				<button class="nav-link" id="v-pills-entidades-tab" data-bs-toggle="pill" data-bs-target="#v-pills-entidades" type="button" role="tab" aria-controls="v-pills-entidades" aria-selected="false">Directorio de Entidades</button>
				<button class="nav-link" id="v-pills-agremiaciones-tab" data-bs-toggle="pill" data-bs-target="#v-pills-agremiaciones" type="button" role="tab" aria-controls="v-pills-agremiaciones" aria-selected="false">Directorio de Asociaciones y Agremiaciones</button>
			</div>
			<hr class="d-block d-sm-block d-md-none">
			<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 tab-content " id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<center>
						<div class="ratio ratio-16x9">
							<iframe src="https://www.youtube.com/embed/XQGG6kdd4f0" title="YouTube video" style="max-width: 100%;height: 100%;" allowfullscreen></iframe>
						</div>
					</center>
					<br>
					<?php echo $descripcion_empresa ?>
				</div>
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><?php echo $mision_empresa ?>
				<?php echo $vision_empresa ?></div>
				<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"></div>
				<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
				<?php echo $objetivos_empresa ?>
				<?php echo $funciones_empresa ?></div>
				<div class="tab-pane fade " id="v-pills-entidades" role="tabpanel" aria-labelledby="v-pills-entidades-tab">
					<div class="table-responsive">
						<center><h3><B>Directorio de Entidades</B></h3></center>
						<?php include ('php/entidades.php'); ?>
					</div>
					
				</div>
				<div class="tab-pane fade " id="v-pills-agremiaciones" role="tabpanel" aria-labelledby="v-pills-agremiaciones-tab">
					<div class="table-responsive">
						
						<center><h3><B>Directorio de Asociaciones y Agremiaciones</B></h3></center> 
						<?php include ('php/agremiaciones.php'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>


</div> 
<script type="text/javascript">
	var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
	triggerTabList.forEach(function (triggerEl) {
		var tabTrigger = new bootstrap.Tab(triggerEl)

		triggerEl.addEventListener('click', function (event) {
			event.preventDefault()
			tabTrigger.show()
		})
	})
</script>
<?php include 'includes/footer.php';?>
<?php include 'includes/connection.php';

?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?>
<!-- Page Content -->
<div class="container-xl">

	<div class="row">

		<!-- Blog Post Content Column -->
		<div class="card col-lg-12 card col-md-12 col-xs-12 col-sm-12 mitexto">
			<h2>Transparencia y acceso a la información pública</h2>
			<div class="alert alert-primary" role="alert">
				De acuerdo a la Ley 1712 de 2014 y a la Resolución 1519 de 2020, La Empresa de Desarrollo Urbano de Pereira pone a disposición de los ciudadanos,la nueva sección de Transparencia y Acceso a la Información Pública Nacional, donde podrán conocer de primera mano la EDUP.

				Según lo dicta la Ley, la información generada por las entidades del Estado no podrá ser reservada o limitada, por el contrario es de carácter público.. En este sitio se proporciona y facilita el acceso a la misma en los términos más amplios posibles en el momentos.
			</div>
		</div>
		<div class="col-md-2 nav flex-column nav-pills card" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<center>
				<B>Categorias</B>
			</center>
			<?php  
				//CONSULTA DEL MENU (CATEGORIAS)
			$categorias= "SELECT * FROM categoria_transparencia";
			$run_query = pg_query($conn, $categorias);
			if (pg_num_rows($run_query) > 0) {
				while ($fila = pg_fetch_array($run_query)) {
					$codigo_categoria=$fila['codigo_categoriat'];
					?>
					<button class="nav-link   text-wrap <?php if($codigo_categoria>1) echo "collapsed"; ?> <?php if($codigo_categoria==1) echo "active"; ?>  " id="v-pills-<?php echo $codigo_categoria; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $codigo_categoria; ?>" type="button" role="tab" aria-controls="collapse<?php echo $codigo_categoria; ?>" aria-selected="true">
						<?php echo $codigo_categoria ."-". $fila["descripcion_categoriat"]; ?> </button>
						<?php
						
					}
				} ?>

			</div> <!-- CERRAR ACORDEON DE LAS CATEGORIAS -->
			<div class="col-md-2  tab-content card"  id="v-pills-tabContent">
				<center><B>Subcategorias</B></center>
				<?php
				
				$categoriasc= "SELECT * FROM categoria_transparencia";
				$run_queryc = pg_query($conn, $categoriasc);
				if (pg_num_rows($run_queryc) > 0) { 
					//CONSULTA DEL MENU (SUBCATEGORIAS)
					while ($filaca = pg_fetch_array($run_queryc)) {
						$codigo_categoria=$filaca['codigo_categoriat'];	?>

						<div class="tab-pane fade  <?php if($codigo_categoria==1) echo "show"; ?> <?php if($codigo_categoria==1) echo "active"; ?>  col-md-12 " id="v-pills-<?php echo $codigo_categoria; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $codigo_categoria; ?>-tab">

							<div class=" nav flex-column nav-pills  " id="v-pills-tab" role="tablist" aria-orientation="vertical">

								<button class="nav-link active btn" id="v-pills-n-tab" data-bs-toggle="pill" data-bs-target="#v-pills-n" type="button" role="tab" aria-controls="v-pills-n" aria-selected="true">Como navegar en este lugar</button>
								<?php  
								$subcategorias= "SELECT * FROM subcategoria_transparencia WHERE codigo_categoriat_fk= '{$filaca['codigo_categoriat']}' ORDER BY codigo_subcat ASC ";

								$run_query_sub = pg_query($conn, $subcategorias);
								if (pg_num_rows($run_query_sub) > 0) {


									while ($sub = pg_fetch_array($run_query_sub)) { 
										$codigo_categoriat_fk=$sub['codigo_categoriat_fk'];	
										$indice_subcat=$sub["indice_subcat"];
										$codigo_subcat=$sub["codigo_subcat"]; ?>

										<button class="nav-link px-4" id="v-pills-n<?php echo $codigo_subcat; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-n<?php echo $codigo_subcat; ?>" type="button" role="tab" aria-controls="v-pills-n<?php echo $codigo_subcat; ?>" aria-selected="false"><?php echo $indice_subcat."-". $sub["descripcion_subcat"]; ?></button>
										<?php


									}

								}
								echo"	</div>
								</div>";

							} 

						} 
						?>

					</div>
					<!-- CERRAR ACORDEON DE LAS SUBCATEGORIAS -->
					<!-- CAJA DONDE SE MUESTRA EL ITEM SELECCIONADO -->
					<div class="col-md-8 tab-content card" id="v-pills-tabContent">
						<!-- MECANISMOS DE CONTACTO CATEGORIA 1 -->
						<div class="tab-pane fade show active" id="v-pills-n" role="tabpanel" aria-labelledby="v-pills-n-tab">
							<br>
							<center>
								<h3>Selecciona un Item</h3>
							</center>
							Haz clic en el item que quieres visualizar.
							Recuerda que puedes exportar la información que necesites en cualquier momento.
						</div>
						<?php  
						

						$subcategorias= "SELECT * FROM subcategoria_transparencia ";
						$mostrar_indice = pg_query($conn, $subcategorias);
						if (pg_num_rows($mostrar_indice) > 0) {


							while ($mostrar = pg_fetch_array($mostrar_indice)) { 
								$codigo_subcat2=$mostrar['codigo_subcat'];
								$codigo_categoriat_fk=$mostrar['codigo_categoriat_fk'];	
								$descripcion_subcat=$mostrar['descripcion_subcat'];	
								$indice_subcatc=$mostrar["indice_subcat"]	


								?>


								<div class="tab-pane fade " id="v-pills-n<?php echo $codigo_subcat2; ?>" role="tabpanel" aria-labelledby="v-pills-n<?php echo $codigo_subcat2; ?>-tab">
									<br>
									<center>
										<h3><?php echo $indice_subcat."-". $mostrar["descripcion_subcat"]; ?></h3>
									</center>
									<br>
									<?php
									$codigo=$codigo_subcat2;
									include ('php/estados_financieros.php'); 
									?>	
								</div>
								<?php 
							}
						}


						?>

					</div> <!-- CIERRA CONTENEDOR DONDE DE MUESTRAN LOS RESULTADOS -->
				</div>
			</div>



			<?php include 'includes/footer.php';?>

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


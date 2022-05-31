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
										<h3><?php echo $indice_subcatc."-". $mostrar["descripcion_subcat"]; ?></h3>
									</center>
									<br>
									<?php  
									//MOSTRAR INFORMACION ESTATICA QUE NO NECESITA TABLA DE CONSULTA
									switch ($codigo_subcat2) {
										//Mecanismos para la atención al ciudadano
										case 2:
										echo'
										<B><center>En la Edup contamos con diversas formas para estableces contacto con nosotros</center></B><hr>
										<div class="col-md-12">
										<div class="ratio ratio-16x9">
										<img src="image/atencionciudadano.png" alt="">
										</div>
										</div>'; 
										break;
										//1.3-Localizacion Fisica, Sucursales, Horarios de atencion
										case 3:
										include 'contac.php';
										break;
										//1.4-Correo Notificaciones Judiciales
										case 4:
										echo' <p>
										La <B>EMPRESA DE DESARROLLO URBANO DE PEREIRA – EDUP</B>, para dar cumplimiento al artículo 197 del nuevo Código de Procedimiento Administrativo y de lo Contencioso Administrativo, informa que recibirá las notificaciones judiciales en el correo:
										<center>
										<div class="text-center">
										<img src="image/imagen1.jpg" class="img-fluid juicio" alt="...">
										</div>
										<a href="mailto:notificacionesjudiciales@edup.gov.co" class="card-link" target="_blank">
										<B>notificacionesjudiciales@edup.gov.co</B>
										</a>
										</center>
										</p>';
										break;
										//2.4-Preguntas y respuestas frecuentes
										case 9:
										include 'php/preguntas.php';
										break;
										//2.5-Glosario
										case 10:
										include 'php/cod_glosario.php';
										break;
										//2.6-Noticias
										case 11:
										echo '	<p>Visita nuestro portal de noticias para mantenerte mas informado.</p>
										<center>
										<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
										<div class="normal">
										<div class="module">
										<div class="thumbnail">
										<img src="image/notiedup.png" alt="">
										</div>

										<div class="content">
										<p class="sub-title">¿Quieres leer más noticias que te pueden interesar?</p>
										<div>
										<br>
										<center>
										<a href="noticias.php" class="custom-btn btn-5">Noticias</a>
										</center>
										</div>

										</div>
										</div>
										</div>
										</div>
										</center>';
										break;
										//2.7-Calendario de actividades
										case 12:
										echo'<p>Puedes descargar, imprimir o añadir la programacion a tu cuenta de Gmail</p>
										<iframe class="col-lg-12 col-sm-12 col-xs-12 col-md-12" src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=America%2FBogota&src=Y2FsZW5kYXJpb2FjdGl2aWRhZGVzZWR1cEBnbWFpbC5jb20&color=%23039BE5" style="border:solid 1px #777"  height="600" frameborder="0" scrolling="no"></iframe>';
										break;
										//2.8-Información para niños, niñas y adolescentes
										case 13:
										echo '	<div style="position: relative; width: 100%; height: 0; padding-top: 250.0000%;
										padding-bottom: 48px; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
										border-radius: 8px; will-change: transform;">
										<iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
										src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAE0CYQHVTQ&#x2F;view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
										</iframe>
										</div>
										<a href="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAE0CYQHVTQ&#x2F;view?utm_content=DAE0CYQHVTQ&amp;utm_campaign=designshare&amp;utm_medium=embeds&amp;utm_source=link" target="_blank" rel="noopener">Portal para niños , niñas y Adolescentes</a> Empresa de Desarrollo Urbano de Pereira';
										break;
										//3.6-Directorio de entidades
										case 20:
										include ('php/entidades.php'); 
										break;
										//3.7-Directorio de agremiaciones, asociaciones y otros grupos de interés
										case 21:
										include ('php/agremiaciones.php'); 
										break;
										//4.1-Sujetos obligados del orden nacional
										case 23:
										echo'<p><B>Somos entidad estatal desentralizada del Orden Territorial</B></p>';
										break;
										//4.3-Otros sujetos obligados
										case 25:
										echo'<p><B>Cumplimiento con el item 4.2 Sujetos obliados al orden territorial</B></p>';
										break;
										//7.4	Entes de control que vigilan la entidad y mecanismos de supervisión
										case 38:
										echo'
										<table class="table table-bordered border-primary" >
										<thead>
										<tr>
										<th><center>Entidad</center></th>
										<th><center>Visitar</center></th>

										</tr>
										</thead>
										<tbody>
										<tr>
										<td class="col-md-8">Fiscalia</td>
										<td class="col-md-4">
										<center>
										<a href="https://www.fiscalia.gov.co/colombia/" target="_blank" title="Fiscalia General de la Nacion"> <button class="btn verde"><i class="fa fa-globe"></i>   Sitio Web</button></a>
										</center>
										</td>
										</tr>
										<tr>
										<td>Procuraduria</td>
										<td>
										<center>
										<a href="https://www.procuraduria.gov.co/" target="_blank" title="Procuraduria"> <button class="btn verde"><i class="fa fa-globe"></i>   Sitio Web</button></a>
										</center>
										</td>
										</tr>
										<tr>
										<td>Contraloria</td>
										<td>
										<center>
										<a href="https://www.contraloria.gov.co/" target="_blank" title="Contraloria"> <button class="btn verde"><i class="fa fa-globe"></i>   Sitio Web</button></a>
										</center>
										</td>
										</tr>

										</tbody>
										</table>
										';
										break;
										//9.1-Tramites y servicios
										case 45:
										echo'<p class"text-center"><B>No aplica porque en la entidad los ciudadanos no realizan tramites</B></p>';
										break;
										//10.0 Informacion minima
										case 46:
										echo '
										<p>Información mínima de cumplimiento de la ley 1712 del 2014</p><br>
										<center>
										<a href="transparencia.php"><button class="btn btn-success">Ley de Transparencia</button></a>
										</center>';
										break; 
										//10.9	Mecanismos para presentar quejas y reclamos en relación con omisiones o acciones del sujeto obligado
										case 54:
										echo'<div class="col-md-12 alert alert-primary mt-3">
										<p>
										<center>
										Recuerda que puedes visitar nuestro&nbsp;&nbsp; <a href="pqrsfd.php"><button class="mitexto btn azul">Portal  PQRSFD</button></a>  
										</center>
										</p>
										</div>';
										break;
										//11.1	Medios de seguimiento para la consulta de estado de las solicitudes de información publica
										case 56:
										echo'<div class="col-md-12 alert alert-primary mt-3">
										<p>
										<center>
										Recuerda que puedes visitar nuestro&nbsp;&nbsp; <a href="pqrsfd.php"><button class="mitexto btn azul">Portal  PQRSFD</button></a>  
										</center>
										</p>
										</div>';
										break;
										//11.2	Formulario para la recepción de solicitudes de información publica
										case 57:
										echo'<div class="col-md-12 alert alert-primary mt-3">
										<p>
										<center>
										Recuerda que puedes visitar nuestro&nbsp;&nbsp; <a href="pqrsfd.php"><button class="mitexto btn azul">Portal  PQRSFD</button></a>  
										</center>
										</p>
										</div>';
										break;
										//12.1	Formato alternativo para grupos étnicos y culturales
										case 58:
										echo '<center>
										<p>Conoce más sobre el <B>Formato Alternativo</B> haciendo clic en el siguiente botón.</p>
										<a href="https://www.urf.gov.co/webcenter/portal/urf/pages_ai/formatoalternativoparagrupostnicosyculturales" target="_blank" ><i class="fa fa-file-text " style="color:#FFFFFF; font-size:20px;"></i><button class="btn btn-success">Ver Formato Alternativo</button> </a>
										</center>';
										break;
										//12.2	Accesibilidad en medios electrónicos para la población en situación de discapacidad
										case 59:
										echo'		
										<center>
										<p>Conoce más sobre el<B> Centro de Relevo</B> haciendo clic en el siguiente botón.</p>
										<a href="https://centroderelevo.gov.co/" target="_blank"><i class="fa fa-sign-language" style="color:#FFFFFF; font-size:20px;"></i><button class="btn btn-success">Centro de Relevo</button> </a>
										</center>
										<hr>
										<p>Puedes dirigirte a los iconos que están situados en la parte lateral derecha y acceder a ellos haciendo clic</p>
										<div class="col-md-12">
										<div class="ratio ratio-16x9">

										<img src="image/barra.png" alt="">
										</div>

										</div>';
										break;
										default:
										$codigo=$codigo_subcat2;
										include ('php/estados_financieros.php'); 
									} ?>

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


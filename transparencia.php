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
			$categorias= "SELECT * FROM categoria_transparencia ORDER BY codigo_categoriat ASC";
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
		<!-- 	SESION DE LAS SUBCATEGORIAS -->
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
								$subcategorias= "SELECT * FROM subcategoria_transparencia WHERE codigo_categoriat_fk= '{$filaca['codigo_categoriat']}' ORDER BY indice_subcat ASC ";

								$run_query_sub = pg_query($conn, $subcategorias);
								if (pg_num_rows($run_query_sub) > 0) {


									while ($sub = pg_fetch_array($run_query_sub)) { 
										$codigo_categoriat_fk=$sub['codigo_categoriat_fk'];	
										$indice_subcat=$sub["indice_subcat"];
										$codigo_subcat=$sub["codigo_subcat"]; 
										//ESTE SWICHT SIRVE PARA NO MOSTRAR SUCATEGORIAS EN LA LEY DE TRANSPATENCIA COMO POR EJEMPLO 6.1.2 - 6.1.1 - 6.1.3 - 6.1.4 - 6.1.5 - 6.1.6 - 6.1.7 - 6.1.8 - 6.1.9 - 6.1.10 - 6.1.11 - 6.1.12 - 6.1.13 - 6.1.14 - 6.1.15 - 6.1.16 - 6.1.17 Y LUEGO ADJUNTARLAS EN LA SUBCATEGORIA PRINCIPAL 6.1 ESTO SE REALIZA CON EL CODIGO DE LA SUBCATEGORIA Y SOLO SE PONE QUE EN EL CASO DE QUE EL CODIGO COINCIDA MUESTRE VACIO Y POR DEFECTO SE MOSTRARA EL BOTON DE LA SUBCATEGORIA ESTO QUIERE DECIR QUE SI LA SUBCATEGORIA NO CORRESPONDE A NINGUN DATO VACIO DEL SWITCH ENTONCES MUSTRE EL DEFAULT 
										switch ($codigo_subcat) {
											case 62:
											break;
											case 63:
											break;
											case 65:
											break;
											case 66:
											break;
											case 67:
											break;
											case 68:
											break;
											case 69:
											break;
											case 70:
											break;
											case 71:
											break;
											case 73:
											break;
											case 74:
											break;
											case 75:
											break;
											case 76:
											break;
											case 77:
											break;
											case 78:
											break;
											case 79:
											break;
											case 80:
											break;
											case 81:
											break;
											case 82:
											break;
											case 83:
											break;
											default; ?>
											<button class="nav-link px-4" id="v-pills-n<?php echo $codigo_subcat; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-n<?php echo $codigo_subcat; ?>" type="button" role="tab" aria-controls="v-pills-n<?php echo $codigo_subcat; ?>" aria-selected="false"><?php echo $indice_subcat."-". $sub["descripcion_subcat"]; ?></button>
											<?php
										}

									}

								}
								echo"	
								</div>
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
										//PUNTO 4.2 Sujetos obligados del orden territorial-Resoluciones AGRUPACION DE NORMOGRAMA, RESOLUCIONES DE GERENCIA Y ACUERDOS DE JUNTA DIRECTIVA
										case 24:
										echo'
										<div class="accordion" id="accordionExample">
										<div class="accordion-item">
										<h2 class="accordion-header" id="headingThree">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Normograma
										</button>
										</h2>
										<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
										<div class="accordion-body">
										';
										$codigo='69';
										include ('php/consulta_archivo.php'); 
										echo'
										</div>
										</div>
										</div>

										</div>
										<div class="accordion" id="accordionExample">
										<div class="accordion-item">
										<h2 class="accordion-header" id="resolucion">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapser" aria-expanded="false" aria-controls="collapser">
										Resoluciones de Gerencia
										</button>
										</h2>
										<div id="collapser" class="accordion-collapse collapse" aria-labelledby="resolucion" data-bs-parent="#accordionExample">
										<div class="accordion-body">
										';
										$codigo='24';
										include ('php/estados_financieros.php'); 
										echo'
										</div>
										</div>
										</div>

										</div>
										<div class="accordion" id="accordionExample">
										<div class="accordion-item">
										<h2 class="accordion-header" id="acuerdos">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapacu" aria-expanded="false" aria-controls="collapacu">
										Acuerdos de Junta Directiva
										</button>
										</h2>
										<div id="collapacu" class="accordion-collapse collapse" aria-labelledby="acuerdos" data-bs-parent="#accordionExample">
										<div class="accordion-body">
										';
										$codigo='70';
										include ('php/estados_financieros.php'); 
										echo'
										</div>
										</div>
										</div>

										</div>
										';
										break;
										//PUNTO 6.1 AGRUPACION DE POLITICAS Y MANUALES
										case 29:
										echo '	<div class="accordion" id="accordionExample">
										<div class="accordion-item">
										<h2 class="accordion-header" id="politicas">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapoliti" aria-expanded="false" aria-controls="collapoliti">
										Políticas
										</button>
										</h2>
										<div id="collapoliti" class="accordion-collapse collapse" aria-labelledby="politicas" data-bs-parent="#accordionExample">
										<div class="accordion-body">
										';
										$codigo="29";
										include ("php/estados_financieros.php"); 
										echo'
										</div>
										</div>
										</div>

										</div>
										<div class="accordion" id="accordionExample">
										<div class="accordion-item">
										<h2 class="accordion-header" id="manuales">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collamanuales" aria-expanded="false" aria-controls="collamanuales">
										Manuales
										</button>
										</h2>
										<div id="collamanuales" class="accordion-collapse collapse" aria-labelledby="manuales" data-bs-parent="#accordionExample">
										<div class="accordion-body">
										';
										$codigo='63';
										include ('php/estados_financieros.php'); 
										echo'
										</div>
										</div>
										</div>

										</div>';
										break;
										//PUNTO 6.2 Plan de acción
										case 30: ?>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="planaccion">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collaplanaccion" aria-expanded="false" aria-controls="collaplanaccion">
														Plan de acción
													</button>
												</h2>
												<div id="collaplanaccion" class="accordion-collapse collapse" aria-labelledby="planaccion" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='30';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="estrategicos">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapestra" aria-expanded="false" aria-controls="collapestra">
														Plan Estrategico
													</button>
												</h2>
												<div id="collapestra" class="accordion-collapse collapse" aria-labelledby="estrategicos" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='62';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="pnegocios">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapnegocios" aria-expanded="false" aria-controls="collapnegocios">
														Plan de Negocios
													</button>
												</h2>
												<div id="collapnegocios" class="accordion-collapse collapse" aria-labelledby="pnegocios" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='81';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="rendicion">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collaprendicion" aria-expanded="false" aria-controls="collaprendicion">
														Estretagia de Rendición de Cuentas
													</button>
												</h2>
												<div id="collaprendicion" class="accordion-collapse collapse" aria-labelledby="rendicion" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='65';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>

										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="antitramites">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapanti" aria-expanded="false" aria-controls="collapanti">
														Plan Antitramites
													</button>
												</h2>
												<div id="collapanti" class="accordion-collapse collapse" aria-labelledby="antitramites" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<p>Los ciudadanos no realizan ningún tramite en la entidad.</p>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="corrupcion">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapanticorrupcion" aria-expanded="false" aria-controls="collapanticorrupcion">
														Plan Anticorrupción y Atención al Ciudadano 
													</button>
												</h2>
												<div id="collapanticorrupcion" class="accordion-collapse collapse" aria-labelledby="corrupcion" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='68';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="pinar">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collappinar" aria-expanded="false" aria-controls="collappinar">
														Plan Institucional de Archivo PINAR
													</button>
												</h2>
												<div id="collappinar" class="accordion-collapse collapse" aria-labelledby="pinar" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='74';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="talento">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collaptalento" aria-expanded="false" aria-controls="collaptalento">
														Plan Estratégico de Talento Humano
													</button>
												</h2>
												<div id="collaptalento" class="accordion-collapse collapse" aria-labelledby="talento" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='75';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="vacantes">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapvacantes" aria-expanded="false" aria-controls="collapvacantes">
														Plan Anual de Vacantes
													</button>
												</h2>
												<div id="collapvacantes" class="accordion-collapse collapse" aria-labelledby="vacantes" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='73';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>


										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="humano">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collaphumano" aria-expanded="false" aria-controls="collaphumano">
														Plan de Previsión Recursos Humanos
													</button>
												</h2>
												<div id="collaphumano" class="accordion-collapse collapse" aria-labelledby="humano" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='76';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="capacitacion">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapcapa" aria-expanded="false" aria-controls="collapcapa">
														Plan Institucional de Capacitación 
													</button>
												</h2>
												<div id="collapcapa" class="accordion-collapse collapse" aria-labelledby="capacitacion" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='77';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="incentivos">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapincantivos" aria-expanded="false" aria-controls="collapincantivos">
														Plan de Bienestar Laboral e Incentivos
													</button>
												</h2>
												<div id="collapincantivos" class="accordion-collapse collapse" aria-labelledby="incentivos" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='78';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="seguridad">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseguridad" aria-expanded="false" aria-controls="collapseguridad">
														Plan Anual Seguridad y Salud en el Trabajo
													</button>
												</h2>
												<div id="collapseguridad" class="accordion-collapse collapse" aria-labelledby="seguridad" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='79';
														include ('php/consulta_archivo.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="riesgos">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapriesgos" aria-expanded="false" aria-controls="collapriesgos">
														Riesgos de Corrupción
													</button>
												</h2>
												<div id="collapriesgos" class="accordion-collapse collapse" aria-labelledby="riesgos" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='80';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="riesgosp">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapriesgop" aria-expanded="false" aria-controls="collapriesgop">
														Plan Tratamiento Riesgos Seguridad y Privacidad 2022
													</button>
												</h2>
												<div id="collapriesgop" class="accordion-collapse collapse" aria-labelledby="riesgosp" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='82';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="seguridadp">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseguridadp" aria-expanded="false" aria-controls="collapseguridadp">
														Plan de Seguridad y Privacidad
													</button>
												</h2>
												<div id="collapseguridadp" class="accordion-collapse collapse" aria-labelledby="seguridadp" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='83';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<?php  
										break;
										case 36: ?>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="informes">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapinformes" aria-expanded="false" aria-controls="collapinformes">
														Informes Control Interno
													</button>
												</h2>
												<div id="collapinformes" class="accordion-collapse collapse" aria-labelledby="informes" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='36';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="gasto">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapgasto" aria-expanded="false" aria-controls="collapgasto">
														Informes Austeridad en el Gasto
													</button>
												</h2>
												<div id="collapgasto" class="accordion-collapse collapse" aria-labelledby="gasto" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='71';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<div class="accordion" id="accordionExample">
											<div class="accordion-item">
												<h2 class="accordion-header" id="pqrsfd">
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collappqrsdf" aria-expanded="false" aria-controls="collappqrsdf">
														Informes PQRSFD
													</button>
												</h2>
												<div id="collappqrsdf" class="accordion-collapse collapse" aria-labelledby="pqrsfd" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php
														$codigo='55';
														include ('php/estados_financieros.php'); 
														?>
													</div>
												</div>
											</div>

										</div>
										<?php  
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


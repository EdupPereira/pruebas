<?php include ('includes/connection.php'); 
include "includes/adminheader.php";
include "includes/adminnav.php";
if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}

if (isset($_POST['respuesta'])) {

	$respuesta_detalle=$_FILES['respuesta_pdf']['name'];
	$guardar_pdf=$_FILES['respuesta_pdf']['tmp_name'];
	$comentario_detalle=$_POST['comentario_detalle'];
	$codigo_llegada=$_POST['codigo_llegada'];
	$nuevo_estado="Terminado";

	if (move_uploaded_file($guardar_pdf,'../pqrsd/'.$respuesta_detalle )) { 
			//Si el formulario trae un archivo entonces se inserta de la siguiente forma
		$editar_detalle = "UPDATE pqrsd_detalle SET estado_llegada='{$nuevo_estado}', respuesta_detalle = '{$respuesta_detalle}' , comentario_detalle = '{$comentario_detalle}'  WHERE codigo_llegada = '{$codigo_llegada}'";
		$run_pub_query = pg_query($conn, $editar_detalle);
		if (pg_affected_rows($run_pub_query) > 0) {
			echo "<script>swal('Post publicado satisfactoriamente');
			window.location.href='verpqrsd.php?r='".$codigo_llegada."'';</script>";
		}
		else {
			echo "<script>swal('Ocurrió un error. Intente nuevamente!');</script>";   
		}

	}
}
?>
<!-- CONTENEDOR AGREGAR Y TABLA DE CONSULTA -->
<div class="container-fluid">
	<div class="row">
		<?php 
		$codigo_llegada = pg_escape_string($conn,$_GET['r']);
			//echo $codigo_llegada;
		if (empty($codigo_llegada)){
			$radicado = "SELECT pd.codigo_llegada,pd.fecha_llegada,pd.codigo_identidad_fk,pd.codigo_solicitud_fk,pd.codigo_pqrsd_fk,pd.codigo_persona_fk,pd.estado_llegada,ti.codigo_identidad,ti.nombre_identidad,ts.codigo_solicitud,ts.nombre_solicitud,pq.codigo_pqrsd,pq.identificacion_pqrsd,pq.nombres_pqrsd,pq.direccion_pqrsd,pq.departamento_pqrsd,pq.telefono_pqrsd,pq.correo_pqrsd,pq.descripcion_pqrsd,pq.archivo_pqrsd,pq.aceptar_pqrsd,pq.pais_pqrsd,pq.municipio_pqrsd,tp.codigo_persona,tp.nombre_persona
			FROM pqrsd_detalle pd
			INNER JOIN tipo_identidad ti
			ON pd.codigo_identidad_fk = ti.codigo_identidad
			INNER JOIN tipo_solicitud ts
			ON pd.codigo_solicitud_fk = ts.codigo_solicitud
			INNER JOIN pqrsd pq
			ON pd.codigo_pqrsd_fk = pq.codigo_pqrsd
			INNER JOIN tipo_persona tp
			ON pd.codigo_persona_fk = tp.codigo_persona

			ORDER BY pd.codigo_llegada ASC ";
			$run_query2 = pg_query($conn, $radicado);
			if (pg_num_rows($run_query2) > 0) {?>

				<div id="main" class="col-md-12">
					<center><h4>PQRSFD</h4></center>
					<table id="tabla_llegada" class="table table-hover">
						<thead>
							<tr>
								<th>Código</th>
								<th>Fecha</th>
								<th>Identificación</th>
								<th>Nombres</th>
								<th>Solicitud</th>
								<th>Estado</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php  
							while ($fila2 = pg_fetch_array($run_query2)) {
								$codigo_llegada=$fila2['codigo_llegada'];
								$fecha_llegada=$fila2['fecha_llegada'];
								$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
								$nombre_solicitud=$fila2['nombre_solicitud'];
								$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
								$nombres_pqrsd=$fila2['nombres_pqrsd'];
								$estado=$fila2['estado_llegada'];

								//FORMATEAR FECHA PARA QUE NOS MUESTRE EJ: 29/05/2020
								$fecha_llegada_formateada = date("d/m/Y", strtotime($fecha_llegada));
								
								echo'
								<tr>
								<td>'.$codigo_llegada.'</td>
								<td>'.$fecha_llegada_formateada.'</td>
								<td>'.$identificacion_pqrsd.'</td>
								<td>'.$nombres_pqrsd.'</td>
								<td>'.$nombre_solicitud.'</td>
								<td>'.$estado.'</td>
								<td>';
								if($estado=="Pendiente"){
									echo'
									<center>
									<a href="verpqrsd.php?r='.$codigo_llegada.'">
									<button class="btn btn-success">Responder</button>
									</center>
									</a>
									';

								}else{
									echo'
									<center>
									<a href="verpqrsd.php?r='.$codigo_llegada.'">
									<button class="btn btn-warning">Ver</button>
									</a>
									</center>
									';
								}
								echo'
								</td>
								</tr>

								';
							}
							echo'
							</tbody>
							</table>

							</div>
							';
			}//TERMINA LA CONSULTA GENERAL 


		}else{

			$radicado = "SELECT pd.codigo_llegada,pd.fecha_llegada,pd.codigo_identidad_fk,pd.codigo_solicitud_fk,pd.codigo_pqrsd_fk,pd.codigo_persona_fk,pd.estado_llegada,pd.respuesta_detalle,pd.comentario_detalle,ti.codigo_identidad,ti.nombre_identidad,ts.codigo_solicitud,ts.nombre_solicitud,pq.codigo_pqrsd,pq.identificacion_pqrsd,pq.nombres_pqrsd,pq.direccion_pqrsd,pq.departamento_pqrsd,pq.telefono_pqrsd,pq.correo_pqrsd,pq.descripcion_pqrsd,pq.archivo_pqrsd,pq.aceptar_pqrsd,pq.pais_pqrsd,pq.municipio_pqrsd,tp.codigo_persona,tp.nombre_persona
			FROM pqrsd_detalle pd
			INNER JOIN tipo_identidad ti
			ON pd.codigo_identidad_fk = ti.codigo_identidad
			INNER JOIN tipo_solicitud ts
			ON pd.codigo_solicitud_fk = ts.codigo_solicitud
			INNER JOIN pqrsd pq
			ON pd.codigo_pqrsd_fk = pq.codigo_pqrsd
			INNER JOIN tipo_persona tp
			ON pd.codigo_persona_fk = tp.codigo_persona

			WHERE  pd.codigo_llegada='{$codigo_llegada}' ORDER BY pd.codigo_llegada DESC  ";
			$run_query2 = pg_query($conn, $radicado);
			if (pg_num_rows($run_query2) > 0) {
				while ($fila2 = pg_fetch_array($run_query2)) {
					$codigo_llegada=$fila2['codigo_llegada'];
					$fecha_llegada=$fila2['fecha_llegada'];
					$nombre_identidad=$fila2['nombre_identidad'];
					$nombre_solicitud=$fila2['nombre_solicitud'];
					$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
					$nombres_pqrsd=$fila2['nombres_pqrsd'];
					$estado=$fila2['estado_llegada'];	
					$direccion_pqrsd=$fila2['direccion_pqrsd'];
					$departamento_pqrsd=$fila2['departamento_pqrsd'];
					$telefono_pqrsd=$fila2['telefono_pqrsd'];
					$correo_pqrsd=$fila2['correo_pqrsd'];
					$descripcion_pqrsd=$fila2['descripcion_pqrsd'];
					$archivo_pqrsd=$fila2['archivo_pqrsd'];
					$aceptar_pqrsd=$fila2['aceptar_pqrsd'];
					$respuesta_detalle=$fila2['respuesta_detalle'];
					$comentario_detalle=$fila2['comentario_detalle'];
					$pais_pqrsd=$fila2['pais_pqrsd'];
					$municipio_pqrsd=$fila2['municipio_pqrsd'];
					$nombre_persona=$fila2['nombre_persona'];
				}?>
				<?php
				if ($estado=="Pendiente") {?>
					<div class="card shadow mb-4">
						<!-- Card Header - Accordion -->
						<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
						role="button" aria-expanded="true" aria-controls="collapseCardExample">
						<h6 class="m-0 font-weight-bold text-info"><center><h4 class="border-bottom-success py-3"><B>Responder PQRSFD</B></h4></center></h6>
					</a>
					<!-- Card Content - Collapse -->
					<div class="collapse show" id="collapseCardExample">
						<div class="card-body">
							<form class="col-md-12 row g-3 needs-validation"  action="" method="post" enctype="multipart/form-data" novalidate>
								<input type="hidden" value="<?php echo $codigo_llegada ?>" name="codigo_llegada"> 
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
									<label for="archivo" class="form-label">Solo Formato PDF</label>
									<input type="file" class="form-control" id="respuesta_pdf" name="respuesta_pdf" required>
									<div class="valid-feedback">
										Correcto!
									</div>
									<div class="invalid-feedback">
										Selecciona un archivo.
									</div>
								</div>
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
									<label for="archivo" class="form-label">Comentario</label>
									<textarea name="comentario_detalle" required class="ckeditor"> </textarea>
									<div class="invalid-feedback">
										Por favor añade un comentario 
									</div>
									<div class="valid-feedback">
										Correcto!
									</div>
								</div>
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
									<br>
									<button class="btn btn-info" name="respuesta">Enviar Respuesta</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php  
			} 
			?>

			<?php
			echo '

			<div class="card col-md-12 py-3 border-bottom-info"><center><h4><B>Información PQRSFD</B></h4></center></div>

			<div class="card col-md-4"><B>Codigo Llegada :</B>'.$codigo_llegada.'</div>
			<div class="card col-md-4"><B>Fecha :</B> '.$fecha_llegada.'</div>
			<div class="card col-md-4"><B>Tipo PQRSFD : </B>'.$nombre_solicitud.'</div>

			<div class="card col-md-4"><B>Identidad :</B>'.$nombre_identidad.'</div>
			<div class="card col-md-4"><B>Tipo de Persona :</B>'.$nombre_persona.'</div>
			<div class="card col-md-4"><B># ID :</B> '.$identificacion_pqrsd.'</div>
			<div class="card col-md-4"><B>Nombres : </B>'.$nombres_pqrsd.'</div>

			<div class="card col-md-4"><B>Pais : </B>'.$pais_pqrsd.'</div>
			<div class="card col-md-4"><B>Municipio : </B>'.$municipio_pqrsd.'</div>
			<div class="card col-md-4"><B>Departamento :</B>'.$departamento_pqrsd.'</div>
			<div class="card col-md-4"><B>Dirección :</B> '.$direccion_pqrsd.'</div>
			<div class="card col-md-4"><B>Telefono : </B>'.$telefono_pqrsd.'</div>

			<div class="card col-md-4"><B>Correo :</B>'.$correo_pqrsd.'</div>
			<div class="card col-md-4"><B>Estado :</B> '.$estado.'</div>
			<div class="card col-md-4"><B>Acepto Terminos y Condiciones : </B>'.$aceptar_pqrsd.'</div>

			<div class="card col-md-12"><p><br><B>Descripción :</B> '.$descripcion_pqrsd.'</p></div>';
			if ($archivo_pqrsd != null) {
				echo'
				<div class="card col-md-12 "><p><br><B>Archivos Adjuntos :</B> <a href="../pqrsd/'.$archivo_pqrsd.'" target="_blank"><button class="btn btn-danger"><i class="fas fa-file-pdf"></i> Ver PDF</button></a></p></div>

				';
			}else{
				echo'
				<div class="card col-md-12 "><p><br><B>Archivos Adjuntos : </B> No se adjunto ningún archivo. </p></div>

				';
			}
			if ($estado=="Terminado") {
				echo '
				<div class="card col-md-12 py-3 border-bottom-warning"><center><h4><B>RESPUESTA PQRSD</B></h4></center></div>
				<div class="card col-md-12"><p><br><B>Descripción :</B> '.$comentario_detalle.'</p></div>
				<div class="card col-md-12 "><p><br><B>Respuesta :</B> <a href="../pqrsd/'.$respuesta_detalle.'" target="_blank"><button class="btn btn-danger"><i class="fas fa-file-pdf"></i> Ver PDF</button></a></p></div>
				';

			}	

		}else{
			echo " <center><h4>Lo sentimos aun no hay ninguna Solicitud de PQRSFD</h4></center>";
		}
	}
	?>
</div> 
</div>


</div>
<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
	'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
  	form.addEventListener('submit', function (event) {
  		if (!form.checkValidity()) {
  			event.preventDefault()
  			event.stopPropagation()
  		}else{
  			swal("Buen Trabajo!", "El formulario se completo con exito", "success");
  		}
  		form.classList.add('was-validated')
  	}, false)
  })
})()
</script>


<?php include ('includes/adminfooter.php');?>

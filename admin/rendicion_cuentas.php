<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');


	if (isset($_POST['irendicion'])) {
		$image = $_FILES['image']['name'];
		$ext = $_FILES['image']['type'];
		$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
		if (empty($image)) {
			echo "<script>alert('Adjunta una imagen');</script>";
		}
		else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
		{
			echo "<script>alert('El tamaño de la imagen no es correcto');</script>";
		}
		else if (!in_array($ext, $validExt)){
			echo "<script>alert('No es una imagen válida.');</script>";

		}
		else {
			//print_r($_FILES);
			$folder  = '../rendicion/';
			$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
			$picture = rand(1000 , 1000000) .'.'.$imgext;
			$archivo_rendicion=$_FILES['archivo_rendicion']['name'];
			$guardar_pdf=$_FILES['archivo_rendicion']['tmp_name'];


			if (move_uploaded_file($guardar_pdf,'../rendicion/'.$archivo_rendicion) && move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
				$video_rendicion =$_POST['video_rendicion'];
				//$archivo_rendicion =$_POST['archivo_rendicion'];
				$encuesta_rendicion=$_POST['encuesta_rendicion'];
				$asistencia_rendicion =$_POST['asistencia_rendicion'];
				$estado_rendicion=$_POST['estado_rendicion'];
				$descripcion_rendicion =$_POST['descripcion_rendicion'];
				$fecha_rendicion=$_POST['fecha_rendicion'];

				$query = "INSERT INTO rendicion (video_rendicion, archivo_rendicion, encuesta_rendicion, asistencia_rendicion, estado_rendicion, descripcion_rendicion, fecha_rendicion,img_rendicion) VALUES ('$video_rendicion', '$archivo_rendicion', '$encuesta_rendicion', '$asistencia_rendicion', '$estado_rendicion', '$descripcion_rendicion', '$fecha_rendicion','$picture')";
				$result = pg_query($query);
				if (pg_affected_rows($result) > 0) {
					echo '<script>
					swal("Buen Trabajo!", "Se registro con éxito", "success");
					</script>';
				}
				else {
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
				}

			//echo "Archivo guardado";
			}else {
				echo "ERROR";
			}
		}

	}

	if(isset($_POST['editarRendicion'])) {

		$cod_rendicion = $_POST['cod_rendicion'];
		$video_rendicion =$_POST['video_rendicion'];
		$archivo_rendicion =$_POST['archivo_rendicion'];
		$encuesta_rendicion=$_POST['encuesta_rendicion'];
		$asistencia_rendicion =$_POST['asistencia_rendicion'];
		$estado_rendicion=$_POST['estado_rendicion'];
		$descripcion_rendicion =$_POST['descripcion_rendicion'];
		$fecha_rendicion=$_POST['fecha_rendicion'];
		
		$editarRol = "UPDATE rendicion SET video_rendicion = '$video_rendicion',archivo_rendicion='$archivo_rendicion',encuesta_rendicion='$encuesta_rendicion',asistencia_rendicion='$asistencia_rendicion',estado_rendicion='$estado_rendicion',descripcion_rendicion='$descripcion_rendicion',fecha_rendicion='$fecha_rendicion' WHERE cod_rendicion = '$cod_rendicion'";

		$resultado = pg_query($editarRol);
		if (pg_affected_rows($resultado) > 0 ) {
			echo '<script>
			swal("Buen Trabajo!", "Se edito con éxito", "success");
			</script>';
		}

		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error", "error");</script>';
		}


	} 

	if(isset($_POST['elimina_rendicion'])) {
		$codigo_rendicion_eliminar =$_POST['elimina_rendicion'];
		$del_query = "DELETE FROM rendicion WHERE cod_rendicion='$codigo_rendicion_eliminar'";
		$run_del_query = pg_query($del_query);
		if (pg_affected_rows($run_del_query) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "Se Elimino con éxito", "success");
			</script>';
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
		<div class="col-md-4"></div>
		<div class="card mb-3">
			<div class="card-header">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGlosario">
					Añadir Rendicion de Cuentas
				</button>
			</div>
			
			<!-- Modal Glosario -->
			<div class="modal fade" id="modalGlosario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post"  enctype="multipart/form-data">
								<label for="inputEmail4">Fecha</label>
								<input type="date"  name="fecha_rendicion" class="form-control">
								<label for="inputEmail4">Imagen</label>
								<input class="form-control" type="file" name="image">
								<label for="inputEmail4">Video</label>
								<input type="text" name="video_rendicion" class="form-control" placeholder="Inserte Video">
								<label for="inputEmail4">Encuesta</label>
								<input type="text" name="encuesta_rendicion" class="form-control" placeholder="Inserte Encuesta">
								<label for="inputEmail4">Asistencia</label>
								<input type="text" name="asistencia_rendicion" class="form-control" placeholder="Inserte Asistencia">
								<label for="inputEmail4">Archivo</label>
								<input class="form-control" type="file" name="archivo_rendicion">
								<label for="inputEmail4">Estado</label>
								<select name="estado_rendicion" class="form-control">
									<option value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
								</select>
								<label for="inputEmail4">Descripcion</label>
								<textarea name="descripcion_rendicion" id="" cols="30" rows="10">Descripcion</textarea>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="irendicion">
									Guardar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>

	</div>
	<!-- 	SOLO EL ROL SUPERADMINISTRADOR PUEDE ACCEDER A ESTA SESION -->
	<?php if($_SESSION['role'] == 'superadmin')  
	{ ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tabla_glosario" class="table table-bordered table-striped  ">
						<thead class="btn-info">
							<tr>
								<th>Código</th>
								<th>Fecha</th>
								<th>Img</th>
								<th>Video</th>
								<th>Descripcion</th>
								<th>Archivo</th>
								<th>Encuesta</th>
								<th>Asistencia</th>
								<th>Estado</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody>
							<!-- CONSULTA A LA BD -->
							<?php

							$query = "SELECT  cod_rendicion, video_rendicion, archivo_rendicion, encuesta_rendicion, asistencia_rendicion, estado_rendicion, descripcion_rendicion, fecha_rendicion,img_rendicion FROM rendicion ORDER BY fecha_rendicion DESC";
							$run_query = pg_query($conn, $query);

							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$cod_rendicion = $row['cod_rendicion'];
									$video_rendicion =$row['video_rendicion'];
									$archivo_rendicion =$row['archivo_rendicion'];
									$encuesta_rendicion=$row['encuesta_rendicion'];
									$asistencia_rendicion =$row['asistencia_rendicion'];
									$estado_rendicion=$row['estado_rendicion'];
									$descripcion_rendicion =$row['descripcion_rendicion'];
									$fecha_rendicion=$row['fecha_rendicion'];
									$img_rendicion =$row['img_rendicion'];

									echo "<tr>";
									echo "<td>$cod_rendicion</td>";
									echo "<td>$fecha_rendicion</td>";
									echo "<td><img  width='100' src='../rendicion/$img_rendicion' alt='' ></td>";
									echo "<td>$video_rendicion</td>";
									echo "<td>$descripcion_rendicion</td>";
									echo "<td>$archivo_rendicion</td>";
									echo "<td>$encuesta_rendicion</td>";
									echo "<td>$asistencia_rendicion</td>";
									echo "<td>$estado_rendicion</td>";
									
									
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editRendicion' data-toggle='modal' data-cod_rendicion='".$cod_rendicion."' data-video_rendicion='".$video_rendicion."' data-archivo_rendicion='".$archivo_rendicion."' data-encuesta_rendicion='".$encuesta_rendicion."' data-asistencia_rendicion='".$asistencia_rendicion."' data-estado_rendicion='".$estado_rendicion."' data-descripcion_rendicion='".$descripcion_rendicion."' data-fecha_rendicion='".$fecha_rendicion."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="aeliminar_rendicion" method="POST" >
									<td>
									<input type="hidden" name="elimina_rendicion" value="'.$cod_rendicion.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							
							?>
						</tbody>
					</table>
				</div>
			</div>
		
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR ROL-->
<div class="modal fade" id="editRendicion" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Glosario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" >
					<label for="inputEmail4">Fecha</label>
					<input type="date"  id="fecha_rendicion" name="fecha_rendicion" class="form-control">
					<label for="inputEmail4">Video</label>
					<input type="text" id="video_rendicion" name="video_rendicion" class="form-control" placeholder="Inserte Video">
					<label for="inputEmail4">Encuesta</label>
					<input type="text" id="encuesta_rendicion" name="encuesta_rendicion" class="form-control" placeholder="Inserte Encuesta">
					<label for="inputEmail4">Asistencia</label>
					<input type="text" id="asistencia_rendicion" name="asistencia_rendicion" class="form-control" placeholder="Inserte Asistencia">
					<label for="inputEmail4">Archivo</label>
					<input class="form-control" type="file" name="archivo_rendicion">
					<label for="inputEmail4">Estado</label>
					<select id="estado_rendicion" name="estado_rendicion" class="form-control">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
					</select>
					<label for="inputEmail4">Descripcion</label>
					<textarea name="descripcion_rendicion" id="descripcion_rendicion" cols="30" rows="10">Descripcion</textarea>
					<input type="number" id="cod_rendicion">
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarGlosario">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 
<script>
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#editRendicion').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var cod_rendicion = button.data('cod_rendicion'); // Extraer información de datos- * atributos
          var fecha_rendicion = button.data('fecha_rendicion');
          var video_rendicion = button.data('video_rendicion');
          var encuesta_rendicion = button.data('encuesta_rendicion');
          var asistencia_rendicion = button.data('asistencia_rendicion');
          var estado_rendicion = button.data('estado_rendicion');
          var descripcion_rendicion = button.data('descripcion_rendicion');
          
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #cod_rendicion').val(cod_rendicion);
          modal.find('.modal-body #fecha_rendicion').val(fecha_rendicion);
          modal.find('.modal-body #video_rendicion').val(video_rendicion);
          modal.find('.modal-body #encuesta_rendicion').val(encuesta_rendicion);
          modal.find('.modal-body #asistencia_rendicion').val(asistencia_rendicion);
          modal.find('.modal-body #estado_rendicion').val(estado_rendicion);
          modal.find('.modal-body #descripcion_rendicion').val(descripcion_rendicion);

      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_rendicion').submit(function(e){
	e.preventDefault();
	swal({
		title: "Estas Seguro?",
		text: "Una vez eliminado, ¡no podrá recuperar este archivo!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			this.submit();
		} else {
			swal("La información esta a salvo!");
		}
	});
});
</script>

<?php include ('includes/adminfooter.php');?>

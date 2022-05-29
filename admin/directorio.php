<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');

if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user') {
	echo "<script> alert('Solo los Administradores pueden agregar Usuarios');
	window.location.href='./index.php'; </script>";
}
else {
	if (isset($_POST['idirectorio'])) {

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
			$nombre_directorio = $_POST['nombre_directorio'];
			$telefono_directorio = $_POST['telefono_directorio'];
			$direccion_directorio = $_POST['direccion_directorio'];
			$correo_directorio = $_POST['correo_directorio'];
			$tipo_directorio = $_POST['tipo_directorio'];
			$sitioweb_directorio = $_POST['sitioweb_directorio'];
			$folder  = '../directorio/';
			$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
			$picture = rand(1000 , 1000000) .'.'.$imgext;
			if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
				$query = "INSERT INTO directorio(nombre_directorio, telefono_directorio,direccion_directorio,correo_directorio,tipo_directorio,sitioweb_directorio,img_directorio) VALUES ('$nombre_directorio','$telefono_directorio','$direccion_directorio','$correo_directorio','$tipo_directorio','$sitioweb_directorio','$picture')";
				$result = pg_query($query);
				if (pg_affected_rows($result) > 0) {
					echo '<script>
					swal("Buen Trabajo!", "Se registro con éxito", "success");
					</script>';
				}
				else {
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
				}
			}
		}
	}	

	if(isset($_POST['editarDirectorio'])) {
		$codigo_directorio = $_POST['codigo_directorio'];
		$nombre_directorio = $_POST['nombre_directorio'];
		$telefono_directorio = $_POST['telefono_directorio'];
		$direccion_directorio = $_POST['direccion_directorio'];
		$correo_directorio = $_POST['correo_directorio'];
		$tipo_directorio = $_POST['tipo_directorio'];
		$sitioweb_directorio = $_POST['sitioweb_directorio'];
		

		if ($_FILES['image']['name'] != null) {
			$query = "SELECT codigo_directorio,img_directorio FROM directorio WHERE  codigo_directorio = '$codigo_directorio'";
			$run_query = pg_query($conn, $query);

			if (pg_num_rows($run_query) > 0) {
				while ($row = pg_fetch_array($run_query)) {
					$img_directorio = $row['img_directorio'];
				}
					//acá le damos la direccion exacta del archivo
				$path = '../directorio/'.$img_directorio.'';
				chown($path, 666);

				if (unlink($path)) {
					echo 'success';
				} else {
					echo 'fail';
				}
			}
			$image = $_FILES['image']['name'];
			$ext = $_FILES['image']['type'];
			$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
			if (empty($image)) {
				$picture = $image;
			}
			else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
			{
				echo "<script>swal('Tamaño de imagen incorrecto');
				window.location.href = 'directorio.php';</script>";

			}
			else if (!in_array($ext, $validExt)){
				echo "<script>swal('Imagen no válida');
				window.location.href = 'directorio.php';</script>";
				exit();
			}
			else {
				$folder  = '../directorio/';
				$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
				$picture = rand(1000 , 1000000) .'.'.$imgext;
				move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture);
			}
			//EDITAR MODIFICANDO LA IMAGEN
			$editarDir = "UPDATE directorio SET nombre_directorio = '$nombre_directorio',telefono_directorio='$telefono_directorio',direccion_directorio='$direccion_directorio', correo_directorio='$correo_directorio',tipo_directorio='$tipo_directorio',sitioweb_directorio='$sitioweb_directorio',img_directorio='$picture' WHERE codigo_directorio = '$codigo_directorio'";

			$resultado = pg_query($editarDir);
			if (pg_affected_rows($resultado) > 0 ) {
				echo '<script>
				swal("Buen Trabajo!", "Se edito con éxito", "success");
				</script>';

			}else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un errorRRR", "error");</script>';
			}
		}else{
			//EDITAR SIN MODIFICAR LA IMAGEN
			$editarDir = "UPDATE directorio SET nombre_directorio = '$nombre_directorio',telefono_directorio='$telefono_directorio',direccion_directorio='$direccion_directorio', correo_directorio='$correo_directorio',tipo_directorio='$tipo_directorio',sitioweb_directorio='$sitioweb_directorio' WHERE codigo_directorio = '$codigo_directorio'";

			$resultado = pg_query($editarDir);
			if (pg_affected_rows($resultado) > 0 ) {
				echo '<script>
				swal("Buen Trabajo!", "Se edito con éxito", "success");
				</script>';
			}

			else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error con la IMG", "error");</script>';
			}
		}
	} 

	if(isset($_POST['elimina_directorio'])) {
		$codigo_directorio_eliminar =$_POST['elimina_directorio'];
		$query = "SELECT codigo_directorio,img_directorio FROM directorio WHERE  codigo_directorio = '$codigo_directorio_eliminar'";
		$run_query = pg_query($conn, $query);

		if (pg_num_rows($run_query) > 0) {
			while ($row = pg_fetch_array($run_query)) {
				$img_directorio = $row['img_directorio'];
			}
					//acá le damos la direccion exacta del archivo
			$path = '../directorio/'.$img_directorio.'';
			chown($path, 666);

			if (unlink($path)) {
				//echo 'success';
			} else {
				//echo 'fail';
			}
		}
		$del_query = "DELETE FROM directorio WHERE codigo_directorio='$codigo_directorio_eliminar'";
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
					Añadir al  Directorio
				</button>
			</div>

			<!-- Modal Glosario -->
			<div class="modal fade" id="modalGlosario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir al Directorio</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post" enctype="multipart/form-data">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputEmail4">Entidad</label>
										<input type="text" class="form-control" name="nombre_directorio" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Dirección</label>
										<input type="text" class="form-control" name="direccion_directorio" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Telefono</label>
										<input type="number" class="form-control" name="telefono_directorio" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Sitio Web</label>
										<input type="text" class="form-control" name="sitioweb_directorio" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Correo</label>
										<input type="text" class="form-control" name="correo_directorio">
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Tipo</label>
										<select class="form-control" name="tipo_directorio"  type="text" required="">
											<option value="" selected="">Selecciona un Tipo</option>
											<!-- <option value="Directorio de Entidades Descentralizadas">Directorio de Entidades Descentralizadas</option> -->
											<option value="Directorio de Asociaciones y Agremiaciones">Directorio de Asociaciones y Agremiaciones</option>
											<option value="Directorio de Entidades ">Directorio de Entidades </option>
										</select>
									</div>
									<div class="form-group col-md-12 mb-3">
										<label for="inputEmail4">Imagen</label>
										<input class="form-control" type="file" name="image">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="idirectorio">
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
					<table id="tabla_glosario" class="table table-bordered table-striped table-hover ">
						<thead class="btn-info">
							<tr>
								<!-- <th>#</th> -->
								<th>Tipo</th>
								<th>Entidad</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Correo</th>
								<th>Sitio Web</th>
								<th>Img</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody>
							<!-- CONSULTA A LA BD -->
							<?php

							$query = "SELECT * FROM directorio ORDER BY codigo_directorio DESC";
							$run_query = pg_query($conn, $query);

							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_directorio = $row['codigo_directorio'];
									$nombre_directorio = $row['nombre_directorio'];
									$telefono_directorio = $row['telefono_directorio'];
									$direccion_directorio = $row['direccion_directorio'];
									$correo_directorio = $row['correo_directorio'];
									$tipo_directorio = $row['tipo_directorio'];
									$sitioweb_directorio = $row['sitioweb_directorio'];
									$img_directorio = $row['img_directorio'];
									echo "<tr>";
									//echo "<td>$codigo_directorio</td>";
									echo "<td>$tipo_directorio</td>";
									echo "<td>$nombre_directorio</td>";
									echo "<td>$telefono_directorio</td>";
									echo "<td>$direccion_directorio</td>";
									echo "<td>$correo_directorio</td>";
									echo "<td>$sitioweb_directorio</td>";
									echo "<td><img  width='100' src='../directorio/$img_directorio' alt='' ></td>";
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#verdirectorio' data-toggle='modal' data-codigo_directorio='".$codigo_directorio."' data-nombre_directorio='".$nombre_directorio."' data-telefono_directorio='".$telefono_directorio."' data-direccion_directorio='".$direccion_directorio."' data-correo_directorio='".$correo_directorio."' data-tipo_directorio='".$tipo_directorio."' data-sitioweb_directorio='".$sitioweb_directorio."' data-image='".$img_directorio."'><i class='fas fa-edit'></i>
									</a>
									</td>";
									echo '
									<form action="" class="aeliminar_directorio" method="POST" >
									<td>
									<input type="hidden" name="elimina_directorio" value="'.$codigo_directorio.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='9' >Actualmente no hay Directorios registrados. </td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php }?>
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR ROL-->
<div class="modal fade" id="verdirectorio" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Directorio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Entidad</label>
							<input type="text" class="form-control" name="nombre_directorio" id="nombre_directorio">
							<input type="text"  name="codigo_directorio" id="codigo_directorio">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Dirección</label>
							<input type="text" class="form-control" name="direccion_directorio" id="direccion_directorio">
						</div>
						<div class="form-group col-md-6">
							<label style="number" for="inputEmail4">Telefono</label>
							<input class="form-control" name="telefono_directorio" id="telefono_directorio">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Sitio Web</label>
							<input type="text" class="form-control" name="sitioweb_directorio" id="sitioweb_directorio" >
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Correo</label>
							<input type="text" class="form-control" name="correo_directorio" id="correo_directorio" >
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Tipo</label>
							<select class="form-control" name="tipo_directorio" id="tipo_directorio" >
								<option value="" selected="">Selecciona un Tipo</option>
								<!-- <option value="Directorio de Entidades Descentralizadas">Directorio de Entidades Descentralizadas</option> -->
								<option value="Directorio de Asociaciones y Agremiaciones">Directorio de Asociaciones y Agremiaciones</option>
								<option value="Directorio de Entidades">Directorio de Entidades </option>
							</select>
						</div>
						<div class="form-group col-md-12 mb-3">
							<label for="inputEmail4">Imagen</label>
							<input class="form-control" type="file" name="image" id="image">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarDirectorio">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 

<script>
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#verdirectorio').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_directorio = button.data('codigo_directorio'); // Extraer información de datos- * atributos
          var nombre_directorio = button.data('nombre_directorio'); 
          var telefono_directorio = button.data('telefono_directorio');
          var direccion_directorio = button.data('direccion_directorio'); 
          var correo_directorio = button.data('correo_directorio'); 
          var tipo_directorio = button.data('tipo_directorio');
          var sitioweb_directorio = button.data('sitioweb_directorio'); 
          
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_directorio').val(codigo_directorio);
          modal.find('.modal-body #nombre_directorio').val(nombre_directorio);
          modal.find('.modal-body #telefono_directorio').val(telefono_directorio);
          modal.find('.modal-body #direccion_directorio').val(direccion_directorio);
          modal.find('.modal-body #correo_directorio').val(correo_directorio);
          modal.find('.modal-body #tipo_directorio').val(tipo_directorio);
          modal.find('.modal-body #sitioweb_directorio').val(sitioweb_directorio);
          

      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_directorio').submit(function(e){
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

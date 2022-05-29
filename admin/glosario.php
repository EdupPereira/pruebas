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
	if (isset($_POST['iglosario'])) {
		$nombre_glosario = $_POST['nombre_glosario'];
		$descripcion_glosario = $_POST['descripcion_glosario'];

		$query = "INSERT INTO glosario(nombre_glosario, descripcion_glosario) VALUES ('$nombre_glosario','$descripcion_glosario')";
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

	if(isset($_POST['editarGlosario'])) {

		$codigo_glosario = $_POST['codigo_glosario'];
		$nombre_glosario = $_POST['nombre_glosario'];
		$descripcion_glosario = $_POST['descripcion_glosario'];
		
		$editarRol = "UPDATE glosario SET nombre_glosario = '$nombre_glosario',descripcion_glosario='$descripcion_glosario' WHERE codigo_glosario = '$codigo_glosario'";

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

	if(isset($_POST['elimina_glosario'])) {
		$codigo_glosario_eliminar =$_POST['elimina_glosario'];
		$del_query = "DELETE FROM glosario WHERE codigo_glosario='$codigo_glosario_eliminar'";
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
					Añadir al  Glosario
				</button>
			</div>
			
			<!-- Modal Glosario -->
			<div class="modal fade" id="modalGlosario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir al Glosario</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post" >
								<input type="text"  name="nombre_glosario" class="form-control" placeholder="Nombre Glosario" >
								<!-- <textarea name="descripcion_glosario" cols="30" rows="10"  ></textarea> -->
								<input type="text" name="descripcion_glosario" class="form-control" placeholder="Descripcion">
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="iglosario">
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
								<th>Código Glosario</th>
								<th>Palabra</th>
								<th>Definición</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody>
							<!-- CONSULTA A LA BD -->
							<?php

							$query = "SELECT codigo_glosario,nombre_glosario,descripcion_glosario FROM glosario ORDER BY codigo_glosario DESC";
							$run_query = pg_query($conn, $query);

							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_glosario = $row['codigo_glosario'];
									$nombre_glosario = $row['nombre_glosario'];
									$descripcion_glosario = $row['descripcion_glosario'];
									echo "<tr>";
									echo "<td>$codigo_glosario</td>";
									echo "<td>$nombre_glosario</td>";
									echo "<td>$descripcion_glosario</td>";
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editGlosario' data-toggle='modal' data-codigo_glosario='".$codigo_glosario."' data-nombre_glosario='".$nombre_glosario."' data-descripcion_glosario='".$descripcion_glosario."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="aeliminar_glosario" method="POST" >
									<td>
									<input type="hidden" name="elimina_glosario" value="'.$codigo_glosario.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='5' >Actualmente no hay Palabras registradas. </td></tr>";
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
<div class="modal fade" id="editGlosario" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
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
					<div class="form-group col-md-6">
						<label class="col-form-label">Nombre Glosario:</label>
						<input type="text" required="required" id="nombre_glosario" class="form-control" name="nombre_glosario" placeholder="Nombre Glosario" >
					</div>
					<div class="form-group col-md-6">
						<label class="col-form-label">Descripcion Glosario:</label>
						<input type="text" required="required" id="descripcion_glosario" class="form-control" name="descripcion_glosario" placeholder="Descripcion Glosario" >
					</div>
					<div class=" col-md-6">
						<input type="hidden" required="required" id="codigo_glosario" class="form-control" name="codigo_glosario" >
					</div>
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
$('#editGlosario').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_glosario = button.data('codigo_glosario'); // Extraer información de datos- * atributos
          var nombre_glosario = button.data('nombre_glosario');
          var descripcion_glosario = button.data('descripcion_glosario');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_glosario').val(codigo_glosario);
          modal.find('.modal-body #nombre_glosario').val(nombre_glosario);
          modal.find('.modal-body #descripcion_glosario').val(descripcion_glosario);


      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_glosario').submit(function(e){
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

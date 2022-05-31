<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');

if (isset($_POST['isolicitud'])) {
	$nombre_solicitud = $_POST['nombre_solicitud'];

	$query = "INSERT INTO tipo_solicitud(nombre_solicitud) VALUES ('$nombre_solicitud')";
	$result = pg_query($query);
	if (pg_affected_rows($result) > 0) {
		echo '<script>
		swal("Buen Trabajo!", "El Tipo de Solicitud se registro con éxito", "success");
		</script>';
	}
	else {
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al registrar el Tipo de Solicitud", "error");</script>';
	}
}

if(isset($_POST['editarSolicitud'])) {

	$codigo_solicitud = $_POST['codigo_solicitud'];
	$nombre_solicitud = $_POST['nombre_solicitud'];
	
	$editarSolicitud1 = "UPDATE tipo_solicitud SET nombre_solicitud = '$nombre_solicitud' WHERE codigo_solicitud = '$codigo_solicitud'";

	$resultado = pg_query($editarSolicitud1);
	if (pg_affected_rows($resultado) > 0 ) {
		echo '
		<script>
		swal("Buen Trabajo!", "El Tipo de Solicitud se edito con éxito", "success");
		</script>';
	}

	else {
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al editar el Tipo de Solicitud", "error");</script>';
	}
} 

if(isset($_POST['elimina_solicitud'])) {
	$codigo_solicitud =$_POST['elimina_solicitud'];
	$del_query = "DELETE FROM tipo_solicitud WHERE codigo_solicitud='$codigo_solicitud'";
	$run_del_query = pg_query($del_query);
	if (pg_affected_rows($run_del_query) > 0) {
		echo '<script>
		swal("Buen Trabajo!", "El Tipo de Solicitud se Elimino con éxito", "success");
		</script>';
	}
	else {
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al eliminar el Tipo de Solicitud", "error");</script>';  
	}
} 

?>
<!-- Content Row -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-chart-bar" ></i>
			Agregar Nuevo Tipo de Solicitud</div>
			<div class="card-body">
				<center>
					<form id="insertar_solicitud" action="" method="POST" class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
						<div class="input-group">
							<input type="text" required="required" name="nombre_solicitud" class="form-control" placeholder="Nombre Tipo de Persona">
							<div class="input-group-append">
								<button type="submit" name="isolicitud" class="btn btn-primary">
									<i class="fas fa-plus"></i>
								</button> 
							</div>
						</div>
					</form>
				</center>
			</div>
		</div>
		<div class="col-md-4"></div>

	</div>
	<?php if($_SESSION['role'] == 'superadmin')  
	{ ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tabla_persona" class="table table-bordered table-striped table-hover">
						<thead class="btn-info">
							<tr>
								<th>Codigo Tipo de Solicitud</th>
								<th>Nombre Tipo de Solicitud</th>
								<th>Editar</th>
								<th>Borrar</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$query = "SELECT * FROM tipo_solicitud ORDER BY codigo_solicitud DESC";
							$run_query = pg_query($conn, $query);
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_solicitud = $row['codigo_solicitud'];
									$nombre_solicitud = $row['nombre_solicitud'];
									
									echo "<tr>";
									echo "<td>$codigo_solicitud</td>";
									echo "<td>$nombre_solicitud</td>";
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editarSolicitud' data-toggle='modal' data-codigo_solicitud='".$codigo_solicitud."' data-nombre_solicitud='".$nombre_solicitud."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="delsolicitud"  method="POST" >
									<td>
									<input type="hidden" name="elimina_solicitud" value="'.$codigo_solicitud.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='4' >Actualmente no hay Tipos de Solicitudes registradas. </td></tr>";
							}
							?>

						</tbody>
					</table>
				</div>
			</div>
		<?php }?>
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR Estado-->
<div class="modal fade" id="editarSolicitud" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Solicitud</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" >
					<div class="form-group col-md-6">
						<label class="col-form-label">Nombre Solicitud:</label>
						<input type="text" required="required" id="nombre_solicitud" class="form-control" name="nombre_solicitud" placeholder="Nombre Estado" >
					</div>
					<div class=" col-md-6">
						<input type="hidden" required="required" id="codigo_solicitud" class="form-control" name="codigo_solicitud" >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarSolicitud">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 
<script>
	//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
	$('.delsolicitud').submit(function(e){
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
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#editarSolicitud').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_solicitud = button.data('codigo_solicitud'); // Extraer información de datos- * atributos
          var nombre_solicitud = button.data('nombre_solicitud');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_solicitud').val(codigo_solicitud);
          modal.find('.modal-body #nombre_solicitud').val(nombre_solicitud);
      });

  </script>

  <?php include ('includes/adminfooter.php');?>

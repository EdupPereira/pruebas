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
	if (isset($_POST['irol'])) {
		$nombre_rol = $_POST['nombre_rol'];

		$query = "INSERT INTO roles(nombre_rol) VALUES ('$nombre_rol')";
		$result = pg_query($query);
		if (pg_affected_rows($result) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "El rol se registro con éxito", "success");
			</script>';
		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
		}
	}

	if(isset($_POST['editaarRol'])) {

		$codigo_rol_editar = $_POST['codigo_rol'];
		$nombre_rol_editar = $_POST['nombre_rol'];
		
		$editarRol = "UPDATE roles SET nombre_rol = '$nombre_rol_editar' WHERE codigo_rol = '$codigo_rol_editar'";

		$resultado = pg_query($editarRol);
		if (pg_affected_rows($resultado) > 0 ) {
			echo '<script>
			swal("Buen Trabajo!", "El rol se edito con éxito", "success");
			</script>';
		}

		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error", "error");</script>';
		}


	} 

	if(isset($_POST['elimina_rol'])) {
		$codigo_rol_eliminar =$_POST['elimina_rol'];
		$del_query = "DELETE FROM roles WHERE codigo_rol='$codigo_rol_eliminar'";
		$run_del_query = pg_query($del_query);
		if (pg_affected_rows($run_del_query) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "El rol se Elimino con éxito", "success");
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
				<i class="fas fa-chart-bar" ></i>
			Agregar Nuevo Rol</div>
			<div class="card-body">
				<center>
					<form action="" method="POST" class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
						<div class="input-group">
							<input type="text" required="required" name="nombre_rol" class="form-control" placeholder="Nombre">
							<div class="input-group-append">
								<button type="submit" name="irol" class="btn btn-primary">
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
<!-- 	SOLO EL ROL SUPERADMINISTRADOR PUEDE ACCEDER A ESTA SESION -->
	<?php if($_SESSION['role'] == 'superadmin')  
	{ ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tabla_rol" class="table table-bordered table-striped table-hover ">
						<thead class="btn-info">
							<tr>
								<th>Codigo Rol</th>
								<th>Nombre Rol</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody>
							<!-- CONSULTA A LA BD -->
							<?php

							$query = "SELECT codigo_rol,nombre_rol FROM roles ORDER BY codigo_rol ASC";
							$run_query = pg_query($conn, $query);
							
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_rol = $row['codigo_rol'];
									$nombre_rol = $row['nombre_rol'];
									echo "<tr>";
									echo "<td>$codigo_rol</td>";
									echo "<td>$nombre_rol</td>";
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editRol' data-toggle='modal' data-codigo_rol='".$codigo_rol."' data-nombre_rol='".$nombre_rol."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="aeliminar_rol" method="POST" >
									<td>
									<input type="hidden" name="elimina_rol" value="'.$codigo_rol.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>
									
									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='4' >Actualmente no hay Roles registrados. </td></tr>";
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
<div class="modal fade" id="editRol" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Rol</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" >
					<div class="form-group col-md-6">
						<label class="col-form-label">Nombre Rol:</label>
						<input type="text" required="required" id="nombre_rol" class="form-control" name="nombre_rol" placeholder="Nombre Rol" >
					</div>
					<div class=" col-md-6">
						<input type="hidden" required="required" id="codigo_rol" class="form-control" name="codigo_rol" >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editaarRol">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 
<script>
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#editRol').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_rol = button.data('codigo_rol'); // Extraer información de datos- * atributos
          var nombre_rol = button.data('nombre_rol');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_rol').val(codigo_rol);
          modal.find('.modal-body #nombre_rol').val(nombre_rol);


      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_rol').submit(function(e){
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

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
	if (isset($_POST['iarea'])) {
		$nombre_area = $_POST['nombre_area'];

		$query = "INSERT INTO area(nombre_area) VALUES ('$nombre_area')";
		$result = pg_query($query);
		if (pg_affected_rows($result) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "El area se registro con éxito", "success");
			</script>';
		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al registrar el area", "error");</script>';
		}
	}

	if(isset($_POST['editarArea'])) {

		$codigo_area_editar = $_POST['codigo_area'];
		$nombre_area_editar = $_POST['nombre_area'];
		
		$editarRol = "UPDATE area SET nombre_area = '$nombre_area_editar' WHERE codigo_area = '$codigo_area_editar'";

		$resultado = pg_query($editarRol);
		if (pg_affected_rows($resultado) > 0 ) {
			echo '
			<script>
			swal("Buen Trabajo!", "El area se edito con éxito", "success");
			</script>';
		}

		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al editar el area", "error");</script>';
		}
	} 

	if(isset($_POST['elimina_area'])) {
		$codigo_area_eliminar =$_POST['elimina_area'];
		$del_query = "DELETE FROM area WHERE codigo_area='$codigo_area_eliminar'";
		$run_del_query = pg_query($del_query);
		if (pg_affected_rows($run_del_query) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "El area se Elimino con éxito", "success");
			</script>';
		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al eliminar el area", "error");</script>';  
		}
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
			Agregar Nueva Area</div>
			<div class="card-body">
				<center>
					<form id="insertar_area" action="" method="POST" class=" d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
						<div class="input-group">
							<input type="text" required="required" name="nombre_area" class="form-control" placeholder="Nombre">
							<div class="input-group-append">
								<button type="submit" name="iarea" class="btn btn-primary">
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
					<table id="tabla_area" class="table table-bordered table-striped table-hover">
						<thead class="btn-info">
							<tr>
								<th>Codigo Area</th>
								<th>Nombre Area</th>
								<th>Editar</th>
								<th>Borrar</th>

							</tr>
						</thead>
						<tbody>

							<?php

							$query = "SELECT * FROM area ORDER BY codigo_area DESC";
							$run_query = pg_query($conn, $query);
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_area = $row['codigo_area'];
									$nombre_area = $row['nombre_area'];


									echo "<tr>";
									echo "<td>$codigo_area</td>";
									echo "<td>$nombre_area</td>";


									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editArea' data-toggle='modal' data-codigo_area='".$codigo_area."' data-nombre_area='".$nombre_area."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="delarea"  method="POST" >
									<td>
									<input type="hidden" name="elimina_area" value="'.$codigo_area.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='4' >Actualmente no hay Areas registradas. </td></tr>";
							}
							?>

						</tbody>
					</table>
				</div>
			</div>
		<?php }?>
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR AREA-->
<div class="modal fade" id="editArea" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Area</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" >
					<div class="form-group col-md-6">
						<label class="col-form-label">Nombre Area:</label>
						<input type="text" required="required" id="nombre_area" class="form-control" name="nombre_area" placeholder="Nombre Area" >
					</div>
					<div class=" col-md-6">
						<input type="hidden" required="required" id="codigo_area" class="form-control" name="codigo_area" >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarArea">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 
<script>
	//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
	$('.delarea').submit(function(e){
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
$('#editArea').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_area = button.data('codigo_area'); // Extraer información de datos- * atributos
          var nombre_area = button.data('nombre_area');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_area').val(codigo_area);
          modal.find('.modal-body #nombre_area').val(nombre_area);
      });

  </script>

  <?php include ('includes/adminfooter.php');?>

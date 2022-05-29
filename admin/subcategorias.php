<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');

if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user') {
	echo "<script> alert('Solo los Administradores pueden agregar Categorías');
	window.location.href='./index.php'; </script>";
}
else {
	if (isset($_POST['icategoria'])) {
		$indice_subcat=$_POST['indice_subcat'];
		$descripcion_subcat=$_POST['descripcion_subcat'];
		$codigo_categoriat_fk=$_POST['codigo_categoriat_fk'];


		$query = "INSERT INTO subcategoria_transparencia(indice_subcat,descripcion_subcat,codigo_categoriat_fk) VALUES ('$indice_subcat','$descripcion_subcat','$codigo_categoriat_fk')";
		$result = pg_query($query);
		if (pg_affected_rows($result) > 0) {
			echo '<script>
			swal("Buen Trabajo!", " La Subcategoria se registro con éxito", "success");
			</script>';
		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al registrar la Subcategoría", "error");</script>';
		}
	}

	if(isset($_POST['editarSubcat'])) {

		$codigo_subcat = $_POST['codigo_subcat'];
		$indice_subcat=$_POST['indice_subcat'];
		$descripcion_subcat=$_POST['descripcion_subcat'];
		$codigo_categoriat_fk=$_POST['codigo_categoriat_fk'];
		
		$editarRol = "UPDATE subcategoria_transparencia SET indice_subcat = '$indice_subcat',descripcion_subcat = '$descripcion_subcat',codigo_categoriat_fk = '$codigo_categoriat_fk' WHERE codigo_subcat = '$codigo_subcat'";

		$resultado = pg_query($editarRol);
		if (pg_affected_rows($resultado) > 0 ) {
			echo '
			<script>
			swal("Buen Trabajo!", "La Subcategoria se edito con éxito", "success");
			</script>';
		}

		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al editar la Subcategoria", "error");</script>';
		}
	} 

	if(isset($_POST['elimina_scat'])) {
		$codigo_cat =$_POST['elimina_cat'];
		$del_query = "DELETE FROM categoria_transparencia WHERE codigo_categoriat='$codigo_cat'";
		$run_del_query = pg_query($del_query);
		if (pg_affected_rows($run_del_query) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "La categoría se Elimino con éxito", "success");
			</script>';
		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al eliminar la categoría", "error");</script>';  
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
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGlosario">
					Añadir Subcategoría
				</button>
			</div>
			
			<!-- Modal Glosario -->
			<div class="modal fade" id="modalGlosario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir Subcategoría</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post" class="form-inline" >
								
								<input type="text" name="indice_subcat" class="form-control col-md-6" placeholder="Indice : 2.1 etc">
								<input type="text"  name="descripcion_subcat" class="form-control col-md-6" placeholder="Nombre Subcategoría" >
								<select class="form-control input-sm codigo_categoriat_fk" name="codigo_categoriat_fk">
									<?php
									$query = "SELECT * FROM categoria_transparencia ORDER BY codigo_categoriat ASC";
									$run_query = pg_query($conn, $query);
									if (pg_num_rows($run_query) > 0) {
										while ($row = pg_fetch_array($run_query)) {
											$codigo_categoriat = $row['codigo_categoriat'];
											$descripcion_categoriat = $row['descripcion_categoriat'];


											?>

											<option value="<?php echo $codigo_categoriat?>" name="codigo_categoriat_fk" class="codigo_categoriat_fk"><?php echo $codigo_categoriat." - ".$descripcion_categoriat?></option>
											<?php
										}
									}
									?>
								</select>
								<br>



								<div class="modal-footer col-lg-12 col-xs-12 col-md-12 col-sm-12">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="icategoria">
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
	<?php if($_SESSION['role'] == 'superadmin')  
	{ ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tabla_area" class="table table-bordered table-striped table-hover">
						<thead class="btn-info">
							<tr>
								<th>#</th>
								<th>Indice</th>
								<th>Descripción</th>
								<th>Categoria</th>
								<th>Editar</th>
								<th>Borrar</th>

							</tr>
						</thead>
						<tbody>

							<?php

							$query = "SELECT * FROM subcategoria_transparencia ORDER BY indice_subcat DESC";
							$run_query = pg_query($conn, $query);
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_subcat = $row['codigo_subcat'];
									$indice_subcat = $row['indice_subcat'];
									$descripcion_subcat = $row['descripcion_subcat'];
									$codigo_categoriat_fk = $row['codigo_categoriat_fk'];
									echo "<tr>";
									echo "<td>$codigo_subcat</td>";
									echo "<td>$indice_subcat</td>";
									echo "<td>$descripcion_subcat</td>";
									echo "<td>$codigo_categoriat_fk</td>";
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editSucat' data-toggle='modal' data-codigo_subcat='".$codigo_subcat."' data-indice_subcat='".$indice_subcat."' data-descripcion_subcat='".$descripcion_subcat."' data-codigo_categoriat_fk='".$codigo_categoriat_fk."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="delcat"  method="POST" >
									<td>
									<input type="hidden" name="elimina_scat" value="'.$codigo_subcat.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='9' >Actualmente no hay Subcategorías registradas. </td></tr>";
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
<div class="modal fade" id="editSucat" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Categoria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" class="form-inline">
					<input type="hidden" name="codigo_subcat" class="form-control col-md-6" id="codigo_subcat" placeholder="">
					<input type="text" name="indice_subcat" class="form-control col-md-6" id="indice_subcat" placeholder="Indice : 2.1 etc">
					<input type="text"  name="descripcion_subcat" class="form-control col-md-6" id="descripcion_subcat" placeholder="Nombre Subcategoría" >
					<center>
						<label for="" >Categoria Seleccionada Actualmente</label>
						<input type="text" id="codigo_categoriat_fk" readonly class="form-control">
					</center>
					<select class="form-control input-sm codigo_categoriat_fk" name="codigo_categoriat_fk" >
						<?php
						$query = "SELECT * FROM categoria_transparencia ORDER BY codigo_categoriat ASC";
						$run_query = pg_query($conn, $query);
						if (pg_num_rows($run_query) > 0) {
							while ($row = pg_fetch_array($run_query)) {
								$codigo_categoriat = $row['codigo_categoriat'];
								$descripcion_categoriat = $row['descripcion_categoriat'];


								?>

								<option value="<?php echo $codigo_categoriat?>" name="codigo_categoriat_fk"  select><?php echo $codigo_categoriat." - ".$descripcion_categoriat?></option>
								<?php
							}
						}
						?>
					</select>
					<br>
					<br>
					<div class="modal-footer col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarSubcat">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 
<script>
	//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
	$('.delcat').submit(function(e){
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
$('#editSucat').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_subcat = button.data('codigo_subcat'); // Extraer información de datos- * atributos
          var indice_subcat = button.data('indice_subcat');
          var descripcion_subcat = button.data('descripcion_subcat');
          var codigo_categoriat_fk = button.data('codigo_categoriat_fk');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_subcat').val(codigo_subcat);
          modal.find('.modal-body #indice_subcat').val(indice_subcat);
          modal.find('.modal-body #descripcion_subcat').val(descripcion_subcat);
          modal.find('.modal-body #codigo_categoriat_fk').val(codigo_categoriat_fk);
      });

  </script>

  <?php include ('includes/adminfooter.php');?>

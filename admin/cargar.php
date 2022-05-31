<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');


include ('php/insertar_archivos.php');
include ('php/editar_archivo.php');

if(isset($_POST['elimina_archivo'])) {
	$elimina_archivo =$_POST['elimina_archivo'];
	$del_query = "DELETE FROM archivos WHERE cod_archivo='$elimina_archivo'";
	$run_del_query = pg_query($del_query);
	if (pg_affected_rows($run_del_query) > 0) {
		echo '<script>
		swal("Buen Trabajo!", "El Archivo se Elimino con éxito", "success");
		</script>';
	}
	else {
		echo "<script>swal('Ocurrió un error. Intente nuevamente!');</script>";   
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
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalestados">
					Añadir Archivos
				</button>
			</div>

			<!-- Modal Estados Financieros -->
			<div class="modal fade" id="modalestados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir Archivos</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post" enctype="multipart/form-data">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputEmail4">Nombre</label>
										<input type="text" class="form-control" name="nombre_archivo" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Descripcion</label>
										<input type="text" class="form-control" name="descripcion_archivo" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Fecha</label>
										<input type="date" class="form-control" name="fecha_archivo" >
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4">Subcategoria</label>
										<select class="form-control input-sm codigo_subcat_fk" name="codigo_subcat_fk">
											<?php
											$query = "SELECT * FROM subcategoria_transparencia ORDER BY codigo_subcat ASC";
											$run_query = pg_query($conn, $query);
											if (pg_num_rows($run_query) > 0) {
												while ($row = pg_fetch_array($run_query)) {
													$codigo_subcat = $row['codigo_subcat'];
													$descripcion_subcat = $row['descripcion_subcat'];


													?>

													<option value="<?php echo $codigo_subcat?>" name="codigo_categoriat_fk" class="codigo_categoriat_fk"><?php echo $codigo_subcat." - ".$descripcion_subcat?></option>
													<?php
												}
											}
											?>
										</select>
									</div>

									<div class="form-group col-md-12 ">
										<label for="inputEmail4">Archivo</label>
										<input class="form-control" type="file" name="archivo">
									</div>
									<div class="form-group col-md-12 mb-3">
										<label for="inputEmail4">Link de Youtube o Sitio Web</label>
										<input class="form-control" type="text" name="link_archivo" placeholder="Pegar el link ">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="iestado">
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
	
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tabla_estado" class="table table-bordered table-striped table-hover">
						<thead class="btn-info">
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>Fecha</th>
								<th>Año</th>
								<th>Archivo</th>
								<th>Subcategoria</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>

							<?php
							
							$query = "SELECT a.cod_archivo,a.nombre_archivo,a.descripcion_archivo,a.archivo,a.anio,a.codigo_subcat_fk,a.fecha_archivo,a.link_archivo,s.descripcion_subcat,s.codigo_subcat,s.codigo_categoriat_fk,s.indice_subcat
							FROM archivos a
							INNER JOIN subcategoria_transparencia s
							ON a.codigo_subcat_fk = s.codigo_subcat

							ORDER BY a.cod_archivo DESC  ";
							$run_query = pg_query($conn, $query);
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$cod_archivo = $row['cod_archivo'];
									$nombre_archivo = $row['nombre_archivo'];
									$descripcion_archivo = $row['descripcion_archivo'];
									$archivo = $row['archivo'];
									$fecha_archivo = $row['fecha_archivo'];
									$anio = $row['anio'];
									$descripcion_subcat=$row['descripcion_subcat'];
									$indice_subcat=$row['indice_subcat'];
									$codigo_subcat_fk=$row['codigo_subcat_fk'];
									$link_archivo=$row['link_archivo'];
									echo "<tr>";
									echo "<td>$cod_archivo</td>";
									echo "<td>$nombre_archivo</td>";
									echo "<td>$descripcion_archivo</td>";
									echo "<td>$fecha_archivo</td>";
									echo "<td>$anio</td>";
									echo "<td><p><a href='../transparencia/$archivo' target='_blank'><button class='btn btn-danger' title='$archivo'>PDF</button></a></p>";
									if ($link_archivo!= null) {
										echo "<hr><p><a href='$link_archivo' target='_blank'><button class='btn btn-info' title='$link_archivo'>Link</button></a>";
									}
									echo "
									</td>";
									echo "<td>$descripcion_subcat</td>";
									echo "<td class='text-center'>
									<a class='btn  btn-warning text-center' href='#finan' data-toggle='modal'  data-cod_archivo='".$cod_archivo."' data-nombre_archivo='".$nombre_archivo."' data-descripcion_archivo='".$descripcion_archivo."' data-fecha_archivo='".$fecha_archivo."' data-indice_subcat='".$indice_subcat."' data-link_archivo='".$link_archivo."' >
									<i class='fas fa-edit'></i></a>
									</td>";

									echo '
									<form action="" class="aeliminar_archivo" method="POST" >
									<td>
									<input type="hidden" name="elimina_archivo" value="'.$cod_archivo.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>
									
									</form>
									';

									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='8' >Actualmente no hay nada registrado. </td></tr>";
							}
							?>

						</tbody>
					</table>
				</div>
			</div>
	
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR Estado-->
<div class="modal fade" id="finan" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Archivo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="post" enctype="multipart/form-data" >
					<div class="form-row">
						<input type="hidden" class="form-control" name="cod_archivo" id="cod_archivo" readonly>
						<input type="text" class="form-control" name="indice_subcat" id="indice_subcat" readonly>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nombre</label>
							<input type="text" class="form-control" name="nombre_archivo" id="nombre_archivo" >
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Descripción</label>
							<input type="text" class="form-control" name="descripcion_archivo" id="descripcion_archivo">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Fecha</label>
							<input type="date" class="form-control" name="fecha_archivo" id="fecha_archivo">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Subcategoria</label>
							<select class="form-control input-sm " name="codigo_subcat_fk">
								<option disabled="disabled" >Elige una opción</option>
								<?php
								$query = "SELECT * FROM subcategoria_transparencia  ORDER BY codigo_subcat ASC";
								$run_query = pg_query($conn, $query);
								if (pg_num_rows($run_query) > 0) {
									while ($row = pg_fetch_array($run_query)) {
										$codigo_subcat = $row['codigo_subcat'];
										$descripcion_subcat = $row['descripcion_subcat'];
										$indice = $row['indice_subcat'];

										?>

										<option value="<?php echo $codigo_subcat ?>"><?php echo $indice." - ".$descripcion_subcat?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Archivo</label>
							<input class="form-control" type="file" name="archivo" id="archivo">
						</div>
						<div class="form-group col-md-12 mb-3">
							<label for="inputEmail4">Link de Youtube o Sitio Web</label>
							<input class="form-control" type="text" id="link_archivo" name="link_archivo" placeholder="Pegar el link ">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editar_archivo">Editar</button>
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>

<script>

//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#finan').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var cod_archivo = button.data('cod_archivo'); // Extraer información de datos- * atributos
          var nombre_archivo = button.data('nombre_archivo');
          var descripcion_archivo = button.data('descripcion_archivo');
          var fecha_archivo = button.data('fecha_archivo');
          var indice_subcat = button.data('indice_subcat');
          var link_archivo = button.data('link_archivo');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #cod_archivo').val(cod_archivo);
          modal.find('.modal-body #nombre_archivo').val(nombre_archivo);
          modal.find('.modal-body #descripcion_archivo').val(descripcion_archivo);
          modal.find('.modal-body #fecha_archivo').val(fecha_archivo);
          modal.find('.modal-body #indice_subcat').val(indice_subcat);
          modal.find('.modal-body #link_archivo').val(link_archivo);
      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_archivo').submit(function(e){
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
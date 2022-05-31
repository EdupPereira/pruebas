<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');


	if (isset($_POST['ipr'])) {
		$pregunta = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];

		$query = "INSERT INTO preguntas_respuestas(pregunta, respuesta) VALUES ('$pregunta','$respuesta')";
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

	if(isset($_POST['editarPr'])) {

		$codigo_pr = $_POST['codigo_pr'];
		$pregunta = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];
		
		$editarPre = "UPDATE preguntas_respuestas SET pregunta = '$pregunta',respuesta='$respuesta' WHERE codigo_pr = '$codigo_pr'";

		$resultado = pg_query($editarPre);
		if (pg_affected_rows($resultado) > 0 ) {
			echo '<script>
			swal("Buen Trabajo!", "Se edito con éxito", "success");
			</script>';
		}

		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error", "error");</script>';
		}


	} 

	if(isset($_POST['elimina_pr'])) {
		$codigo_pr =$_POST['elimina_pr'];
		$del_pr = "DELETE FROM preguntas_respuestas WHERE codigo_pr='$codigo_pr'";
		$run_del_query = pg_query($del_pr);
		if (pg_affected_rows($run_del_query) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "Se Elimino con éxito", "success");
			</script>';
		}
		else {
			echo "<script>swal('Ocurrió un error. Intente nuevamente!');</script>";   
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
					Añadir Pregunta & Respuesta
				</button>
			</div>
			
			<!-- Modal Glosario -->
			<div class="modal fade" id="modalGlosario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir Pregunta & Respuesta</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post" >
								<input type="text"  name="pregunta" class="form-control" placeholder="Pregunta" >
								 <textarea name="respuesta" cols="30" rows="10"  ></textarea>
								
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="ipr">
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
					<table id="tabla_glosario" class="table table-bordered table-striped  ">
						<thead class="btn-info">
							<tr>
								<th>#</th>
								<th>Pregunta</th>
								<th>Respuesta</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody>
							<!-- CONSULTA A LA BD -->
							<?php

							$query = "SELECT codigo_pr,pregunta,respuesta FROM preguntas_respuestas ORDER BY codigo_pr DESC";
							$run_query = pg_query($conn, $query);

							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_pr = $row['codigo_pr'];
									$pregunta = $row['pregunta'];
									$respuesta = $row['respuesta'];
									echo "<tr>";
									echo "<td>$codigo_pr</td>";
									echo "<td>$pregunta</td>";
									echo "<td>$respuesta</td>";
									echo "<td>
									<a class='btn btn-sm btn-warning' href='#editPr' data-toggle='modal' data-codigo_pr='".$codigo_pr."' data-pregunta='".$pregunta."' data-respuesta='".$respuesta."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="aeliminar_pr" method="POST" >
									<td>
									<input type="hidden" name="elimina_pr" value="'.$codigo_pr.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='5' >Actualmente no hay Preguntas & Respuestas registradas. </td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR ROL-->
<div class="modal fade" id="editPr" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Preguntas & Respuestas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST" >
					<div class="form-group col-md-12">
						<label class="col-form-label">Pregunta</label>
						<input type="text" required="required" id="pregunta" class="form-control" name="pregunta" placeholder="Pregunta" >
					</div>
					<div class="form-group col-md-12">
						<label class="col-form-label">Respuesta</label>
						<textarea  id="respuesta"  name="respuesta" placeholder="Respuesta" ></textarea>
					</div>
					<div class=" col-md-6">
						<input type="hidden" required="required" id="codigo_pr" class="form-control" name="codigo_pr" >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarPr">Editar</button>
					</div>
				</form>
			</div>

		</div> 
	</div>
</div> 
<script>
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#editPr').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_pr = button.data('codigo_pr'); // Extraer información de datos- * atributos
          var pregunta = button.data('pregunta');
          var respuesta = button.data('respuesta');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #codigo_pr').val(codigo_pr);
          modal.find('.modal-body #pregunta').val(pregunta);
          modal.find('.modal-body #respuesta').val(respuesta);


      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_pr').submit(function(e){
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

<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');


if (isset($_POST['icategoria'])) {
	$codigo_categoriat=$_POST['codigo_categoriat'];
	$descripcion_categoriat=$_POST['descripcion_categoriat'];


	$query = "INSERT INTO categoria_transparencia(codigo_categoriat,descripcion_categoriat) VALUES ('$codigo_categoriat','$descripcion_categoriat')";
	$result = pg_query($query);
	if (pg_affected_rows($result) > 0) {
		echo '<script>
		swal("Buen Trabajo!", " La categoria se registro con éxito", "success");
		</script>';
	}
	else {
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al registrar la categoría", "error");</script>';
	}
}

if(isset($_POST['editarCat'])) {
$codigo_inicial = $_POST['codigo_categoriat_inicial'];
	$codigo_cat_editar = $_POST['codigo_categoriat'];
	$descripcion_editar = $_POST['descripcion_categoriat'];

	$editarCat = "UPDATE categoria_transparencia SET codigo_categoriat = '{$codigo_cat_editar}',descripcion_categoriat='{$descripcion_editar}' WHERE codigo_categoriat = '{$codigo_inicial}'";

	$resultado = pg_query($editarCat);
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

if(isset($_POST['elimina_cat'])) {
	$codigo_cat =$_POST['elimina_cat'];
	$del_query = "DELETE FROM categoria_transparencia WHERE codigo_categoriat='$codigo_cat'";
	$run_del_query = pg_query($del_query);
	if (pg_affected_rows($run_del_query) > 0) {
		echo '<script>
		swal("Buen Trabajo!", "La categoría se Elimino con éxito", "success");
		</script>';
	}
	else {
		echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al eliminar la categoría porque esta ligada a alguna subcategoria  ¿Que puede hacer? debe eliminar primero las subcategorias asociadas o no se podra eliminar", "error").then(function() {
			window.location.replace("categorias.php");}); </script>';    
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
						Añadir Categoría
					</button>
				</div>

				<!-- Modal Glosario -->
				<div class="modal fade" id="modalGlosario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Añadir Categoría</h5>
							</div>
							<div class="modal-body">
								<form  action="" method="post" class="form-inline" >

									<input type="text"  name="codigo_categoriat" class="form-control col-md-12" placeholder="Codigo Categoría" >
									<input type="text"  name="descripcion_categoriat" class="form-control col-md-12" placeholder="Nombre Categoría" >


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

		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tabla_area" class="table table-bordered table-striped table-hover">
						<thead class="btn-info">
							<tr>
								<th>Código Categoria</th>
								<th>Descripción</th>
								<th>Editar</th>
								<th>Borrar</th>

							</tr>
						</thead>
						<tbody>

							<?php

							$query = "SELECT * FROM categoria_transparencia ORDER BY codigo_categoriat DESC";
							$run_query = pg_query($conn, $query);
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$codigo_categoriat = $row['codigo_categoriat'];
									$descripcion_categoriat = $row['descripcion_categoriat'];



									echo "<tr>";
									echo "<td>$codigo_categoriat</td>";
									echo "<td>$descripcion_categoriat</td>";
									echo "<td>
									<a class='btn  btn-warning' href='#editCat' data-toggle='modal' data-codigo_categoriat='".$codigo_categoriat."' data-descripcion_categoriat='".$descripcion_categoriat."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="delcat"  method="POST" >
									<td>
									<input type="hidden" name="elimina_cat" value="'.$codigo_categoriat.'">
									<button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" name=""></i></button>
									</td>

									</form>
									';
									echo "</tr>";
								}
							}
							else {
								echo "<tr><td class='text-center' colspan='9' >Actualmente no hay Categorías registradas. </td></tr>";
							}
							?>

						</tbody>
					</table>
				</div>
			</div>

		</div> 
	</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
	<!-- MODAL PARA EDITAR AREA-->
	<div class="modal fade" id="editCat" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
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
						<input type="hidden"  name="codigo_categoriat_inicial" id="codigo_categoriat_inicial" class="form-control col-md-12" placeholder="Codigo Categoría" >
						<input type="text"  name="codigo_categoriat" id="codigo_categoriat" class="form-control col-md-12" placeholder="Codigo Categoría" >
						<input type="text"  name="descripcion_categoriat" id="descripcion_categoriat" class="form-control col-md-12" placeholder="Nombre Categoría" >

						<br>
						<div class="modal-footer col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success" name="editarCat">Editar</button>
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
$('#editCat').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var codigo_categoriat = button.data('codigo_categoriat'); // Extraer información de datos- * atributos
          var descripcion_categoriat = button.data('descripcion_categoriat');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
           modal.find('.modal-body #codigo_categoriat_inicial').val(codigo_categoriat);
          modal.find('.modal-body #codigo_categoriat').val(codigo_categoriat);
          modal.find('.modal-body #descripcion_categoriat').val(descripcion_categoriat);
        

      });

  </script>

  <?php include ('includes/adminfooter.php');?>

<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');


	//SI ES EL SUPERADMINISTRADOR PUEDE REALIZAR ESTAS ACCIONES

	if (isset($_POST['islider'])) {
		//INGRESAR UN NUEVO REGISTRO A LA BASE DE DATOS
		$titulo_slider = $_POST['titulo_slider'];
		$texto_slider = $_POST['texto_slider'];
		$boton_slider = $_POST['boton_slider'];
		$enlace_slider = $_POST['enlace_slider'];
		

		$image = $_FILES['image']['name'];
		//$ext = $_FILES['image']['type'];
		//$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
		if (empty($image)) {
			echo "<script>alert('Adjunta una imagen');</script>";
		}else{
			$folder  = '../slider/';
			$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
			$picture = rand(1000 , 1000000) .'.'.$imgext;
			if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
				$query = "INSERT INTO slider(img_slider,titulo_slider,texto_slider,boton_slider,enlace_slider) VALUES ('$picture','$titulo_slider','$texto_slider','$boton_slider','$enlace_slider')";
				$result = pg_query($query);
				if (pg_affected_rows($result) > 0) {
					echo '<script>
					swal("Buen Trabajo!", "Sse registro con éxito", "success");
					</script>';
				}
				else {
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error ", "error");</script>';
				}
			}

		}	
	}
	//EDITAR IMAGEN O CAMPOS DE TEXTO 
	if(isset($_POST['editarimg'])) {
		$id_slider = $_POST['id_slider'];
		$titulo_slider = $_POST['titulo_slider'];
		$texto_slider = $_POST['texto_slider'];
		$boton_slider = $_POST['boton_slider'];
		$enlace_slider = $_POST['enlace_slider'];
		
		// SI LA VARIABLE IMAGEN NO ESTA VACIA ENTONCES EDITE CON IMG 
		if ($_FILES['image']['name'] != null) {
			$query = "SELECT * FROM slider WHERE  id_slider = '$id_slider'";
			$run_query = pg_query($conn, $query);

			if (pg_num_rows($run_query) > 0) {
				while ($row = pg_fetch_array($run_query)) {
					$img_slider = $row['img_slider'];
				}
				//acá le damos la direccion exacta del archivo y los permisos para eliminar el archivo de la carpeta SLIDER y no acumular archivos que ya no vamos a usar
				$path = '../slider/'.$img_slider.'';
				chown($path, 666);

				if (unlink($path)) {
					//echo 'success';
				} else {
					//echo 'fail';
				}
			}
			$image = $_FILES['image']['name'];
			$ext = $_FILES['image']['type'];
			$validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
			if (empty($image)) {
				$picture = $image;
			}else {
				$folder  = '../slider/';
				$imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
				$picture = rand(1000 , 1000000) .'.'.$imgext;
				move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture);
			}
			//EDITAR MODIFICANDO LA IMAGEN
			$editarImg = "UPDATE slider SET img_slider='$picture',titulo_slider='$titulo_slider',texto_slider='$texto_slider',boton_slider='$boton_slider',enlace_slider='$enlace_slider' WHERE id_slider = '$id_slider'";

			$resultado = pg_query($editarImg);
			if (pg_affected_rows($resultado) > 0 ) {
				echo '<script>
				swal("Buen Trabajo!", "Se edito con éxito ", "success");
				</script>';

			}else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error", "error");</script>';
			}
		}else{
			//EDITAR SIN MODIFICAR LA IMAGEN
			$editartextos = "UPDATE slider SET titulo_slider='$titulo_slider',texto_slider='$texto_slider',boton_slider='$boton_slider',enlace_slider='$enlace_slider' WHERE id_slider = '$id_slider'";

			$resultado = pg_query($editartextos);
			if (pg_affected_rows($resultado) > 0 ) {
				echo '<script>
				swal("Buen Trabajo!", "Se edito con éxito ", "success");
				</script>';
			}else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error con la IMG", "error");</script>';
			}
		}
	} //CIERRA EL IF PARA EDITAR LA IMAGEN DEL SLIDER

	//ELIMINA LAS IMAGENES DEL SLIDER PARA ESTO TRAE EL CODIGO/ ID DE EL REGISTRO DE LA IMAGEN
	if(isset($_POST['elimina_img'])) {
		$id_slider =$_POST['elimina_img'];
		$del_query = "DELETE FROM slider WHERE id_slider='$id_slider'";
		$run_del_query = pg_query($del_query);
		if (pg_affected_rows($run_del_query) > 0) {
			echo '<script>
			swal("Buen Trabajo!", "Imagen eliminada del slider con éxito", "success");
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
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalslider">
					Añadir Imagen
				</button>
			</div>
			
			<!-- Modal Glosario -->
			<div class="modal fade" id="modalslider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Añadir Imagen</h5>
						</div>
						<div class="modal-body">
							<form  action="" method="post" class="form-inline" enctype="multipart/form-data">
								<p><B> Los campos que diligencies apareceran en el Slider de la pagina principal.</B></p>
								<input type="file" name="image" class="form-control col-md-12"> 
								<input type="text" class="form-control col-md-12" name="titulo_slider" placeholder="Titulo de la Imagen">
								<input type="text" class="form-control col-md-12" name="texto_slider" placeholder="Texto de la Imagen">
								<input type="text" class="form-control col-md-12" name="boton_slider" placeholder="Texto del boton">
								<input type="text" class="form-control col-md-12" name="enlace_slider" placeholder="Enlace del boton">
								<br>
								<div class="modal-footer col-lg-12 col-xs-12 col-md-12 col-sm-12">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-success" name="islider">
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
					<table id="tabla_rol" class="table table-bordered table-striped table-hover ">
						<thead class="btn-info">
							<tr>
								<th>#</th>
								<th>Img</th>
								<th>Titulo</th>
								<th>Texto</th>
								<th>Texto boton</th>
								<th>Enlace</th>
								<th>Editar</th>
								<th>Borrar</th>
							</tr>
						</thead>
						<tbody>
							<!-- CONSULTA A LA BD -->
							<?php

							$query = "SELECT * FROM slider ORDER BY id_slider ASC";
							$run_query = pg_query($conn, $query);
							
							if (pg_num_rows($run_query) > 0) {
								while ($row = pg_fetch_array($run_query)) {
									$id_slider = $row['id_slider'];
									$img_slider = $row['img_slider'];
									$titulo_slider = $row['titulo_slider'];
									$texto_slider = $row['texto_slider'];
									$boton_slider = $row['boton_slider'];
									$enlace_slider = $row['enlace_slider'];

									echo "<tr>";
									echo "<td>$id_slider</td>";
									echo '<td><img src="../slider/'.$img_slider.'"  width="100"  alt=""> </td>';
									echo "<td>$titulo_slider</td>";
									echo "<td>$texto_slider</td>";
									echo "<td>$boton_slider</td>";
									echo "<td>$enlace_slider</td>";
									echo "<td class='text-center'>
									<a class='btn btn-warning' href='#editSlider' data-toggle='modal' data-id_slider='".$id_slider."' data-titulo_slider='".$titulo_slider."' data-texto_slider='".$texto_slider."' data-boton_slider='".$boton_slider."' data-enlace_slider='".$enlace_slider."'><i class='fas fa-edit'></i></a>
									</td>";
									echo '
									<form action="" class="aeliminar_img" method="POST" >
									 <td class="text-center">
									<input type="hidden" name="elimina_img" value="'.$id_slider.'">
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
		<?php }?>
	</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<!-- MODAL PARA EDITAR ROL-->
<div class="modal fade" id="editSlider" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addItemModalLabel">Editar Imagen del Slider</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form  action="" method="POST"  enctype="multipart/form-data">
					<p><B> Los campos que diligencies apareceran en el Slider de la pagina principal.</B></p>

					<div class="form-group col-md-12">
						<label class="col-form-label">Imgen Slider</label>
						<input type="file" name="image" class="form-control ">
					</div>
					<div class="form-group col-md-12">
						<label class="col-form-label">Titulo Slider</label>
						<input type="text" required="required" id="titulo_slider" class="form-control" name="titulo_slider" placeholder="Titulo" >
					</div>
					<div class="form-group col-md-12">
						<label class="col-form-label">Texto Slider</label>
						<input type="text" required="required" id="texto_slider" class="form-control" name="texto_slider" placeholder="Descripcion" >
					</div>
					<div class="form-group col-md-12">
						<label class="col-form-label">Nombre del boton </label>
						<input type="text" required="required" id="boton_slider" class="form-control" name="boton_slider" placeholder="Nombre del boton" >
					</div>
					<div class="form-group col-md-12">
						<label class="col-form-label">Enlace Slider</label>
						<input type="text" required="required" id="enlace_slider" class="form-control" name="enlace_slider" placeholder="Titulo" >
					</div>
					<div class=" col-md-6">
						<input type="hidden" required="required" id="id_slider" class="form-control" name="id_slider" >
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" name="editarimg">Editar</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div> 
<script>
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#editSlider').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var id_slider = button.data('id_slider'); // Extraer información de datos- * atributos
          var titulo_slider = button.data('titulo_slider');
          var texto_slider = button.data('texto_slider');
          var boton_slider = button.data('boton_slider');
          var enlace_slider = button.data('enlace_slider');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL
          var modal = $(this);
          modal.find('.modal-body #id_slider').val(id_slider);
          modal.find('.modal-body #titulo_slider').val(titulo_slider);
          modal.find('.modal-body #texto_slider').val(texto_slider);
          modal.find('.modal-body #boton_slider').val(boton_slider);
          modal.find('.modal-body #enlace_slider').val(enlace_slider);


      });
//EVITA EL ENVIO DEL FORMULARIO, SI EL USUARIO ESTA SEGURO DE ELIMINAR ACTIVA EL ENVIO
$('.aeliminar_img').submit(function(e){
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

<!-- FOOTER DE LA PAGINA -->
<?php include ('includes/adminfooter.php');?>

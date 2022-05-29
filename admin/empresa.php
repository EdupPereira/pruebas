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

	if(isset($_POST['editarEmpresa'])) {
		$organigrama_empresa=$_FILES['organigrama']['name'];
		$guardar_pdf=$_FILES['organigrama']['tmp_name'];
		$descripcion_empresa = $_POST['descripcion_empresa'];
		$mision_empresa = $_POST['mision_empresa'];
		$vision_empresa = $_POST['vision_empresa'];
		$historia_empresa = $_POST['historia_empresa'];
		$objetivos_empresa = $_POST['objetivos_empresa'];
		$funciones_empresa = $_POST['funciones_empresa'];
		$tratamientodatos = $_POST['tratamientodatos'];
		$condicionesuso = $_POST['condicionesuso'];
		if (empty($organigrama_empresa)){ 
			$editarPre = "UPDATE empresa SET descripcion_empresa = '$descripcion_empresa',mision_empresa='$mision_empresa',vision_empresa='$vision_empresa',historia_empresa='$historia_empresa',objetivos_empresa='$objetivos_empresa',funciones_empresa='$funciones_empresa',organigrama_empresa='$organigrama_empresa',tratamientodatos='$tratamientodatos',condicionesuso='$condicionesuso' WHERE codigo_empresa = '1'";

			$resultado = pg_query($editarPre);
			if (pg_affected_rows($resultado) > 0 ) {
				echo '<script>
				swal("Buen Trabajo!", "Se edito con éxito", "success");
				</script>';
			}

			else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error", "error");</script>';
			}
		}else{

			if (move_uploaded_file($guardar_pdf,'../empresa/'.$organigrama_empresa )) {

				$editarPre = "UPDATE empresa SET descripcion_empresa = '$descripcion_empresa',mision_empresa='$mision_empresa',vision_empresa='$vision_empresa',historia_empresa='$historia_empresa',objetivos_empresa='$objetivos_empresa',funciones_empresa='$funciones_empresa',organigrama_empresa='$organigrama_empresa',tratamientodatos='$tratamientodatos',condicionesuso='$condicionesuso' WHERE codigo_empresa = '1'";

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
		}
	}	
	//CONSULTAR EMPRESA
	$empresa= "SELECT * FROM empresa WHERE codigo_empresa='1'";
	$run_query = pg_query($conn, $empresa);
	if (pg_num_rows($run_query) > 0) {
		while ($fila = pg_fetch_array($run_query)) {
			$descripcion_empresa = $fila['descripcion_empresa'];
			$mision_empresa = $fila['mision_empresa'];
			$vision_empresa = $fila['vision_empresa'];
			$historia_empresa = $fila['historia_empresa'];
			$objetivos_empresa = $fila['objetivos_empresa'];
			$funciones_empresa = $fila['funciones_empresa'];
			$organigrama_empresa = $fila['organigrama_empresa'];
			$tratamientodatos = $fila['tratamientodatos'];
			$condicionesuso = $fila['condicionesuso'];

		}
	}

}
?>

<!-- CONTENEDOR AGREGAR Y TABLA DE CONSULTA -->
<div class="container-fluid">
	<!--SOLO EL ROL SUPERADMINISTRADOR PUEDE ACCEDER A ESTA SESION -->
	<?php if($_SESSION['role'] == 'superadmin')  
	{ ?>
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Que es EDUP</label>
							<textarea name="descripcion_empresa" id="" cols="30" rows="10" class="ckeditor">
								<?php echo $descripcion_empresa ?>
							</textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="inputPassword4">Misión</label>
							<textarea name="mision_empresa" id="mision" cols="30" rows="10" class="ckeditor">
								<?php echo $mision_empresa ?>
							</textarea>
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">Visión</label>
							<textarea name="vision_empresa" id="vision_empresa" cols="30" rows="10" class="ckeditor">
								<?php echo $vision_empresa ?>
							</textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="inputAddress2">Historia</label>
							<textarea name="historia_empresa" id="historia_empresa" cols="30" rows="10" class="ckeditor">
								<?php echo $historia_empresa ?>
							</textarea>
						</div>

						<div class="form-group col-md-6">
							<label for="inputCity">Objetivos</label>
							<textarea name="objetivos_empresa" id="objetivos_empresa" cols="30" rows="10" class="ckeditor">
								<?php echo $objetivos_empresa ?>
							</textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="inputCity">Funciones</label>
							<textarea name="funciones_empresa" id="funciones_empresa" cols="30" rows="10" class="ckeditor">
								<?php echo $funciones_empresa ?>
							</textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="inputCity">Ley de Tratamiento de Datos</label>
							<textarea name="tratamientodatos" id="tratamientodatos" cols="30" rows="10" class="ckeditor">
								<?php echo $tratamientodatos ?>
							</textarea>
						</div>
						<div class="form-group col-md-6">
							<label for="inputCity">Condiciones de Uso</label>
							<textarea name="condicionesuso" id="condicionesuso" cols="30" rows="10" class="ckeditor">
								<?php echo $condicionesuso ?>
							</textarea>
						</div>

					</div>

					<button type="submit" class="btn btn-primary" name="editarEmpresa">Guardar Cambios</button>
				</form>
			</div>
		</div>
	<?php }?>
</div> 
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<script>
    initSample();
    misionem();
</script>
<script type="text/javascript">
	$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}
}
</script>

<?php include ('includes/adminfooter.php');?>

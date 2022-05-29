<?php
//PERMITE MODIFICAR ENCABEZADOS
ob_start();
include 'includes/connection.php';

?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?>

<?php 
if (isset($_POST['guardar_pqrsd'])) {
	//print_r($_FILES);
	$nombre_archivo=$_FILES['archivo_pqrsd']['name'];
	$guardar_pdf=$_FILES['archivo_pqrsd']['tmp_name'];
	
	if (empty($nombre_archivo)){ 
		$id_pqrsd = $_POST['id_pqrsd'];
		$nombres_pqrsd = $_POST['nombres_pqrsd'];
		$direccion_pqrsd = $_POST['direccion_pqrsd'];
		$correo_pqrsd = $_POST['correo_pqrsd'];
		$departamento_pqrsd = $_POST['departamento_pqrsd'];
		$telefono_pqrsd = $_POST['telefono_pqrsd'];
		$descripcion_pqrsd = $_POST['descripcion_pqrsd'];
		$aceptar_pqrsd = $_POST['aceptar_pqrsd'];
		$pais_pqrsd = $_POST['pais_pqrsd'];
		$municipio_pqrsd = $_POST['municipio_pqrsd'];
		$fecha_llegada=date('Y-m-d');
		$codigo_identidad_fk=$_POST['tipo_identidad_fk'];
		$codigo_solicitud_fk=$_POST['tipo_solicitud_fk'];
		$codigo_persona_fk=$_POST['tipo_persona_fk'];
			//ESTE INSERT NOS RETORNA LA SECUENCIA INGRESA A CODIGO_PQRSD
		$query = "INSERT INTO pqrsd (identificacion_pqrsd,nombres_pqrsd,direccion_pqrsd,departamento_pqrsd,telefono_pqrsd,correo_pqrsd,descripcion_pqrsd,archivo_pqrsd,aceptar_pqrsd,pais_pqrsd,municipio_pqrsd) VALUES ('$id_pqrsd','$nombres_pqrsd','$direccion_pqrsd','$departamento_pqrsd','$telefono_pqrsd','$correo_pqrsd','$descripcion_pqrsd','$nombre_archivo','$aceptar_pqrsd','$pais_pqrsd','$municipio_pqrsd') RETURNING codigo_pqrsd";
			//CAPTURA EL CODIGO_PQRSD DE LO QUE SE ACABO DE INSERTAR
		$result=pg_exec($conn, $query);
		$row=pg_fetch_row($result);
		$codigo_pqrsd_fk=$row[0];
		$estado="Pendiente";

			// echo $codigo_pqrsd_fk;
		if (pg_affected_rows($result) > 0) {
			$query2 = "INSERT INTO pqrsd_detalle (
			fecha_llegada, codigo_identidad_fk, codigo_solicitud_fk, codigo_pqrsd_fk, codigo_persona_fk, estado_llegada)
			VALUES ('$fecha_llegada','$codigo_identidad_fk','$codigo_solicitud_fk','$codigo_pqrsd_fk','$codigo_persona_fk','$estado') RETURNING codigo_llegada";
			$result2=pg_exec($conn, $query2);
			$row2=pg_fetch_row($result2);
			$radicado=$row2[0];
			if (pg_affected_rows($result2) > 0) {
				header('Location: radicado.php?r='.$radicado.'');
			}
			else {
				echo 'No';
			}

		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error insertar PQRSD", "error");</script>';
		}

			//echo "Archivo guardado";
	}else {
		if ($_FILES['archivo_pqrsd']['size'] <= 0 || $_FILES['archivo_pqrsd']['size'] > 1024000 ){
			echo "<script>alert('El tamaño del archivo no es correcto');</script>";
		}else{ 
			if (move_uploaded_file($guardar_pdf,'pqrsd/'.$nombre_archivo )) {
			//Si el formulario trae un archivo entonces se inserta de la siguiente forma
				$id_pqrsd = $_POST['id_pqrsd'];
				$nombres_pqrsd = $_POST['nombres_pqrsd'];
				$direccion_pqrsd = $_POST['direccion_pqrsd'];
				$correo_pqrsd = $_POST['correo_pqrsd'];
				$departamento_pqrsd = $_POST['departamento_pqrsd'];
				$telefono_pqrsd = $_POST['telefono_pqrsd'];
				$descripcion_pqrsd = $_POST['descripcion_pqrsd'];
				$aceptar_pqrsd = $_POST['aceptar_pqrsd'];
				$pais_pqrsd = $_POST['pais_pqrsd'];
				$municipio_pqrsd = $_POST['municipio_pqrsd'];
				$fecha_llegada=date('Y-m-d');
				$codigo_identidad_fk=$_POST['tipo_identidad_fk'];
				$codigo_solicitud_fk=$_POST['tipo_solicitud_fk'];
				$codigo_persona_fk=$_POST['tipo_persona_fk'];
			//ESTE INSERT NOS RETORNA LA SECUENCIA INGRESA A CODIGO_PQRSD
				$query = "INSERT INTO pqrsd (identificacion_pqrsd,nombres_pqrsd,direccion_pqrsd,departamento_pqrsd,telefono_pqrsd,correo_pqrsd,descripcion_pqrsd,archivo_pqrsd,aceptar_pqrsd,pais_pqrsd,municipio_pqrsd) VALUES ('$id_pqrsd','$nombres_pqrsd','$direccion_pqrsd','$departamento_pqrsd','$telefono_pqrsd','$correo_pqrsd','$descripcion_pqrsd','$nombre_archivo','$aceptar_pqrsd','$pais_pqrsd','$municipio_pqrsd') RETURNING codigo_pqrsd";
			//CAPTURA EL CODIGO_PQRSD DE LO QUE SE ACABO DE INSERTAR
				$result=pg_exec($conn, $query);
				$row=pg_fetch_row($result);
				$codigo_pqrsd_fk=$row[0];
				$estado="Pendiente";

			// echo $codigo_pqrsd_fk;
				if (pg_affected_rows($result) > 0) {
					$query2 = "INSERT INTO pqrsd_detalle (
					fecha_llegada, codigo_identidad_fk, codigo_solicitud_fk, codigo_pqrsd_fk, codigo_persona_fk, estado_llegada)
					VALUES ('$fecha_llegada','$codigo_identidad_fk','$codigo_solicitud_fk','$codigo_pqrsd_fk','$codigo_persona_fk','$estado') RETURNING codigo_llegada";
					$result2=pg_exec($conn, $query2);
					$row2=pg_fetch_row($result2);
					$radicado=$row2[0];
					if (pg_affected_rows($result2) > 0) {
						header('Location: radicado.php?r='.$radicado.'');
					}
					else {
						echo 'No';
					}

				}
				else {
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error insertar PQRSD", "error");</script>';
				}

			//echo "Archivo guardado";
			}else {
				echo "ERROR";
			}
		}
	}
}
?>
<?php  
if (isset($_POST['guardar_anonimo'])) {
		//print_r($_FILES);
	$nombre_archivo=$_FILES['archivo_pqrsd']['name'];
	$guardar_pdf=$_FILES['archivo_pqrsd']['tmp_name'];
	if (empty($nombre_archivo)){ 
		$id_pqrsd = "000";
		$nombres_pqrsd = "Anonimo";
		$direccion_pqrsd = "N/N";
		$correo_pqrsd = $_POST['acorreo_pqrsd'];
		$departamento_pqrsd = $_POST['adepartamento_pqrsd'];
		$descripcion_pqrsd = $_POST['adescripcion_pqrsd'];
		$aceptar_pqrsd = $_POST['aaceptar_pqrsd'];
		$pais_pqrsd = $_POST['apais_pqrsd'];
		$municipio_pqrsd = $_POST['municipio_pqrsd'];
		$fecha_llegada=date('Y-m-d');
		$codigo_identidad_fk="4";
		$codigo_solicitud_fk=$_POST['atipo_solicitud_fk'];
		$codigo_persona_fk="4";
		$telefono_pqrsd="0";
			//ESTE INSERT NOS RETORNA LA SECUENCIA INGRESA A CODIGO_PQRSD
		$query = "INSERT INTO pqrsd (identificacion_pqrsd,nombres_pqrsd,direccion_pqrsd,departamento_pqrsd,telefono_pqrsd,correo_pqrsd,descripcion_pqrsd,archivo_pqrsd,aceptar_pqrsd,pais_pqrsd,municipio_pqrsd) VALUES ('$id_pqrsd','$nombres_pqrsd','$direccion_pqrsd','$departamento_pqrsd','$telefono_pqrsd','$correo_pqrsd','$descripcion_pqrsd','$nombre_archivo','$aceptar_pqrsd','$pais_pqrsd','$municipio_pqrsd') RETURNING codigo_pqrsd";
			//CAPTURA EL CODIGO_PQRSD DE LO QUE SE ACABO DE INSERTAR
		$result=pg_exec($conn, $query);
		$row=pg_fetch_row($result);
		$codigo_pqrsd_fk=$row[0];
		$estado="Pendiente";

			// echo $codigo_pqrsd_fk;
		if (pg_affected_rows($result) > 0) {
			$query2 = "INSERT INTO pqrsd_detalle (
			fecha_llegada, codigo_identidad_fk, codigo_solicitud_fk, codigo_pqrsd_fk, codigo_persona_fk, estado_llegada)
			VALUES ('$fecha_llegada','$codigo_identidad_fk','$codigo_solicitud_fk','$codigo_pqrsd_fk','$codigo_persona_fk','$estado') RETURNING codigo_llegada";
			$result2=pg_exec($conn, $query2);
			$row2=pg_fetch_row($result2);
			$radicado=$row2[0];
			if (pg_affected_rows($result2) > 0) {
				header('Location: radicado.php?r='.$radicado.'');
			}
			else {
				echo 'No';
			}

		}
		else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error insertar PQRSD", "error");</script>';
		}

			//echo "Archivo guardado";
	}else {
		if (move_uploaded_file($guardar_pdf,'pqrsd/'.$nombre_archivo )) {
			//Si el formulario trae un archivo entonces se inserta de la siguiente forma
			$id_pqrsd = "000";
			$nombres_pqrsd = "Anonimo";
			$direccion_pqrsd = "N/N";
			$correo_pqrsd = $_POST['acorreo_pqrsd'];
			$departamento_pqrsd = $_POST['adepartamento_pqrsd'];
			$descripcion_pqrsd = $_POST['adescripcion_pqrsd'];
			$aceptar_pqrsd = $_POST['aaceptar_pqrsd'];
			$pais_pqrsd = $_POST['apais_pqrsd'];
			$municipio_pqrsd = $_POST['amunicipio_pqrsd'];
			$fecha_llegada=date('Y-m-d');
			$codigo_identidad_fk="4";
			$codigo_solicitud_fk=$_POST['atipo_solicitud_fk'];
			$codigo_persona_fk="4";
			$telefono_pqrsd="0";
			//ESTE INSERT NOS RETORNA LA SECUENCIA INGRESA A CODIGO_PQRSD
			$query = "INSERT INTO pqrsd (identificacion_pqrsd,nombres_pqrsd,direccion_pqrsd,departamento_pqrsd,telefono_pqrsd,correo_pqrsd,descripcion_pqrsd,archivo_pqrsd,aceptar_pqrsd,pais_pqrsd,municipio_pqrsd) VALUES ('$id_pqrsd','$nombres_pqrsd','$direccion_pqrsd','$departamento_pqrsd','$telefono_pqrsd','$correo_pqrsd','$descripcion_pqrsd','$nombre_archivo','$aceptar_pqrsd','$pais_pqrsd','$municipio_pqrsd') RETURNING codigo_pqrsd";
			//CAPTURA EL CODIGO_PQRSD DE LO QUE SE ACABO DE INSERTAR
			$result=pg_exec($conn, $query);
			$row=pg_fetch_row($result);
			$codigo_pqrsd_fk=$row[0];
			$estado="Pendiente";

			// echo $codigo_pqrsd_fk;
			if (pg_affected_rows($result) > 0) {
				$query2 = "INSERT INTO pqrsd_detalle (
				fecha_llegada, codigo_identidad_fk, codigo_solicitud_fk, codigo_pqrsd_fk, codigo_persona_fk, estado_llegada)
				VALUES ('$fecha_llegada','$codigo_identidad_fk','$codigo_solicitud_fk','$codigo_pqrsd_fk','$codigo_persona_fk','$estado') RETURNING codigo_llegada";
				$result2=pg_exec($conn, $query2);
				$row2=pg_fetch_row($result2);
				$radicado=$row2[0];
				if (pg_affected_rows($result2) > 0) {
					header('Location: radicado.php?r='.$radicado.'');
				}
				else {
					echo 'No';
				}

			}
			else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error insertar PQRSD", "error");</script>';
			}

			//echo "Archivo guardado";
		}else {
			echo "ERROR";
		}
	}
}

?>

<div class="container">
	<div class="row">
		<h2 class="page-header">
			<center>
				Usuarios para registrar solicitud
			</center>
		</h2>
		<div class="botoncuidadano col-md-4 col-xs-12 col-sm-12 py-3">
			<center>
				<button class="cuidadano btn btn-xs azul">Cuidadano</button>
			</center>
		</div>
		<div class="botonreservada col-md-4 col-xs-12 col-sm-12 py-3">
			<center>
				<a href="">
					<button class="reservada btn btn-xs azul">Identificacion Reservada</button>
				</a>
			</center>
		</div>
		<div class="botonanonimo  col-md-4 col-xs-12 col-sm-12 py-3">
			<center>
				<button class="anonimo btn btn-xs azul ">Anonimo</button>
			</center>
		</div>
	</div>
</div>
<div id="form-cuidadano" class="container">
	<div class="card row">
		<h4>Formulario PQRSFD Cuidadano</h4>
		<form  class="row g-3 needs-validation" novalidate action="" method="post" enctype="multipart/form-data" >
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom04" class="form-label">Tipo de Identidad</label>
				<select class="form-select" id="tipo_identidad_fk" name="tipo_identidad_fk" required>
					<option selected disabled value="">Seleccione una opción</option>
					<?php
					$tipo_identidad = "SELECT codigo_identidad,nombre_identidad FROM tipo_identidad";
					$run_query = pg_query($conn, $tipo_identidad);
					if (pg_num_rows($run_query) > 0) {
						while ($fila = pg_fetch_array($run_query)) {
							echo "<option value='".$fila['codigo_identidad']."'>".$fila['nombre_identidad']."</option>";
						}
					}
					?>
				</select>
				<div class="invalid-feedback">
					Por favor seleccione una opción
				</div>
				<div class="valid-feedback">
					Correcto!
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom04" class="form-label">Tipo de Persona</label>
				<select class="form-select" id="tipo_persona_fk" name="tipo_persona_fk" required>
					<option selected disabled value="">Seleccione una opción</option>
					<?php
					$tipo_identidad = "SELECT codigo_persona,nombre_persona FROM tipo_persona";
					$run_query = pg_query($conn, $tipo_identidad);
					if (pg_num_rows($run_query) > 0) {
						while ($fila = pg_fetch_array($run_query)) {
							echo "<option value='".$fila['codigo_persona']."'>".$fila['nombre_persona']."</option>";
						}
					}
					?>
				</select>
				<div class="invalid-feedback">
					Por favor seleccione una opción
				</div>
				<div class="valid-feedback">
					Correcto!
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom01" class="form-label">Identificación</label>
				<input type="number" class="form-control" id="id_pqrsd" name="id_pqrsd" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Nombres y Apellidos ó Razón Social</label>
				<input type="text" class="form-control" id="nombres_pqrsd" name="nombres_pqrsd" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>

			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Pais</label>
				<input  type="text" name="pais_pqrsd" class="form-control" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Departamento</label>
				<input  type="text" name="departamento_pqrsd" class="form-control" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Municipio</label>
				<input  type="text" name="municipio_pqrsd" class="form-control" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Teléfono ó Celular</label>
				<input type="number" class="form-control" id="telefono_pqrsd" name="telefono_pqrsd" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustomUsername" class="form-label">Correo Electronico</label>
				<div class="input-group has-validation">
					<span class="input-group-text" id="inputGroupPrepend">@</span>
					<input type="email" class="form-control" id="correo_pqrsd" name="correo_pqrsd" aria-describedby="inputGroupPrepend" required>
					<div class="valid-feedback">
						Correcto!
					</div>
					<div class="invalid-feedback">
						Completa este campo con un correo valido @.
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom04" class="form-label">Tipo de Solicitud</label>
				<select class="form-select" id="tipo_solicitud_fk" name="tipo_solicitud_fk" required>
					<option selected disabled value="">Seleccione una opción</option>
					<?php
					$tipo_solicitud = "SELECT codigo_solicitud,nombre_solicitud FROM tipo_solicitud";
					$run_query2 = pg_query($conn, $tipo_solicitud);
					if (pg_num_rows($run_query2) > 0) {
						while ($fila2 = pg_fetch_array($run_query2)) {
							echo "<option value='".$fila2['codigo_solicitud']."'>".$fila2['nombre_solicitud']."</option>";
						}
					}
					?>
				</select>
				<div class="invalid-feedback">
					Por favor seleccione una opción
				</div>
				<div class="valid-feedback">
					Correcto!
				</div>
			</div>
			<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12 form-group">
				<label for="archivo" class="form-label">Seleccion un archivo (IMG,PDF)</label>
				<font color='brown' > &nbsp;&nbsp;(Tamaño máximo permitido 1024 Kb) </font> 
				<input type="file" class="form-control" id="archivo_pqrsd" name="archivo_pqrsd">
			</div>

			<div class="col-12">
				<label for="archivo" class="form-label">Descripción de la PQRSFD</label>
				<textarea class="form-control" required id="descripcion_pqrsd" name="descripcion_pqrsd"></textarea>
				<div class="invalid-feedback">
					Por favor añade una descripción 
				</div>
				<div class="valid-feedback">
					Correcto!
				</div>
			</div>
			<div class="col-12 col-lg-4 col-xs-12 col-sm-12">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Si" name="aceptar_pqrsd" required>
					<label class="form-check-label" for="invalidCheck">
						Aceptar 
					</label>
					<!-- Button trigger modal -->
					<button type="button" class="btn amarillo" data-bs-toggle="modal" data-bs-target="#exampleModal">
						Ver terminos y condiciones
					</button>
					<div class="invalid-feedback">
						Debes estar de acuerdo antes de enviar.
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-4 col-xs-12 col-sm-12">
				<button class="btn verde" type="submit" name="guardar_pqrsd">Enviar</button>
			</div>
		</form>
	</div>
</div>
<!-- FORMULARIO ANONIMO -->
<div id="form-anonimo" class="container">
	<div class="card row">
		<h2>Formulario Anónimo</h2>
		<form id="form-anonimo" action="" class="row g-3 needs-validation" novalidate method="post">
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Pais</label>
				<input  type="text" name="apais_pqrsd" class="form-control" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Departamento</label>
				<input  type="text" name="adepartamento_pqrsd" class="form-control" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom02" class="form-label">Municipio</label>
				<input  type="text" name="amunicipio_pqrsd" class="form-control" required>
				<div class="valid-feedback">
					Correcto!
				</div>
				<div class="invalid-feedback">
					Completa este campo.
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustomUsername" class="form-label">Correo Electronico</label>
				<div class="input-group has-validation">
					<span class="input-group-text" id="inputGroupPrepend">@</span>
					<input type="email" class="form-control" id="correo_pqrsd" name="acorreo_pqrsd" aria-describedby="inputGroupPrepend" placeholder="Este campo es opcional">
					<div class="valid-feedback">
						Correcto!
					</div>

				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="validationCustom04" class="form-label">Tipo de Solicitud</label>
				<select class="form-select" id="tipo_solicitud_fk" name="atipo_solicitud_fk" required>
					<option selected disabled value="">Seleccione una opción</option>
					<?php
					$tipo_solicitud = "SELECT codigo_solicitud,nombre_solicitud FROM tipo_solicitud";
					$run_query2 = pg_query($conn, $tipo_solicitud);
					if (pg_num_rows($run_query2) > 0) {
						while ($fila2 = pg_fetch_array($run_query2)) {
							echo "<option value='".$fila2['codigo_solicitud']."'>".$fila2['nombre_solicitud']."</option>";
						}
					}
					?>
				</select>
				<div class="invalid-feedback">
					Por favor seleccione una opción
				</div>
				<div class="valid-feedback">
					Correcto!
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<label for="archivo" class="form-label">Solo Formato PDF</label>
				<input type="file" class="form-control" id="aarchivo_pqrsd" name="archivo_pqrsd">
			</div>

			<div class="col-12">
				<label for="archivo" class="form-label">Descripción de la PQRSFD</label>
				<textarea class="form-control" required id="adescripcion_pqrsd" name="adescripcion_pqrsd"></textarea>
				<div class="invalid-feedback">
					Por favor añade una descripción 
				</div>
				<div class="valid-feedback">
					Correcto!
				</div>
			</div>
			<div class="col-12 col-lg-4 col-xs-12 col-sm-12">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="Si" name="aaceptar_pqrsd" required>
					<label class="form-check-label" for="invalidCheck">
						Aceptar 
					</label>
					<!-- Button trigger modal -->
					<button type="button" class="btn amarillo" data-bs-toggle="modal" data-bs-target="#exampleModal">
						Ver terminos y condiciones
					</button>
					<div class="invalid-feedback">
						Debes estar de acuerdo antes de enviar.
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-4 col-xs-12 col-sm-12">
				<button class="btn btn-primary" type="submit" name="guardar_anonimo">Enviar</button>
			</div>

		</form>
	</div>
</div>

<!-- Modal DATOS PERSONALES -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Autorizacion Datos Personales</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Autorización de datos personales - Habeas Data De conformidad con lo dispuesto en la Ley 1581 de 2012, su Decreto Reglamentario 1377 de 2013 y el Acuerdo No. 013 de 2019, AUTORIZO de manera libre y voluntaria, conforme con la Política de Tratamiento de Datos Personales, a la Empresa de Desarrollo Urbano de Pereira – EDUP, como responsable para recolectar, usar y tratar conjunta o separadamente mis datos, que han sido suministrados y que se han incorporado en distintas bases o bancos de datos de todo tipo.En este sentido, la EDUP queda autorizada de manera expresa e inequívoca para mantener y manejar toda mi información personal y profesional para los fines que se encuentra legal y reglamentariamente facultado.Sin perjuicio de lo anterior, los referidos datos no podrán ser distribuidos, comercializados, compartidos, suministrados o intercambiados con terceros, y en general, realizar actividades en las cuales se vea comprometida la confidencialidad y protección de la información recolectada, y podré en cualquier momento solicitar que la información sea modificada, actualizada o retirada de las bases de datos de la EDUP
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
	'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
  	form.addEventListener('submit', function (event) {
  		if (!form.checkValidity()) {
  			event.preventDefault()
  			event.stopPropagation()
  		}else{
  			swal("Buen Trabajo!", "El formulario se completo con exito", "success");
  		}
  		form.classList.add('was-validated')
  	}, false)
  })
})()
</script>
<?php include 'includes/footer.php';
//PERMITE MODIFICAR ENCABEZADOS
ob_end_flush();
?>
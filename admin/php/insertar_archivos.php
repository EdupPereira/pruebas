<?php 

if (isset($_POST['iestado'])) {
		//print_r($_FILES);
	$archivo=$_FILES['archivo']['name'];
	$guardar_pdf=$_FILES['archivo']['tmp_name'];

	if ($_FILES['archivo']['size'] <= 0 ){
		echo "<script>alert('El tamaño del archivo no es correcto');</script>";
	}else{ 
		if (move_uploaded_file($guardar_pdf,'../transparencia/'.$archivo )) {
			//Si el formulario trae un archivo entonces se inserta de la siguiente forma
			$nombre_archivo = $_POST['nombre_archivo'];
			$descripcion_archivo = $_POST['descripcion_archivo'];
			$fecha_archivo = $_POST['fecha_archivo'];
			$anio = date('Y', strtotime($fecha_archivo));
			$codigo_subcat_fk= $_POST['codigo_subcat_fk'];
			$link_archivo= $_POST['link_archivo'];

			$query = "INSERT INTO archivos (nombre_archivo,descripcion_archivo,archivo,anio,codigo_subcat_fk,fecha_archivo,link_archivo) VALUES ('$nombre_archivo','$descripcion_archivo','$archivo','$anio','$codigo_subcat_fk','$fecha_archivo','$link_archivo')";
			$result=pg_exec($conn, $query);
			$row=pg_fetch_row($result);

			if (pg_affected_rows($result) > 0) {
				echo '<script>
				swal("Buen Trabajo!", "Se registro con éxito", "success");
				</script>';
				

			}
			else {
				echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error insertar", "error");</script>';
			}

			//echo "Archivo guardado";
		}else {
			echo "ERROR";
		}
	}
}

?>
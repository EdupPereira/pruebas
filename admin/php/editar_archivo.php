<?php 
if(isset($_POST['editar_archivo'])) {
	$cod_archivo=$_POST['cod_archivo'];
	$nombre_archivo = $_POST['nombre_archivo'];
	$descripcion_archivo = $_POST['descripcion_archivo'];
	$fecha_archivo = $_POST['fecha_archivo'];
	$anio = date('Y', strtotime($fecha_archivo));
	$archivo=$_FILES['archivo']['name'];
	$guardar_pdf=$_FILES['archivo']['tmp_name'];
	$verificar_archivo = $_FILES['archivo'];
	$codigo_subcat_fk= $_POST['codigo_subcat_fk'];
	$link_archivo= $_POST['link_archivo'];

	if ($_FILES['archivo']['name'] != null) {
		 
			if (move_uploaded_file($guardar_pdf,'../transparencia/'.$archivo )) {
				$editfinan = "UPDATE archivos SET nombre_archivo='{$nombre_archivo}',descripcion_archivo='{$descripcion_archivo}',archivo='{$archivo}',anio='$anio',codigo_subcat_fk='{$codigo_subcat_fk}',fecha_archivo='{$fecha_archivo}',link_archivo='{$link_archivo}'   WHERE cod_archivo = '{$cod_archivo}'";

				$resultado = pg_query($editfinan);
				if (pg_affected_rows($resultado) > 0 ) {
					echo '
					<script>
					swal("Buen Trabajo!", "El estado se edito con éxito", "success");
					</script>';
				}else {
					echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al editar el archivo", "error");</script>';
				}
			}
		
	}else{
		$editfinan = "UPDATE archivos SET nombre_archivo='{$nombre_archivo}',descripcion_archivo='{$descripcion_archivo}',anio='$anio',codigo_subcat_fk='{$codigo_subcat_fk}',fecha_archivo='{$fecha_archivo}',link_archivo='{$link_archivo}' WHERE cod_archivo = '{$cod_archivo}'";

		$resultado = pg_query($editfinan);
		if (pg_affected_rows($resultado) > 0 ) {
			echo '
			<script>
			swal("Buen Trabajo!", "El estado se edito con éxito", "success");
			</script>';
		}else {
			echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al editar el archivo", "error");</script>';
		}

	} 
}

?>
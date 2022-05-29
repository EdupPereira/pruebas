<?php 
include 'includes/connection.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>
<div class="container">
	<div class="row">
		<?php  
		$codigo_llegada = $_POST['codigo_llegada'];
		$identificacion = $_POST['identificacion'];
			//echo $codigo_llegada;
		if (isset($_POST['respuesta'])) {

			$radicado = "SELECT pd.codigo_llegada,pd.fecha_llegada,pd.codigo_identidad_fk,pd.codigo_solicitud_fk,pd.codigo_pqrsd_fk,pd.codigo_persona_fk,pd.estado_llegada,pd.respuesta_detalle,pd.comentario_detalle,ti.codigo_identidad,ti.nombre_identidad,ts.codigo_solicitud,ts.nombre_solicitud,pq.codigo_pqrsd,pq.identificacion_pqrsd,pq.nombres_pqrsd,pq.direccion_pqrsd,pq.departamento_pqrsd,pq.telefono_pqrsd,pq.correo_pqrsd,pq.descripcion_pqrsd,pq.archivo_pqrsd,pq.aceptar_pqrsd,pq.pais_pqrsd,pq.municipio_pqrsd,tp.codigo_persona,tp.nombre_persona
			FROM pqrsd_detalle pd
			INNER JOIN tipo_identidad ti
			ON pd.codigo_identidad_fk = ti.codigo_identidad
			INNER JOIN tipo_solicitud ts
			ON pd.codigo_solicitud_fk = ts.codigo_solicitud
			INNER JOIN pqrsd pq
			ON pd.codigo_pqrsd_fk = pq.codigo_pqrsd
			INNER JOIN tipo_persona tp
			ON pd.codigo_persona_fk = tp.codigo_persona

			WHERE  pd.codigo_llegada='{$codigo_llegada}' AND pq.identificacion_pqrsd='{$identificacion}' ORDER BY pd.codigo_llegada DESC  ";
			$run_query2 = pg_query($conn, $radicado);
			if (pg_num_rows($run_query2) > 0) {
				while ($fila2 = pg_fetch_array($run_query2)) {
					$codigo_llegada=$fila2['codigo_llegada'];
					$fecha_llegada=$fila2['fecha_llegada'];
					$nombre_identidad=$fila2['nombre_identidad'];
					$nombre_solicitud=$fila2['nombre_solicitud'];
					$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
					$nombres_pqrsd=$fila2['nombres_pqrsd'];
					$estado=$fila2['estado_llegada'];	
					$direccion_pqrsd=$fila2['direccion_pqrsd'];
					$departamento_pqrsd=$fila2['departamento_pqrsd'];
					$telefono_pqrsd=$fila2['telefono_pqrsd'];
					$correo_pqrsd=$fila2['correo_pqrsd'];
					$descripcion_pqrsd=$fila2['descripcion_pqrsd'];
					$archivo_pqrsd=$fila2['archivo_pqrsd'];
					$aceptar_pqrsd=$fila2['aceptar_pqrsd'];
					$respuesta_detalle=$fila2['respuesta_detalle'];
					$comentario_detalle=$fila2['comentario_detalle'];
					$pais_pqrsd=$fila2['pais_pqrsd'];
					$municipio_pqrsd=$fila2['municipio_pqrsd'];
					$nombre_persona=$fila2['nombre_persona'];
				}?>
				<?php
				echo '

				<div class="card col-md-12 py-3 border-bottom-info"><center><h4><B>Información PQRSFD</B></h4></center></div>

				<div class="card col-md-4"><B>Codigo Llegada :</B>'.$codigo_llegada.'</div>
				<div class="card col-md-4"><B>Fecha :</B> '.$fecha_llegada.'</div>
				<div class="card col-md-4"><B>Tipo PQRSD : </B>'.$nombre_solicitud.'</div>

				<div class="card col-md-4"><B>Identidad :</B>'.$nombre_identidad.'</div>
				<div class="card col-md-4"><B>Tipo de Persona :</B>'.$nombre_persona.'</div>
				<div class="card col-md-4"><B># ID :</B> '.$identificacion_pqrsd.'</div>
				<div class="card col-md-4"><B>Nombres : </B>'.$nombres_pqrsd.'</div>

				<div class="card col-md-4"><B>Pais : </B>'.$pais_pqrsd.'</div>
				<div class="card col-md-4"><B>Municipio : </B>'.$municipio_pqrsd.'</div>
				<div class="card col-md-4"><B>Departamento :</B>'.$departamento_pqrsd.'</div>
				<div class="card col-md-4"><B>Dirección :</B> '.$direccion_pqrsd.'</div>
				<div class="card col-md-4"><B>Telefono : </B>'.$telefono_pqrsd.'</div>

				<div class="card col-md-4"><B>Correo :</B>'.$correo_pqrsd.'</div>
				<div class="card col-md-4"><B>Estado :</B> '.$estado.'</div>
				<div class="card col-md-4"><B>Acepto Terminos y Condiciones : </B>'.$aceptar_pqrsd.'</div>

				<div class="card col-md-12"><p><br><B>Descripción :</B> '.$descripcion_pqrsd.'</p></div>
				<div class="card col-md-12 "><p><br><B>Archivos Adjuntos :</B> <a href="pqrsd/'.$archivo_pqrsd.'" target="_blank"><button class="btn btn-success">Ver PDF</button></a></p></div>

				';
				if ($estado=="Terminado") {
					echo '
					<div class="card col-md-12 py-3 border-bottom-warning"><center><h4><B>RESPUESTA PQRSD</B></h4></center></div>
					<div class="card col-md-12"><p><br><B>Descripción :</B> '.$comentario_detalle.'</p></div>
					<div class="card col-md-12 "><p><br><B>Respuesta :</B> <a href="pqrsd/'.$respuesta_detalle.'" target="_blank"><button class="btn btn-success">Ver PDF</button></a></p></div>
					';

				}	

			}else{
				echo " <center><h4>Lo sentimos aun no hay ninguna Solicitud de PQRSD</h4></center>";
			}

		}else{
			echo " <center><h4>Debes realizar la consulta primero <a href='consultar.php' ><button class='btn verde'>Consultar</button></a> </h4></center>";
		}
		?>
	</div>
</div> 	
<?php include 'includes/footer.php';?>


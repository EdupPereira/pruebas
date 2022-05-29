<?php
//PERMITE MODIFICAR ENCABEZADOS
ob_start();
include 'includes/connection.php';
?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?>

<?php 
	//CONSULTA SEGUN # DE LLEGADA
$codigo_llegada = pg_escape_string($conn,$_GET['r']);
// echo $codigo_llegada;
$radicado = "SELECT pd.codigo_llegada,pd.fecha_llegada,pd.codigo_identidad_fk,pd.codigo_solicitud_fk,pd.codigo_pqrsd_fk,pd.codigo_persona_fk,pd.estado_llegada,ti.codigo_identidad,ti.nombre_identidad,ts.codigo_solicitud,ts.nombre_solicitud,pq.codigo_pqrsd,pq.identificacion_pqrsd,pq.nombres_pqrsd,pq.direccion_pqrsd,pq.departamento_pqrsd,pq.telefono_pqrsd,pq.correo_pqrsd,pq.descripcion_pqrsd,pq.archivo_pqrsd,pq.aceptar_pqrsd,tp.codigo_persona,tp.nombre_persona
FROM pqrsd_detalle pd
INNER JOIN tipo_identidad ti
ON pd.codigo_identidad_fk = ti.codigo_identidad
INNER JOIN tipo_solicitud ts
ON pd.codigo_solicitud_fk = ts.codigo_solicitud
INNER JOIN pqrsd pq
ON pd.codigo_pqrsd_fk = pq.codigo_pqrsd
INNER JOIN tipo_persona tp
ON pd.codigo_persona_fk = tp.codigo_persona

WHERE pd.codigo_llegada='".$codigo_llegada."'
";
$run_query2 = pg_query($conn, $radicado);
if (pg_num_rows($run_query2) > 0) {
	while ($fila2 = pg_fetch_array($run_query2)) {
		$codigo_llegada=$fila2['codigo_llegada'];
		$fecha_llegada=$fila2['fecha_llegada'];
		$nombre_identidad=$fila2['nombre_identidad'];
		$nombre_solicitud=$fila2['nombre_solicitud'];
		$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
		$nombres_pqrsd=$fila2['nombres_pqrsd'];
	}
}
?>
<div class="container">
	<div class="row">
		<div class="card row normal">
			<center>
				<h5><?php echo $nombres_pqrsd ?>, gracias por utilizar nuestro portal  PQRSD </h5>
			</center>
			<div class="col-md-12 col-xs-12 col-lg-12">
				<center>
					<p>
						Recuerda guardar la siguiente informacion para llevar el seguimiento de tu <B><?php echo $nombre_solicitud ?> </B>:
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Codigo de Solicitud</th>
									<th>Fecha</th>
									<th>Identificacion</th>
									<th>Tipo de Solicitud</th>
								</tr>
								
							</thead>
							<tbody>
								<tr>
									<td><?php echo $codigo_llegada ?></td>
									<td><?php echo $fecha_llegada ?></td>
									<td><?php echo $identificacion_pqrsd ?></td>
									<td><?php echo $nombre_solicitud ?></td>
								</tr>
							</tbody>
						</table>
					</p>
					<div class="alert alert-info" role="alert">
						<p>
							<B>
								Puedes realizar el seguimiento de tu solicitud con tu numero de Nit / Identificacion o por el codigo asignado en el siguiente enlace <a href="consultar.php">Consultar PQRSFD</a> 
							</B>
						</p>
					</div>
					<div>
						<p>
							<B>Importante :</B>
							Ley No.1755 de 2015 Regula el derecho fundamental de petición
							Decreto No.491 de 2020 Emergencia sanitaria. Punto 3. Atención al ciudadano de manera virtual. Amplió los plazos a responder <br>

							<B>Plazos :</B>
							Importante aclararle a los ciudadanos que mientras superamos esta
							Emergencia se amplió el tiempo que tienen las entidades para atender
							las peticiones de documentos e información pública que pasa de 10
							días a 20 días y las peticiones mediante las cuales se elevan consultas
							(conceptos) pasan de 30 a 35 días.

							En conclusión. La Entidad está respondiente peticiones a los 20 días plazo.  Para consultas hasta 35 días.
						</p>
					</div>
				</center>

			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php';
//PERMITE MODIFICAR ENCABEZADOS
ob_end_flush();
?>
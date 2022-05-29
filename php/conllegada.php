<?php 
require '../includes/connection.php';
	 //CONSULTAR CODIGO DE LLEGADA

$identificacion_pqrsd=$_POST['identificacion'];
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

WHERE  pq.identificacion_pqrsd='{$identificacion_pqrsd}' ORDER BY pd.codigo_llegada DESC  ";
$run_query2 = pg_query($conn, $radicado);
if (pg_num_rows($run_query2) > 0) {
	echo '
	<div id="main" class="col-md-12 alert">
	<hr>
	<center><h4>Aqui estan tus PQRSFD, copia y consulta el de tu interés.</h4></center>
	<table id="tabla_llegada" class="table table-hover ">
	<thead>
	<tr>
	<th>Codigo</th>
	<th><center>Nombres</center></th>
	<th>Fecha Solicitud</th>
	<th>Solicitud</th>
	<th>Estado</th>
	</tr>
	</thead>
	<tbody>
	'
	;
	while ($fila2 = pg_fetch_array($run_query2)) {
		$codigo_llegada=$fila2['codigo_llegada'];
		$fecha_llegada=$fila2['fecha_llegada'];
		$nombre_identidad=$fila2['nombre_identidad'];
		$nombre_solicitud=$fila2['nombre_solicitud'];
		$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
		$nombres_pqrsd=$fila2['nombres_pqrsd'];
		$estado=$fila2['estado_llegada'];

		echo'
		<tr>
		<td>'.$codigo_llegada.'</td>
		<td>'.$nombres_pqrsd.'</td>
		<td>'.$fecha_llegada.'</td>
		<td>'.$nombre_solicitud.'</td>
		<td>'.$estado.'</td>

		</tr>

		';
	}
	echo'
	</tbody>
	</table>

	</div>
	';
}else{
	echo'
	<div id="main" class="col-md-12 alert">
	<p>Lo sentimos, no hemos encontrado ninguna PQRSFD con el numero de identificación  :<B> '.$identificacion_pqrsd.'</B></p>
	</div>
	';
}


?>
	
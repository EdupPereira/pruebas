<div class="table-responsive">
	<?php 
	$titulo = "SELECT anio
	FROM archivos 
	WHERE  codigo_subcat_fk='{$codigo}' GROUP BY anio ORDER BY anio DESC";

	$iniciar = pg_query($conn, $titulo);
	if (pg_num_rows($iniciar) > 0) {
		while ($fila = pg_fetch_assoc($iniciar)) {
			$anioc = $fila['anio'];
			?> 
			
			<B> Año <?php echo $anioc; ?></B><br><p>Haciendo clic en las flechas que tiene los encabezados de la tabla puedes ordenar la  información.</p>

			<table id="" class="display table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Item</th>
						<th class="text-center">Descripción</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Archivo</th>
						<th class="text-center">Enlace</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT a.cod_archivo,a.nombre_archivo,a.descripcion_archivo,a.archivo,a.anio,a.codigo_subcat_fk,a.fecha_archivo,a.link_archivo,s.descripcion_subcat,s.codigo_subcat,s.codigo_categoriat_fk
					FROM archivos a
					INNER JOIN subcategoria_transparencia s
					ON a.codigo_subcat_fk = s.codigo_subcat


					WHERE  s.codigo_subcat='{$codigo}' AND a.anio='$anioc'  ORDER BY a.fecha_archivo ASC";
					$run_query = pg_query($conn, $query);
					if (pg_num_rows($run_query) > 0) {
						while ($row = pg_fetch_assoc($run_query)) {

							$cod_archivo = $row['cod_archivo'];
							$nombre_archivo = $row['nombre_archivo'];
							$descripcion_archivo = $row['descripcion_archivo'];
							$archivo = $row['archivo'];
							$fecha_archivo = $row['fecha_archivo'];
							$anio = $row['anio'];
							$descripcion_subcat=$row['descripcion_subcat'];
							$link_archivo=$row['link_archivo'];

							echo "<tr>";
							echo "<td>$nombre_archivo</td>";
							echo "<td>$descripcion_archivo</td>";
							echo "<td>$fecha_archivo</td>";
							echo "<td class='text-center'><center><a href='transparencia/$archivo' target='_blank'><button class='btn btn-success' title='$archivo'>Ver</button></a></center> </td>";
							if ($link_archivo!= null) {
								echo "<td><center><a href='$link_archivo' target='_blank'><button class='btn btn-info' title='$link_archivo'>Link</button></a></td>";
							}else{
								echo "<td>-- </td>";
							}
							echo "</td>";
							echo "</tr>";
						}
					}
					?>
				</tbody>
			</table>
			<?php 
		}
	}else{
	 echo "Aun no hay documentos en este item";
	}?>
</div>

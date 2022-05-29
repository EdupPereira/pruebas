
<div class="table-responsive">
	<table id="" class="display table table-bordered table-striped table-hover">
		<thead>
			<tr>
				
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Fecha</th>
				<th>Año</th>
				<th>Archivo</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT a.cod_archivo,a.nombre_archivo,a.descripcion_archivo,a.archivo,a.anio,a.codigo_subcat_fk,a.fecha_archivo,a.link_archivo,s.descripcion_subcat,s.codigo_subcat,s.codigo_categoriat_fk
			FROM archivos a
			INNER JOIN subcategoria_transparencia s
			ON a.codigo_subcat_fk = s.codigo_subcat


			WHERE  s.codigo_subcat='{$codigo}' ORDER BY a.fecha_archivo DESC  ";
			$run_query = pg_query($conn, $query);
			if (pg_num_rows($run_query) > 0) {
				while ($row = pg_fetch_array($run_query)) {
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
					echo "<td>$anio</td>";
					echo "<td><center><a href='transparencia/$archivo' target='_blank'><button class='btn btn-success' title='$archivo'>Ver</button></a></center>";
					if ($link_archivo!= null) {
						echo "<hr><center><a href='$link_archivo' target='_blank'><button class='btn btn-info' title='$link_archivo'>Link</button></a></center>";
					}
					echo "</td>";						


					echo "</tr>";
				}
			}

			?>
		</tbody>
	</table>
</div>
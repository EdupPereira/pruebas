<table id="" class="display table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Img</th>
			<th>Entidad</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Correo</th>
			<th>Sitio Web</th>
		</tr>
	</thead>
	<tbody>
		<!-- CONSULTA A LA BD -->
		<?php
		$query = "SELECT * FROM directorio WHERE tipo_directorio='Directorio de Entidades' ORDER BY codigo_directorio DESC";
		$run_query = pg_query($conn, $query);					
		if (pg_num_rows($run_query) > 0) {
			while ($row = pg_fetch_array($run_query)) {
				
				$nombre_directorio = $row['nombre_directorio'];
				$telefono_directorio = $row['telefono_directorio'];
				$direccion_directorio = $row['direccion_directorio'];
				$correo_directorio = $row['correo_directorio'];
				$tipo_directorio = $row['tipo_directorio'];
				$sitioweb_directorio = $row['sitioweb_directorio'];
				$img_directorio = $row['img_directorio'];
				echo "<tr>";
				echo '<td><img  width="100" src="directorio/'.$img_directorio.'" alt="" ></td>';
				echo "<td>$nombre_directorio</td>";
				echo "<td>$direccion_directorio</td>";
				echo "<td>$telefono_directorio</td>";
				echo "<td>$correo_directorio</td>";
				echo "<td><a href='$sitioweb_directorio' target='_blank' title='$sitioweb_directorio'> <button class='btn verde'><i class='fa fa-globe'></i></button></a></td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>
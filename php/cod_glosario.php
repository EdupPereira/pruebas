<div class="table-responsive">
	<table id="busqueda_glosario" class=" table table_border table-striped  ">
		<thead>
			<tr>
				<th>Palabra</th>
				<th>Definición</th>
			</tr>
		</thead> 
		<tbody>
			<!-- CONSULTA A LA BD -->
			<?php

			$query = "SELECT codigo_glosario,nombre_glosario,descripcion_glosario FROM glosario ORDER BY codigo_glosario DESC";
			$run_query = pg_query($conn, $query);

			if (pg_num_rows($run_query) > 0) {
				while ($row = pg_fetch_array($run_query)) {
					$nombre_glosario = $row['nombre_glosario'];
					$descripcion_glosario = $row['descripcion_glosario'];
					echo "<tr>";
					echo "<td><B>$nombre_glosario</B></td>";
					echo "<td>$descripcion_glosario</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
</div>
<div class="table-responsive">
	<table id="" class="display table table-striped ">
		<thead>
			<tr>
				<th>Pregunta</th>
				<th>Respuesta</th>
			</tr>
		</thead> 
		<tbody>
			<!-- CONSULTA A LA BD -->
			<?php 	
			$query = "SELECT codigo_pr,pregunta,respuesta FROM preguntas_respuestas ORDER BY codigo_pr ASC";
			$run_query = pg_query($conn, $query);

			if (pg_num_rows($run_query) > 0) {
				while ($row = pg_fetch_array($run_query)) {
					
					$pregunta = $row['pregunta'];
					$respuesta = $row['respuesta'];
					echo "<tr>";
					
					echo "<td><B>$pregunta</B></td>";
					echo "<td>$respuesta</td>";

					echo "</tr>";
				}
			}
			
			?>
		</tbody>
	</table>
</div>	
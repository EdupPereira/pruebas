<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>




<div class="container">
	<div class="row">
		<h2 class="page-header">
			Consultar PQRSD
		</h2>


		<div class="alert verde col-md-6 col-lg-6 ">
			<p class="lead">
				<i class="fa fa-exclamation-circle fa-3x" aria-hidden="true"></i> 
				Para realizar la consulta debes ingresar tu numero de identificación y el numero de llegada que te asignamos previamente, si realizaste una solicitud como ciudadano ó empresa.
			</p>
		</div>
		<div class="alert verde col-md-6 col-lg-6 ">
			<p class="lead">
				<i class="fa fa-user-secret fa-3x" aria-hidden="true"></i> <a id="mostraranonimo" class="telefonos">Aquí puedes Consultar los <B> PQRSFD anónimos.</B></a> 
			</p>
		</div>


		<div class="col-md-4 col-lg-4 card formllegada">
			<form class="col-md-12" action="respuesta.php" method="POST">
				<div class="mb-3">
					<br>
					<center><h4>Realiza aquí tu consulta</h4></center>
					<div id="emailHelp" class="form-text">En la Edup protegemos tu información</div>
					<label for="exampleInputEmail1" class="form-label"><B>Identificación</B></label>
					<input type="number" class="form-control" name="identificacion" aria-describedby="emailHelp" required>
					
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label"><B>Codigo de PQRSD</B></label>
					<input type="password" class="form-control" name="codigo_llegada" required>
				</div>

				<button type="submit" class="btn btn-primary" name="respuesta">Consultar</button>
			</form>
			<br>
		</div>
		<div class="col-md-8 formllegada">

			<p class="lead"><B>¿Olvidaste el número de llegada ?</B> No te preocupes puedes consultarlo con tu identificación</p>

			<form id="insertar_estado" action="" method="POST"  novalidate class="needs-validation"  onsubmit="return false;">
				<center>
					<div class="col-md-6">
						<input type="number" class="form-control" placeholder="Ingrese # de identificación" name="identificacion" id="identificacion" required aria-label="Identificación" aria-describedby="conllegada" >
						<br>
						<button class="btn amarillo" type="submit" name="conllegada" id="conllegada">Consultar</button>
					</div>
				</center>

			</form>
			<div id="resultado"></div>
		</div>
	</div>
	<div id="consulanonimo">
		<?php
		$anonimo="4";
		$radicado = "SELECT pd.codigo_llegada,pd.fecha_llegada,pd.codigo_identidad_fk,pd.codigo_solicitud_fk,pd.codigo_pqrsd_fk,pd.codigo_persona_fk,pd.estado_llegada,ti.codigo_identidad,ti.nombre_identidad,ts.codigo_solicitud,ts.nombre_solicitud,pq.codigo_pqrsd,pq.identificacion_pqrsd,pq.nombres_pqrsd,pq.direccion_pqrsd,pq.departamento_pqrsd,pq.telefono_pqrsd,pq.correo_pqrsd,pq.descripcion_pqrsd,pq.archivo_pqrsd,pq.aceptar_pqrsd,pq.pais_pqrsd,pq.municipio_pqrsd,tp.codigo_persona,tp.nombre_persona
		FROM pqrsd_detalle pd
		INNER JOIN tipo_identidad ti
		ON pd.codigo_identidad_fk = ti.codigo_identidad
		INNER JOIN tipo_solicitud ts
		ON pd.codigo_solicitud_fk = ts.codigo_solicitud
		INNER JOIN pqrsd pq
		ON pd.codigo_pqrsd_fk = pq.codigo_pqrsd
		INNER JOIN tipo_persona tp
		ON pd.codigo_persona_fk = tp.codigo_persona
		WHERE ti.codigo_identidad='{$anonimo}'
		ORDER BY pd.codigo_llegada ASC ";
		$run_query2 = pg_query($conn, $radicado);
		if (pg_num_rows($run_query2) > 0) {?>

			<div id="main" class="col-md-12">
				<center><h4>PQRSFD Anónimos</h4></center>
				<p>Busca por código de llegada tu PQRSFD anónimo, si tu PQRSDF no es anónimo <B><a href="consultar.php">haz clic aquí</a></B></p>
				<table id="" class="display table table-hover">
					<thead>
						<tr>
							<th>Código</th>
							<th>Fecha</th>
							<th>Identificación</th>
							<th>Nombres</th>
							<th>Solicitud</th>
							<th>Estado</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php  
						while ($fila2 = pg_fetch_array($run_query2)) {
							$codigo_llegada=$fila2['codigo_llegada'];
							$fecha_llegada=$fila2['fecha_llegada'];
							$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
							$nombre_solicitud=$fila2['nombre_solicitud'];
							$identificacion_pqrsd=$fila2['identificacion_pqrsd'];
							$nombres_pqrsd=$fila2['nombres_pqrsd'];
							$estado=$fila2['estado_llegada'];

							echo'
							<tr>
							<td>'.$codigo_llegada.'</td>
							<td>'.$fecha_llegada.'</td>
							<td>'.$identificacion_pqrsd.'</td>
							<td>'.$nombres_pqrsd.'</td>
							<td>'.$nombre_solicitud.'</td>
							<td>'.$estado.'</td>
							<td>';
							
							?>

							<form class="col-md-12" action="respuesta.php" method="POST">
								<input type="hidden" class="form-control" name="identificacion" aria-describedby="emailHelp" required value="<?php echo $identificacion_pqrsd; ?>">

								
								<input type="hidden" class="form-control" name="codigo_llegada" value="<?php echo $codigo_llegada; ?>" required>
							</div>

							<button type="submit" class="btn btn-primary" name="respuesta">Consultar</button>
						</form>


						<?php  
						echo'
						</td>
						</tr>

						';
					}
					echo'
					</tbody>
					</table>

					</div>
					';
				}  
				?>
			</div>
		</div>
		<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
	'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
  	form.addEventListener('submit', function (event) {
  		if (!form.checkValidity()) {
  			event.preventDefault()
  			event.stopPropagation()
  		}else{
  			//swal("Buen Trabajo!", "El formulario se completo con exito", "success");
  		}
  		form.classList.add('was-validated')
  	}, false)
  })
})()
</script>

<?php include 'includes/footer.php';?>


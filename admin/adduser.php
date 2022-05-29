<!-- AGREGAR LA CLASE GUMP CUANDO TENGAMOS EL NUEVO SERVIDOR Y ASI PODER PONER RESTRINGCIONES EL EL TEXTO PW Y DEMAS -->
<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');
if (isset($_SESSION['role'])) {
	$currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user') {
	echo "<script> alert('Solo los Administradores pueden agregar Usuarios');
	window.location.href='./index.php'; </script>";
}
else {
	if (isset($_POST['add'])) {
		if ($_POST['password'] !== $_POST['cpassword']) 
		{
			echo  "<center><font color='red'>Las contraseñas no coinciden </font></center>";
		}
		else {
			$id_usuario=$_POST['id_usuario'];
			$username = $_POST['username'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$role = $_POST['role'];
			$pass = $_POST['password'];
			$area = $_POST['area'];
			$password = password_hash("$pass" , PASSWORD_DEFAULT);
			$query = "INSERT INTO users(username,firstname,lastname,email,password,role,area) VALUES ('$username' , '$firstname' , '$lastname' , '$email', '$password' , '$role','$area')";
			$result = pg_query($query);
			if (pg_affected_rows($result) > 0) {
				echo "<script>swal('Nuevo Usuario Agregado');
				window.location.href='index.php';</script>";
			}
			else {
				echo "<script>swal('Ocurrio un error, inténtalo nuevamente');</script>";
			}
		}
	}
}
?>

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-lg-8 col-md-8">
			<h3 class="page-header">
				Agregar nuevo Usuario
			</h3>

			<form role="form" action="" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="user_title">Identificacion</label>
					<input type="number" name="id_usuario" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="user_title">Usuario</label>
					<input type="text" name="username" class="form-control" required>
				</div>



				<div class="form-group">
					<label for="user_author">Nombre</label>
					<input type="text" name="firstname" class="form-control" required>
				</div>

				<div class="form-group">
					<label for="user_status">Apellido</label>
					<input type="text" name="lastname" class="form-control" required>
				</div>

				<div class="">
					<label for="user_status">Rol</label><br>
					<select class="form-control" name="role" id="">
						
						<?php
						$query = "SELECT * FROM roles ORDER BY codigo_rol ASC";
						$run_query = pg_query($conn, $query);
						if (pg_num_rows($run_query) > 0) {
							while ($row = pg_fetch_array($run_query)) {
								$codigo_rol = $row['codigo_rol'];
								$nombre_rol = $row['nombre_rol'];


								?>

								<option value="<?php echo $nombre_rol?>" name="role" class="role"><?php echo $nombre_rol?></option>
								<?php
							}
						}
						?>

					</select>

				</div>
				<div class="">
					<label for="user_status">Area</label>
					<select class="form-control" name="area" id="">
						
						<<?php
						$query = "SELECT * FROM area ORDER BY codigo_area ASC";
						$run_query = pg_query($conn, $query);
						if (pg_num_rows($run_query) > 0) {
							while ($row = pg_fetch_array($run_query)) {
								
								$nombre_area = $row['nombre_area'];


								?>

								<option value="<?php echo $nombre_area?>" name="area" class="role"><?php echo $nombre_area?></option>
								<?php
							}
						}
						?>

					</select>

				</div>
				<br>
				<div class="form-group">
					<label for="user_tag">Correo</label>
					<input type="email" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="user_tag">Contraseña</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="user_tag">Confirmar Contraseña</label>
					<input type="password" name="cpassword" class="form-control" required>
				</div>


				<button type="submit" name="add" class="btn btn-primary" value="Add User">Agregar Usuario</button>

			</form>
		</div>
		<div class="col-md-2"></div>
		
		<?php
		include('includes/adminfooter.php');
		?>

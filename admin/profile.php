<?php
include 'includes/adminheader.php';
include 'includes/adminnav.php';

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '{$username}'" ; 
	$result= pg_query($query) ;
	if (pg_affected_rows($result) > 0 ) {
		$row = pg_fetch_array($result);
		$userid = $row['id_usuario'];
		$usernm = $row['username'];
		$userpassword = $row['password'];
		$useremail = $row['email'];
		$userfirstname = $row['firstname'];
		$userlastname = $row['lastname'];
	}

	if (isset($_POST['update'])) {

		if (empty($_POST['newpassword'])) {
			$userfirstname = $_POST['firstname'];
			$userlastname = $_POST['lastname'];
			$useremail = $_POST['email'];
			$updatequery1 = "UPDATE users SET firstname = '$userfirstname' , lastname='$userlastname' , email='$useremail' WHERE id_usuario = '$userid' " ;
			$result2 = pg_query($updatequery1);
			if (pg_affected_rows($result2) > 0) {
				echo "<script>alert('Perfil de Usuario Actualizado Satisfactoriamente');</script>";
			}
			else {
				echo "<script>alert('Ocurrió un error. Intente nuevamente!');</script>";
			}
		}
		else if (isset($_POST['newpassword']) &&  ($_POST['newpassword'] !== $_POST['confirmnewpassword'])) 
		{
			echo  "<center><font color='red'>Nueva contraseña y Confirmar nueva contraseña no coinciden </font></center>";

		}
		else {
			$userfirstname = $_POST['firstname'];
			$userlastname = $_POST['lastname'];
			$useremail = $_POST['email'];
			$pass = $_POST['newpassword'];
			$userpassword = password_hash("$pass" , PASSWORD_DEFAULT);

			$updatequery = "UPDATE users SET password = '$userpassword', firstname='$userfirstname' , lastname= '$userlastname' , email= '$useremail' WHERE id_usuario='$userid' ";
			$result1 = pg_query($updatequery);
			if (pg_affected_rows($result1) > 0) {
				echo "<script>alert('Perfil actualizado satisfactoriamente');</script>";
			}
			else {
				echo "<script>alert('Se produjo un error. Intenta nuevamente!');</script>";
			}
		}
	}
 }

?>


<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">
				Bienvenid@ a tu perfil 
				<b><?php echo $_SESSION['firstname']; ?></b>
			</h3>
			<form role="form" action="" method="POST" enctype="multipart/form-data">

				<div class="form-group">
					<label for="user_title">Usuario</label>
					<input type="text" name="username" class="form-control" value="<?php echo $username; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="user_author">Nombre</label>
					<input type="text" name="firstname" class="form-control" value="<?php echo $userfirstname; ?>" required>
				</div>

				<div class="form-group">
					<label for="user_status">Apellido</label>
					<input type="text" name="lastname" class="form-control" value="<?php echo $userlastname; ?>" required>
				</div>
				<div class="form-group">
					<label for="user_tag">Correo</label>
					<input type="email" name="email" class="form-control" value="<?php echo $useremail; ?>" required>
				</div>
				<div class="form-group">
					<label for="usertag">Contraseña Actual</label>
					<input type="password" name="currentpassword" class="form-control" placeholder="Ingrese su actual contraseña" required>
				</div>
				<div class="form-group">
					<label for="usertag">Nueva Contraseña <font color='brown'> (Cambiar tu contraseña es opcional)</font></label>
					<input type="password" name="newpassword" class="form-control" placeholder="Ingrese nueva contraseña">
				</div>
				<div class="form-group">
					<label for="usertag">Confirmar Contraseña</label>
					<input type="password" name="confirmnewpassword" class="form-control" placeholder="Confirme su nueva contraseña" >
				</div>
				<hr>
				<button type="submit" name="update" class="btn btn-primary" value="Update User">Actualizar Usuario</button>
			</div>
		</div>
	</div>

</div>
</div>
</div>

<?php include ('includes/adminfooter.php');?>









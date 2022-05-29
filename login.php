<?php
session_start();
include('includes/connection.php');
if (isset($_POST['login'])) {
	$username  = $_POST['user_name'];
	$password = $_POST['user_password'];
	// pg_real_escape_string($conn, $username);
	// pg_real_escape_string($conn, $password);
$query = "SELECT * FROM users WHERE username = '$username'";
$result = pg_query($conn , $query);
if (pg_num_rows($result) > 0) {
	while ($row = pg_fetch_array($result)) {
		$id = $row['id'];
		$user = $row['username'];
		$pass = $row['password'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$role= $row['role'];
		$area= $row['area'];
		$image = $row['image'];
		if (password_verify($password, $pass )) {
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $user;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['email']  = $email;
			$_SESSION['role'] = $role;
			$_SESSION['area'] = $area;
			$_SESSION['image'] = $image;
			header('location: admin');
		}
		else {
			echo "<script>alert('usuario / contraseña invalida');
			window.location.href= 'iniciar_sesion.php';</script>";

		}
	}
}
else {
			echo "<script>alert('usuario / contraseña invalida');
			window.location.href= 'iniciar_sesion.php';</script>";

		}
}
else {
	header('location: index.php');
}
?>
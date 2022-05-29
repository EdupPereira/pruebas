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
	include ('php/insertar_archivos.php');
	include ('php/editar_archivo.php');
}
?>
<?php 
	$codigo='6';
	include ('php/formulario.php'); 
?>


<?php 
	include ('includes/adminfooter.php');
?>

  
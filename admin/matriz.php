<?php
include('includes/connection.php');
include('includes/adminheader.php');
include ('includes/adminnav.php');
include ('php/insertar_archivos.php');
include ('php/editar_archivo.php');

	$codigo = $_GET['codigo'];
	include ('php/formulario.php'); 
?>


<?php 
	include ('includes/adminfooter.php');
?>

  
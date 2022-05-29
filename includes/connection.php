<?php 


	$host="host=ec2-3-234-131-8.compute-1.amazonaws.com";
	$port="port=5432";
	$dbname="dbname=d5mjgimnh3kob0";
	$user="user=vhjvwbgsvfxiir";
	$password="password=11dae4482911347bb20f7ad6fb231542f83a0d418b8e01f0d350b771148b964e";

	$conn = pg_connect("$host $port $dbname $user $password");

	return $conn;



?>

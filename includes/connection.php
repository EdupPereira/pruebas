<?php 


	$host="host=ec2-3-213-146-52.compute-1.amazonaws.com";
	$port="port=5432";
	$dbname="dbname=d2mldq4jdcam39";
	$user="user=wdfagvcjuaxehy";
	$password="password=7c54f3a83f3fb9faef47cf89d7be5374133bd51be8c2da73d4c02b668a6b045d";

	$conn = pg_connect("$host $port $dbname $user $password");

	return $conn;



?>

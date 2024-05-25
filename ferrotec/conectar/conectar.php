<?php
	$conexion=mysqli_connect("localhost","root","") or die("Problemas en la conexion");
	mysqli_select_db($conexion, "ferrotec") or die("Problemas en la seleccion de la base de datos");
?>
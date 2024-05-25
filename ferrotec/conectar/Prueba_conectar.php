<?php
//	$conexion = mysql_connect("localhost","dbu_t31m05","pepe1234");
//	$labase = mysql_select_db("db_t31m05",$conexion);


$servername = "localhost";
$database = "ferrotec";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);

 
?>
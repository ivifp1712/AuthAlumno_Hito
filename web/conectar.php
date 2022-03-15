<?php 
$mysqli = new mysqli("localhost", "root", "", "alumno");

 
if(!$mysqli){
	echo "Error";
	die("Connection error: " . mysqli_connect_error());	
}
?>
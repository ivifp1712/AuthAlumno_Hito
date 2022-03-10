<?php
require_once("conectar.php");
function sacarDatos()
	{
		global $mysqli;
        //echo var_export($_POST);
        $stmt = $mysqli->prepare("SELECT rol FROM usuarios where id = ?");
		// $stmt = $mysqli->prepare("SELECT rol FROM usuarios WHERE id = ?");
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        //echo var_export($row);
		return $row["rol"];
	}

$var = sacarDatos();
//echo($var);
if ($var == "1") {
    $stmt = $mysqli->query("UPDATE usuarios set rol = 0 WHERE id = ".$_POST["id"]);
    echo("0,".$_POST["id"]);
    //echo ("cambiado a user");
}elseif($var == "0"){
    $stmt = $mysqli->query("UPDATE usuarios set rol = 1 WHERE id = ".$_POST["id"]);
    //echo ("cambiado a admin");
    echo("1,".$_POST["id"]);
}
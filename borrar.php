<?php
require_once("conectar.php");
$stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("s", $_POST["id"]);
$stmt->execute();
echo("1");

<?php
require_once("conectar.php");
$request_body = file_get_contents('php://input');
$post = json_decode($request_body, true);
$_POST = $post;
$stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("s", $_POST["id"]);
$stmt->execute();
echo("1");

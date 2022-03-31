<?php
$request_body = file_get_contents('php://input');
$post = json_decode($request_body, true);
$_POST = $post;
require_once("../connection.php");
$conexion= Db::getConnect();
$stmt = $conexion->prepare("SELECT * FROM usuarios where id = :id");
$stmt->bindValue(':id',$_POST['id']);
$stmt->execute();
$row = $stmt->fetch();

//echo `'"username": "`.$row['username'].`" , "email": "`.$row['email'].`", "name": "`.$row['nombre'].`"`;
$row = json_encode(array("username" => $row['username'], "email" => $row['email'], "name" => $row['nombre'], "foto" => $row['avatar'],"id" => $row['id']));
echo $row;
<?php
require_once("../connection.php");
$request_body = file_get_contents('php://input');
$post = json_decode($request_body, true);
$_POST = $post;

if (isset($_POST['id'])) {
    $conexion= Db::getConnect();
    $stmt = $conexion->prepare("SELECT * from usuarios WHERE id = :id");
    $stmt->bindValue(':id',$_POST['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row['rol'] == 0) {
        $stmt = $conexion->prepare("UPDATE usuarios set rol = 1 WHERE id = :id");
        $stmt->bindValue(':id',$_POST['id']);
        $stmt->execute();
        echo "1";
    }else{
        $stmt = $conexion->prepare("UPDATE usuarios set rol = 0 WHERE id = :id");
        $stmt->bindValue(':id',$_POST['id']);
        $stmt->execute();
        echo "0";
    }
}else{
    echo "valor post id no introducido";
}
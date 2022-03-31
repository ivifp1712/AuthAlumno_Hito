<?php
$request_body = file_get_contents('php://input');
$post = json_decode($request_body, true);
$_POST = $post;
require_once("../connection.php");
$conexion= Db::getConnect();
   if (isset($_POST["us"])) {
    $us = $_POST["us"];
    $pasar = 0;
    for ($i = 0;$i < strlen($us) ;$i++){
       if ($us[$i] != " ") {
           $pasar = 1;
       }
       }
    if ($pasar != 1) {
        echo("NO");
    }
    $stmt = $conexion->query("call comprobar('$us')");
    echo ($stmt->rowCount());
}

    if (isset($_POST["ma"])) {
        $ma = $_POST["ma"];
        if(filter_var($ma, FILTER_VALIDATE_EMAIL) === FALSE) {
            // Lanza una excepción si el email no es válido
            echo("NO");
        }
        $stmt = $conexion->query("call comprobarEmail('$ma')");
        echo ($stmt->rowCount());
}
?>

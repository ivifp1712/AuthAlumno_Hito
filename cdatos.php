<?php
require_once("conectar.php");
function sacarDatos($dato)
{
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT ".$dato." from usuarios WHERE id = ?");
    $stmt->bind_param("s", $_POST["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);
    return $row[$dato];
} 



if ($_POST["id"] == "no") {
    echo('<div class="col"><div class="form-group"><label>Nombre</label>');
    echo('<input class="form-control" type="text" name="nombre" placeholder="'."Nombre".'" required></div></div>');
    echo('<div class="col"><div class="form-group"><label>Username</label><input class="form-control" type="text" name="usuario" placeholder="'."Username".'" required></div></div>');
    echo('<div class="col"><div class="form-group"><label>Contraseña</label><input class="form-control" type="password" name="pass" placeholder="'."Contraseña".'" required></div></div>');
    echo('<div class="col"><div class="form-group"><label>Correo electrónico</label><input class="form-control" type="email" name="email" placeholder="'."Correo electrónico".'" required></div></div>');
    
    echo('<input type="text" name="registrar" style="display: none" value="algo">');
}else {
    echo('<div class="col"><div class="form-group"><label>Nombre</label>');
    echo('<input class="form-control" type="text" name="name" placeholder="'.sacarDatos("nombre").'" required></div></div>');
    echo('<div class="col"><div class="form-group"><label>Username</label><input class="form-control" type="text" name="username" placeholder="'.sacarDatos("username").'" required></div></div>');
    echo('<div class="col"><div class="form-group"><label>Correo electrónico</label><input class="form-control" type="email" name="email" placeholder="'.sacarDatos("email").'" required></div></div>');
    echo('<div class="col"><div class="form-group"><label>Avatar</label><input class="form-control" type="text" name="avatar" placeholder="'.sacarDatos("avatar").'" required></div></div>');
}

echo ('<input type="submit" value="Enviar Datos" class="btn btn-success btn-block">');
echo('<input type="text" name="id" value="'.$_POST["id"].'" style="display: none">');



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

$request_body = file_get_contents('php://input');
$post = json_decode($request_body, true);
$_POST = $post;


if ($_POST["id"] == "no") {
    echo('<div class="col"><div class="form-group"><label>Nombre</label>');
    echo('<input class="form-control" type="text" name="nombre" placeholder="'."Nombre".'" ></div></div>');
    echo('<div class="col"><div class="form-group"><label>Username</label><input class="form-control" type="text" name="usuario" placeholder="'."Username".'" onkeyup="comprobar(this.value, '."'usuario'".')" id="usuario"></div></div>');
    echo('<div class="col"><div class="form-group"><label>Contraseña</label><input class="form-control" type="password" name="pass" placeholder="'."Contraseña".'" ></div></div>');
    echo('<div class="col"><div class="form-group"><label>Correo electrónico</label><input class="form-control" type="email" name="email" placeholder="'."Correo electrónico".'" onkeyup="comprobar(this.value, '."'email'".')" id="email"></div></div>');
    
    echo('<input type="text" name="registrar" style="display: none" value="algo">');
}else {
    echo('<div class="col"><div class="form-group"><label>Nombre</label>');
    echo('<input class="form-control" type="text" name="name" placeholder="'.sacarDatos("nombre").'" ></div></div>');
    echo('<div class="col"><div class="form-group"><label>Username</label><input class="form-control" type="text" name="username" placeholder="'.sacarDatos("username").'" onkeyup="comprobar(this.value, '."'usuario'".')" id="usuario"></div></div>');
    echo('<div class="col"><div class="form-group"><label>Correo electrónico</label><input class="form-control" type="email" name="email" placeholder="'.sacarDatos("email").'" onkeyup="comprobar(this.value, '."'email'".')" id="email"></div></div>');
    $avatar = sacarDatos("avatar");
    if ($avatar == "imgs/perfil.png") {
        echo('<div class="col"><div class="form-group"><label>Avatar</label><input class="form-control" type="text" name="avatar" placeholder="Foto predeterminada" ></div></div>');
    }else {
        echo('<div class="col"><div class="form-group"><label>Avatar</label><input class="form-control" type="text" name="avatar" placeholder="'.sacarDatos("avatar").'" ></div></div>');
    }
    
}

echo ('<input type="submit" value="Enviar Datos" class="btn btn-success btn-block">');
echo('<input type="text" name="id" value="'.$_POST["id"].'" style="display: none">');



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Alumno - Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="shortcut icon" href="../imgs/icon.png" type="image/x-icon">
  <style>
    .toggle{
      width: 50px;
    }
    .avatar{
      width: 50px;
    }
    .ldere li{
      list-style: none;
      margin-left: -25px;
      margin-top: -5px;
      padding: 5px;
    }
    @keyframes opac {
      from { opacity: 0}
      to { opacity: 1}
    }
    @keyframes ropac {
      to { opacity: 0}
      from { opacity: 1}
    }
  </style>
</head>
<body>
  <?php
    session_start();
    if ($_SESSION["rol"] != 1) {
      header("Location: ../err/nopermise.php");
    }
require_once("nav.php");
?>
<style>
  nav{
            margin-top: -30px;
            margin-bottom: 50px;
            background-color: black;
            width: 90;
            padding: 25px;
        } 
  body{
    margin-bottom: 0;
    background-image: url('../imgs/fondo.jpg') !important;
    background-repeat: no-repeat;
    background-size: cover !important;
    backdrop-filter: blur(3px);
  }
</style>
  <script>
                  function cDatos(v) {
                    axios({
                    method: 'post',
                    url: 'cdatos.php',
                    data: {
                      id: v,
                    }
                    }).then(function (response) {
                      let data = response.data;
                      document.getElementById("form-usuario").innerHTML = data;
                    });
                  }
                </script>

<?php
  if (isset($_GET["exito"])) {
    echo('<div style="display: inline-block; width: 50%; position: relative; top: 10px; left: 25%;border: 1px solid #ccc;z-index: 15; background-color: #fff; padding-left: 5px; padding-top: 5px; margin-bottom: 25px;" id="exito"><p><img src="../imgs/check-solid.svg" style="width: 20px; margin-right: 15px; margin-left: 15px;"> Cambio realizado!</p></div>');
    echo('<script>document.getElementById("exito").style.animation = "opac 2s"; setTimeout(function(){document.getElementById("exito").style.animation = "ropac 2s"; setTimeout(function(){document.getElementById("exito").style.display = "none" }, 2000) }, 4000);</script>');
    
  }
  if (isset($_GET["error"])) {
    echo('<div style="display: inline-block; width: 50%; position: relative; top: 10px; left: 25%;border: 1px solid #ccc;z-index: 15; background-color: #fff; padding-left: 5px; padding-top: 5px; margin-bottom: 25px;" id="error"><p><img src="../imgs/xmark-solid.svg" style="width: 20px; margin-right: 15px; margin-left: 15px;"> Error en el registro! Comprueba que no se introduce ningun valor repetido.</p></div>');
    echo('<script>document.getElementById("error").style.animation = "opac 2s"; setTimeout(function(){document.getElementById("error").style.animation = "ropac 2s"; setTimeout(function(){document.getElementById("error").style.display = "none" }, 2000) }, 4000);</script>');
    
  }
?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
    <div class="card p-3">
      <div class="e-navlist e-navlist--active-bg">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link px-2 active" href="alumno.php"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Mis datos</span></a></li>
          <li class="nav-item"><a class="nav-link px-2" href="crud.php" target="__blank"><i class="fa fa-fw fa-cog mr-1"></i><span>Administrador</span></a></li>
        </ul>
      </div>
    </div>
  </div>

 
    <div class="row flex-lg-nowrap">
      <div class="col mb-3">
        <div class="e-panel card">
          <div class="card-body">
            <div class="card-title">
              <h6 class="mr-2" id="title"><span>Usuarios</span><small class="px-1"> - Ordenados por antigüedad</small></h6>
            </div>
            <div class="e-table">
              <div class="table-responsive table-lg mt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      
                      <th>Avatar</th>
                      <th>Username</th>
                      <th class="max-width">Nombre Completo</th>
                      <th class="sortable">Fecha de inicio</th>
                      <th>Admin</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <script>
                    
                    
                    function toggle(v) {
                      let activo = `<img src="../imgs/toggle-on-solid.svg" class="toggle">`;
                      let noActivo = `<img src="../imgs/toggle-off-solid.svg" class="toggle">`;
                      
                        axios({
                        method: 'post',
                        url: 'crol.php',
                        data: {
                          id: v,
                        }
                        }).then(function (response) {
                            let data = response.data;
                            let id = data.substring(2, data.length);
                            //console.log(id);
                              //console.log(id);
                              let cambio = data.substring(0, data.length - (data.length - 1));
                              //console.log(cambio);
                              if(cambio == "0"){
                                document.getElementById(id).innerHTML = `<img src="../imgs/toggle-off-solid.svg" class="toggle">`;
                              }else{
                                //console.log(document);
                                document.getElementById(id).innerHTML = `<img src="../imgs/toggle-on-solid.svg" class="toggle">`;
                              }
                        });
                    }
                   
                    function borrar(v) {
                      //console.log(1)
                      axios({
                      method: 'post',
                      url: 'borrar.php',
                      data: {
                        id: v,
                      }
                      }).then(function (response) {
                        exito();
                      });
                    }
            
                  </script>
                  <tbody>

                  <?php
                      require_once("conectar.php");
                      $stmt = $mysqli->prepare("SELECT avatar, username, nombre, fechainicio, rol, id from usuarios");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $row = $result->fetch_all();
                      
                      // Indices en orden introducido
                      $pasar = 0;
                      $activo = '<img src="../imgs/toggle-on-solid.svg" class="toggle">';
                      $noActivo = '<img src="../imgs/toggle-off-solid.svg" class="toggle">';
                      foreach ($row as $i) {
                          
                          echo("<tr>");
                          echo('<td class="align-middle text-center">');
                          echo('<div class="bg-light d-inline-flex justify-content-center align-items-center align-top" style="width: 35px; height: 35px; border-radius: 3px;">');
                          if ($i[0] == "imgs/perfil.png") {
                              echo('<img src="../'.$i[0].'" class="avatar"');
                          }else{
                            echo('<img src="'.$i[0].'" class="avatar"');
                          }
                          echo("</div>");
                          echo('<td class="text-nowrap align-middle">'.$i[1].'</td>');
                          echo('<td class="text-nowrap align-middle">'.$i[2].'</td>');
                          echo('<td class="text-nowrap align-middle">'.$i[3].'</td>');
                          if ($_SESSION["user"] == $i[1]) {
                            $pasar = 1;
                          }
                        if ($i[4] == "0") {
                          echo('<td class="text-center align-middle" id="'.$i[5].'" onclick="toggle('.$i[5].');"> <img src="../imgs/toggle-off-solid.svg" class="toggle"></td>');
                        } else {
                          echo('<td class="text-center align-middle" id="'.$i[5].'" onclick="toggle('.$i[5].');"> <img src="../imgs/toggle-on-solid.svg" class="toggle"></td>');
                        }
                        
                          
                          echo('<td class="text-center align-middle"><div class="btn-group align-top">
                              <button onclick="cDatos('.$i[5].')" class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Editar</button><button class="btn btn-sm btn-outline-secondary badge" type="button" id="b'.$i[5].'" ><i class="fa fa-trash" id="'.$i[5].'" onclick="borrar('.$i[5].')"></i></button></div></td></tr>');
                          
                      }

                      if ($pasar != 1) {
                        echo('<script> window.location.href = "err/nopermise.php"</script>');
                      }
                  ?>
                  
                    
                    
                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-3 mb-3" style="width: 25%;">
        <div class="card">
          <div class="card-body">
            <div class="text-center px-xl-3">
              <button onclick="cDatos('no')" class="btn btn-success btn-block" type="button" data-toggle="modal" data-target="#user-form-modal" style="white-space: normal;" >Nuevo Usuario</button>
            </div>
            
            
            
            <hr class="my-3">
            <div class="">
              <label>Admin:</label>
              <p> <?php 

                function sacarDatos($dato)
                {
                  global $mysqli;
                  $stmt = $mysqli->prepare("SELECT ".$dato." from usuarios WHERE id = ?");
                      $stmt->bind_param("s", $_SESSION["id"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $row = $result->fetch_array(MYSQLI_ASSOC);
                  return $row[$dato];
                }
                
                echo('<ul class="ldere"><li>Username: '.sacarDatos("username").'</li>');
                echo('<li font-weight="bold">Nombre: </li>');
                echo('<li>'.sacarDatos("nombre").'</li>');
                echo("</ul>");
              ?></p>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function comprobar(valor, tipo) {
    var tipo = tipo;
    function responseD(data) {
        if (data != 0) {
                document.getElementById(tipo).style.borderColor = "#dc3545";
                document.getElementById(tipo).style.backgroundImage = "url(../imgs/descarga1.svg)";
                document.getElementById(tipo).style.paddingRight = "calc(1.5em + .75rem)";
                document.getElementById(tipo).style.backgroundRepeat = "no-repeat";
                document.getElementById(tipo).style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
                document.getElementById(tipo).style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
                //document.getElementById("valid-"+tipo).style.display = "none";
                //document.getElementById("invalid-"+tipo).style.display = "block";
            }else{
                document.getElementById(tipo).style.borderColor = "#198754";
                document.getElementById(tipo).style.backgroundImage = "url(../imgs/descarga.svg)";
                document.getElementById(tipo).style.paddingRight = "calc(1.5em + .75rem)";
                document.getElementById(tipo).style.backgroundRepeat = "no-repeat";
                document.getElementById(tipo).style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
                document.getElementById(tipo).style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
                // document.getElementById("valid-"+tipo).style.display = "block";
                // document.getElementById("invalid-"+tipo).style.display = "none";
              
      }}
    if (tipo == "usuario") {
      //var pasar = {"us": valor}
      axios({
      method: 'post',
      url: 'existe.php',
      data: {
        us: valor,
      }
      }).then(function (response) {
        //console.log(response.data);
        responseD(response.data);
      });
      
    } else {
      //var pasar = {"ma": valor}
      axios({
      method: 'post',
      url: 'existe.php',
      data: {
        ma: valor,
      }
      }).then(function (response) {
        responseD(response.data);
      });
    }
    //var contra = valor;
    //console.log(valor)
      
  }
    </script>
    <!-- User Form Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal" style="height: 800px;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Datos Usuario</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="py-1">
              
              <form class="form" id="form-usuario" method="post" action="crud.php">
                      
                  
              </form>

            <script>
              function exito() {
                window.location.href = "vuelta2.php";
              } 	
              function error() {
                window.location.href = "../err/vuelta2.php";
              }
              
            </script>
        <?php
         require_once("conectar.php");
        if (isset($_POST["registrar"])) {
          try {
            $usuario = $_POST['usuario'];
            $password = $_POST['pass'];
            $email = $_POST['email'];
            $pasar = 0;
            $nombre = $_POST['nombre'];
            $admin = "0";
            //echo var_dump($password);
            $hashPassword = password_hash($password,PASSWORD_DEFAULT,['cost' => 5]); 
            $stmt = $mysqli->prepare("INSERT INTO usuarios(username, password, email, rol, nombre) VALUES (?, ?, ?,?, ?)");
            $stmt->bind_param("sssss", $usuario, $hashPassword, $email, $admin, $nombre);
            $stmt->execute();

            $stmt = $mysqli->prepare("call fechaHoyLogin(?)");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();

            echo('<script>exito()</script>');
          } catch (mysqli_sql_exception $e) {
            echo var_export($e);
            //echo var_export($_POST);
            echo "<br>";
            echo "<h3> Error en resgistro.</h3>";
            echo "<p> Algún dato introducido es incorrecto</p>";
            echo "<script> window.location.href = 'crud.php?error=true' </script>";
          } catch (customException $e){
              echo('<script>error()</script>');
              echo "<script> window.location.href = 'crud.php?error=true' </script>";
          }
           
        }else{
              if (isset($_POST['name']) && $_POST['name'] != "") {
                $stmt = $mysqli->prepare("UPDATE usuarios set nombre = ? WHERE id = ?");
                $stmt->bind_param("ss", $_POST["name"],$_POST["id"]);
                $stmt->execute();
                echo "<sript>exito('username')</sript>"; 
              }
              if (isset($_POST['username']) && $_POST['username'] != "") {
                try { 
                  $stmt = $mysqli->prepare("UPDATE usuarios set username = ? WHERE id = ?");
                  $stmt->bind_param("ss", $_POST["username"],$_POST["id"]);
                  $stmt->execute();
                  echo "<script>exito('username')</script>";
                }catch (mysqli_sql_exception $e){
                  echo "<script> window.location.href = 'crud.php?error=true' </script>";
                }
              }
              if (isset($_POST['email']) && $_POST['email'] != "") {
                try { 
                  $stmt = $mysqli->prepare("UPDATE usuarios set email = ? WHERE id = ?");
                  $stmt->bind_param("ss", $_POST["email"],$_POST["id"]);
                  $stmt->execute();
                  echo "<script>exito('email')</script>";
                }catch (mysqli_sql_exception $e){
                  echo "<script> window.location.href = 'crud.php?error=true' </script>";
                }
              }

              if (isset($_POST['password']) && $_POST['password'] != "") {
                $pass = password_hash($_POST['password'],PASSWORD_DEFAULT,['cost' => 5]);
                $stmt = $mysqli->prepare("UPDATE usuarios set password = ? WHERE id = ?");
                $stmt->bind_param("ss", $pass,$_POST["id"]);
                $stmt->execute();
                echo "<script>exito('password')</script>";
              }
              if (isset($_POST['avatar']) && $_POST['avatar'] != "") {
                $stmt = $mysqli->prepare("UPDATE usuarios set avatar = ? WHERE id = ?");
                $stmt->bind_param("ss", $_POST["avatar"],$_POST["id"]);
                $stmt->execute();
                echo "<script>exito('avatar')</script>";
              }
        }
        ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<style type="text/css">
body{
    margin-top:20px;
    background:#f8f8f8
}
</style>

<script type="text/javascript">

</script>
</body>
</html>
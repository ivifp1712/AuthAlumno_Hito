<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Alumno - Mis Datos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="shortcut icon" href="../imgs/icon.png" type="image/x-icon">

</head>
<body>
<?php
    session_start();
    //echo $_SESSION["user"];
    //echo session_id();
    
	require_once ("conectar.php");
	echo "<br/>";
	$_SESSION["user"] = sacarDatos("username");
  $_SESSION["rol"] = sacarDatos("rol");
  if (isset($_COOKIE["exito"]) and $_COOKIE["exito"] == 1) {
    setcookie('exito','',time()-100);
    $exito = 1;
  }

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
  }
            
	//echo $_SERVER['REMOTE_ADDR'];
	//echo $_SESSION["user"];
	// ::1 == localhost

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
	function mes($mes)
	{
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $meses[intval($mes)-2];
	}
?>
<script>
  function borrar(v){
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<?php
require_once("nav.php");
?>
<style>

   nav{
            margin-top: -50px;
            margin-bottom: 50px;
            /* margin-left: -25px;
            
            background-color: black;
            width: 90;
            padding: 25px; */
        } 
  body{
    margin-bottom: 0;
    background-image: url('../imgs/fondo.jpg') !important;
    background-repeat: no-repeat;
    background-size: cover !important;
    backdrop-filter: blur(3px);
  }
</style>
<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
    <div class="card p-3">
      <div class="e-navlist e-navlist--active-bg">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link px-2 active" href="#"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Mis Datos</span></a></li>
		<?php
			$rol = sacarDatos("rol");
			if ($rol =="1") {
				echo '<li class="nav-item"><a class="nav-link px-2" href="crud.php" target="__blank"><i class="fa fa-fw fa-cog mr-1"></i><span>Administrador</span></a></li>';
				// comprobacion en remitente
			}
		?>
          
        </ul>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body" id="datos">
            
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px; background-color:transparent;">
				  <script>
							function quitarFto(s) {
                if (s == "imgs/perfil.png") {
                  document.getElementById("fto-div").innerHTML = '<img src="../'+s+'" alt="Foto Usuario" style="width: 140px; height: 140px; border-radius:75%" id="fto-usuario">'

                }else{
                  document.getElementById("fto-div").innerHTML = '<img src="'+s+'" alt="Foto Usuario" style="width: 140px; height: 140px; border-radius:75%" id="fto-usuario">'
                }
							}
						</script>
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px;" id="fto-div">
						
					  <?php 
					  	$foto = sacarDatos("avatar");
						if (sacarDatos("avatar") == 0){
							echo '<script>quitarFto("https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png")</script>';
						} else{
							echo '<script>quitarFto("'.$foto.'")</script>';
							
						}
						if (isset($_POST["url"])) {
							$stmt = $mysqli->prepare("UPDATE usuarios set avatar = ? WHERE username = ?");
							$stmt->bind_param("ss", $_POST["url"],$_SESSION["user"]);
							$stmt->execute();
							echo '<script>quitarFto("'.$_POST["url"].'")</script>';
						}
					 
					 
					 
					 ?>
                      
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">
						<?php
							$nombre = sacarDatos("nombre");
							echo sacarDatos("nombre");
						?>
					</h4>
                    <p class="mb-0">@<?php
							$username = sacarDatos("username");
							echo sacarDatos("username");
						?></p>
                    <div class="text-muted"><small></small></div>
					<script>
							function foto() {
								document.getElementById("change-photo").innerHTML = `
								<form method="post" action="alumno.php">
									<input class="form-control" type="text" name="url" placeholder="URL de la nueva foto" style="margin-bottom:10px;">
									<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-camera"></i><span>Cambiar</span></button>
								</form>
								`
							}
							function fotoA() {
								document.getElementById("change-photo").innerHTML = '<button class="btn btn-primary" type="button" onclick="foto()"><i class="fa fa-fw fa-camera"></i><span> Cambiar Foto </span></button>'
							}
							 
						</script>
                    <div class="mt-2" id="change-photo">
                      <script>
						  fotoA();
					  </script>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary"><?php
						
						if ($rol == 0) {
							echo "usuario";
						}elseif($rol == 1) {
							echo "admin";
						}
					?></span>
                    <div class="text-muted"><small>
						<?php
						$date = sacarDatos("fechainicio");
						for ($i=0; $i < 8; $i++) { 
							$temp = $date;
							$date = rtrim($date,$date[strlen($date)-1]);
						}
						//echo "Fecha: ".$date;

						if ($date[2] == "2" && $date[3] == "2") {
							echo "Se registró el ".$date[8].$date[9]." de ".mes($date[5].$date[6])." de este año.";
						}else {
							echo "Se registró el ".$date[8].$date[9]." del ".$date[5].$date[6]." en el año ".$date[2].$date[3];

						}
					?>
					</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Datos</a></li>
              </ul>
			  
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" novalidate="" method="post" action="">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Nombre Apellidos</label>
                              <input class="form-control" type="text" name="name" placeholder="<?php echo $nombre; ?>" id="nombre">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Nombre de Usuario</label>
                              <input class="form-control" type="text" name="username" placeholder="<?php echo $username; ?>" id="username">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Correo electrónico</label>
                              <input class="form-control" type="text" placeholder="<?php $email = sacarDatos("email"); echo $email;?>">
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Cambiar contraseña</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Contraseña actual</label>
                              <input class="form-control" type="password" placeholder="••••••" name="password">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Nueva contraseña</label>
                              <input class="form-control" type="password" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
                  <?php
              if (isset($exito) and $exito ==1) {
              echo "<p>Cambio realizado con éxito!</p>";
              $exito = 0;
            }
            ?>
            </div>
            
          </div>
        </div>
        
      </div>

      <div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
          <div class="card-body" style="padding: 15px; ">
            <div class="px-xl-3">
              <form action="alumno.php" method="post" style="margin: 5px;">
                <input type="text" name="logOut" id="" style="display:none;">
                <button class="btn btn-block btn-secondary" type="submit">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
              </button>
              </form>
              <button class="btn btn-block btn-secondary" onclick="<?php echo("borrar('".sacarDatos("id")."')")?>">
                <i class="fa fa-trash"></i>
                  <span style="word-wrap: word-break">Eliminar</span>
                  <br>
                  <span>usuario</span>
              </button>
              <?php
                if (isset($_POST["logOut"])) {
                  session_destroy();
                  echo('<script>	window.location.href = "login.php"; </script>');
                }
               
              ?>
              
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h6 class="card-title font-weight-bold">¿Alguna incidencia?</h6>
            <p class="card-text">Contacta rapidamente con el administrador.</p>
			
            <button type="button" class="btn btn-primary" onclick="window.location.href = `mailto:ivan.gonzalez@campusfp.es`">Enviar correo</button>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</div>
</div>
<script>
	function exito(v) {
		  window.location.href = "vuelta.php";
	}
  function duplicado(){

  }
  function mExito() {
    document.getElementById("datos").innerHTML += "<p>Cambio realizado con éxito</p>";
  }
</script>
<?php
	
	if (isset($_POST['name']) && $_POST['name'] != "") {
		$stmt = $mysqli->prepare("UPDATE usuarios set nombre = ? WHERE username = ?");
		$stmt->bind_param("ss", $_POST["name"],$_SESSION["user"]);
		$stmt->execute();
		echo "<script>exito('name')</script>";
		
	}
	if (isset($_POST['username']) && $_POST['username'] != "") {
		$id = sacarDatos("id");
		$stmt = $mysqli->prepare("UPDATE usuarios set username = ? WHERE id = ?");
		$stmt->bind_param("ss", $_POST["username"],$id);
		$stmt->execute();
		echo "<script>exito('username')</script>";
	}
  if (isset($_POST['password']) && $_POST['password'] != "") {
		$id = sacarDatos("id");
    $pass = password_hash($_POST['password'],PASSWORD_DEFAULT,['cost' => 5]);
		$stmt = $mysqli->prepare("UPDATE usuarios set password = ? WHERE id = ?");
		$stmt->bind_param("ss", $pass,$id);
		$stmt->execute();
		echo "<script>exito('password')</script>";
	}
  
?>

<style type="text/css">
body{
    margin-top:20px;
    background:#f8f8f8
}
</style>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    
    	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" href="index.css">
	<link rel="shortcut icon" href="imgs/icon.png" type="image/x-icon">
    <!-- !-->
</head>
<body>
<?php
	session_start();
    require("nav.php");
	if (isset($_SESSION["user"])) {
		header("Location: alumno.php");
	}
?>
	<style>
		@media screen and (max-height: 900px){
			body{
			height: 900px !important;
		}
		}
		
	</style>
    <!-- Bootstrap login!-->
    <div class="container" style="margin-top: 25px;">
	<div class="d-flex justify-content-center h-100">
		<div class="card" style="height: auto !important;">
			<div class="card-header">
				<h3>Inicio de Sesión</h3>
				
			</div>
			<div class="card-body">
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Usuario" name="user">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Contraseña" name="pass">
					</div>
					<!-- <div class="row align-items-center remember">
						<input type="checkbox" onclick="recordar(this.value)">Recuerdame
					</div> -->
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
                <?php
                    require_once("conectar.php");
                    if (isset($_POST['user'])) {
						session_start();
                        $usuario = $_POST['user'];
                        $password = $_POST['pass'];
                        $options = array("cost"=>4);
                        //$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
                        //echo $usuario;
                        //echo $hashPassword;
                        $stmt = $mysqli->prepare("SELECT password from usuarios WHERE username = ?");
                        $stmt->bind_param("s", $usuario);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        //echo ($row["password"]);
                        //echo $row["password"];
                        if (!isset($row["password"]) || !password_verify($password, $row["password"])) {
                            echo '<h3 class="card-header" style="color:red;">El usuario y contraseña no coinciden.</h3>';
                        } else {
							$stmt = $mysqli->prepare("SELECT id from usuarios WHERE username = ?");
							$stmt->bind_param("s", $usuario);
							$stmt->execute();
							$result = $stmt->get_result();
							$row = $result->fetch_array(MYSQLI_ASSOC);
							$_SESSION["id"] = $row["id"];
							//echo $_SESSION["user"];
							echo("<script> window.location.href = 'alumno.php'</script>");
                            //header("Location: alumno.php");
							
                        }
                    }
            
            ?>
            <div class="card-footer">
				<div class="d-flex justify-content-center links">
					No tienes cuenta?<a href="signup.php">Registrate ahora!</a>
				</div>
			</div>
			</div>
            

			
		</div>
	</div>
</div>
</body>
</html>
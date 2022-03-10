<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno - Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/d70d441cb5.js" crossorigin="anonymous"></script>
<link rel="shortcut icon" href="imgs/icon.png" type="image/x-icon">

</head>
<body>
  <?php
    require_once("nav.php");
    session_start();
    session_destroy();
    session_start();
  ?>
<style>
  section{
    margin-top: 0px;
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.0.js""></script>
<script>
  function comprobar(valor, tipo) {
    
    if (tipo == "usuario") {
      var pasar = {"us": valor}
      
    } else {
      var pasar = {"ma": valor}
    }
    var contra = valor;
    //console.log(valor)
    let request = $.ajax({
        url: "existe.php",
        type: "post",
        data: pasar,
        success: function(data){
            //console.log(data);
            if (data != 0) {
              document.getElementById(tipo).style.borderColor = "#dc3545";
              document.getElementById(tipo).style.backgroundImage = "url(imgs/descarga1.svg)";
              document.getElementById(tipo).style.paddingRight = "calc(1.5em + .75rem)";
              document.getElementById(tipo).style.backgroundRepeat = "no-repeat";
              document.getElementById(tipo).style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
              document.getElementById(tipo).style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
              document.getElementById("valid-"+tipo).style.display = "none";
              document.getElementById("invalid"+tipo).style.display = "block";
          }else{
              document.getElementById(tipo).style.borderColor = "#198754";
              document.getElementById(tipo).style.backgroundImage = "url(imgs/descarga.svg)";
              document.getElementById(tipo).style.paddingRight = "calc(1.5em + .75rem)";
              document.getElementById(tipo).style.backgroundRepeat = "no-repeat";
              document.getElementById(tipo).style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
              document.getElementById(tipo).style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
              document.getElementById("valid-"+tipo).style.display = "block";
              document.getElementById("invalid-"+tipo).style.display = "none";
            }}
})
}
function repetir(v){
    if (contra == v) {
      document.getElementById("pass2").style.borderColor = "#198754";
              document.getElementById("pass2").style.backgroundImage = "url(imgs/descarga.svg)";
              document.getElementById("pass2").style.paddingRight = "calc(1.5em + .75rem)";
              document.getElementById("pass2").style.backgroundRepeat = "no-repeat";
              document.getElementById("pass2").style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
              document.getElementById("pass2").style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
              document.getElementById("valid-pass").style.display = "block";
              document.getElementById("invalid-pass").style.display = "none";
    }else{
              document.getElementById("pass2").style.borderColor = "#dc3545";
              document.getElementById("pass2").style.backgroundImage = "url(imgs/descarga1.svg)";
              document.getElementById("pass2").style.paddingRight = "calc(1.5em + .75rem)";
              document.getElementById("pass2").style.backgroundRepeat = "no-repeat";
              document.getElementById("pass2").style.backgroundPosition = "right calc(0.375em + 0.1875rem) center"; 
              document.getElementById("pass2").style.backgroundSize = "calc(.75em + .375rem) calc(.75em + .375rem)";
              document.getElementById("valid-pass").style.display = "none";
              document.getElementById("invalid-pass").style.display = "block";
    }
}
</script>
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: -100px !important">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Crear usuario!</p>

                <form class="mx-1 mx-md-4" method="post" action="signup.php">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Nombre de Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" onkeyup="comprobar(this.value, 'usuario');"required>
                        <div class="valid-feedback" id="valid-usuario">
                          Nombre de usuario válido!
                        </div>
                        <div class="invalid-feedback" id="invalid-usuario">
                          Nombre de usuario registrado!
                        </div>
                        <label class="form-label" for="form3Example1c" style="margin-top:5px;">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" onkeyup="comprobar(this.value, 'email');"required>
                        <div class="valid-feedback" id="valid-mail">
                          Nombre de email válido!
                        </div>
                        <div class="invalid-feedback" id="invalid-mail">
                          Nombre de email registrado!
                        </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Contraseña</label>
                      <input type="password" id="form3Example4c" class="form-control" name="pass" required/>
                      <label class="form-label" for="form3Example4c">Repetir Contraseña</label>
                      <input type="password" id="pass2" class="form-control" name="pass2" required/>
                      <div class="valid-feedback" id="valid-pass">
                          Contraseña válida!
                        </div>
                        <div class="invalid-feedback" id="invalid-pass">
                          No se repite la contraseña!
                        </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="registrar" value="1">Registrarse</button>
                  </div>

                </form>
                <div id="invisible">

                </div>
            <?php

            require_once("conectar.php");
            //echo var_dump($_POST);
            if (isset($_POST['registrar'])) {
                    try {
                      $usuario = $_POST['usuario'];
                      $pasar = 0;
                      for ($i = 0;$i < strlen($usuario) ;$i++){
                        if ($usuario[$i] != " ") {
                          $pasar = 1;
                        }
                      }
                      if ($pasar != 1) {
                        // Lanza una excepción si el usuario no es válido
                        throw new mysqli_sql_exception();
                      }
                      $password = $_POST['pass'];
                      $rpassword = $_POST['pass2'];
                      if ($password != $rpassword) {
                        throw new mysqli_sql_exception();
                      }
                      $email = $_POST['email'];
                      if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
                        // Lanza una excepción si el email no es válido
                        throw new mysqli_sql_exception();
                      }
                      $nombre = $_POST['nombre'];
                      $admin = "0"; // automaticamente registra en user
                      //echo var_dump($password);
                      $hashPassword = password_hash($password,PASSWORD_DEFAULT,['cost' => 5]); 
                      $stmt = $mysqli->prepare("INSERT INTO usuarios(username, password, email, rol, nombre) VALUES (?, ?, ?,?, ?)");
                      $stmt->bind_param("sssss", $usuario, $hashPassword, $email, $admin, $nombre);
                      $stmt->execute();

                      $stmt = $mysqli->prepare("call fechaHoyLogin(?)");
                      $stmt->bind_param("s", $usuario);
                      $stmt->execute();
                        
                      $_SESSION["user"] = $usuario;
                      echo "<br><h3> Usuario registrado con éxito.</h3>";
                      echo "<br><h4> Redirigiendo a login...</h4>";
                      
                      echo '<script>setTimeout(function h(){window.location.href = "login.php"}, 3000) </script>';

                    } catch (mysqli_sql_exception $e) {
                      //echo var_export($e);
                      //echo var_export($_POST);
                      echo "<br>";
                      echo "<h3> Error en resgistro.</h3>";
                      echo "<p> Algún dato introducido es incorrecto</p>";
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
</section>
</body>
</html>
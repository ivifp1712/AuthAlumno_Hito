<?php
class AlumnoController
{
    //atributos de clase
    
    //constructor
    function __construct(){

    }
    //getters and setters

    //resto de metodos - implementa de APIService(CRUD)
    function index()
    {
        require_once("Views/Alumno/bienvenido.php");
    }
    function register()
    {
        Alumno::register();
    }
    function save()
    {
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
            //$admin = "0"; // automaticamente registra en user
            //echo var_dump($password);
            
              
            $_SESSION["user"] = $usuario;
            $alumno = new Alumno(NULL, $usuario, $nombre, $email, "imgs/perfil.png", $password, 0);
            Alumno::save($alumno);
            echo "<br><h3> Usuario registrado con éxito.</h3>";
            echo '<br><h4> Acceder a <a href="index.php?controller=alumno&&action=login">Login</a></h4>';

          } catch (mysqli_sql_exception $e) {
            //echo var_export($e);
            //echo var_export($_POST);
            echo "<br>";
            echo "<h3> Error en resgistro.</h3>";
            echo "<p> Algún dato introducido es incorrecto</p>";
          } catch (PDOException $a){
            echo "<br>";
            echo "<h3> Error en resgistro.</h3>";
            echo "<p> Algún dato introducido es incorrecto</p>";
          }
         
        //$alumno = new Alumno(NULL, 'juan', 'lopez', 'true');
    }
    function show()
    {
        Alumno::show();
    }

    function error()
    {
      header("Location: Views/err/nopermise.php");
    }

    function login()
    { 
        require_once("Views/Alumno/login.php");
        //echo $_SESSION['id'];
        if (isset($_SESSION['id'])) {
            echo '<script>window.location.href= "index.php"</script>';
        }
        if (isset($_POST['login'])) {
            Alumno::existe(array($_POST['username'],$_POST['pass']));
        }
        
    }
    function logout()
    {
      unset($_SESSION['id'], $_SESSION['username'], $_SESSION['rol']);
      header("Location: index.php");
      // echo "<script>window.location.href = index.php;</script>";
    }

    function redirect(){
        
        header("Location: index.php");
    }
    function update(){
        //echo "funciona";
        //var_dump ($_POST);
        Alumno::update($_POST);
        header("Location: index.php?controller=alumno&&action=show");
    }
    function showI(){
        require_once("Views/Alumno/showI.php");
    }
    function delete(){
      if (isset($_POST['id'])) {
        echo ('<form action="?controller=alumno&&action=delete" method="post" style="background-color:white; margin: 25px; padding: 25px; border: 1px solid black; border-radius: 20px"> <label> ¿Estas seguro de que quieres eliminar esta cuenta?</label><button type="submit" class="btn btn-success" name="confirmar" value="si">Continuar...</button><input type="hidden" name="id" value="'.$_POST['id'].'"></form>');
      }else{
        echo '<form action="?controller=alumno&&action=delete" method="post" style="background-color:white; margin: 25px; padding: 25px; border: 1px solid black; border-radius: 20px"> <label> ¿Estas seguro de que quieres eliminar esta cuenta?</label><button type="submit" class="btn btn-success" name="confirmar" value="si">Continuar...</button><input type="hidden" name="id" value="'.$_SESSION['id'].'"><input type="hidden" name="auto" value="si"></form>';
      }

      if (isset($_POST['confirmar']) && $_POST['confirmar'] == 'si') {
        $id = $_POST['id'];
        Alumno::delete($id);
        if (isset($_POST['auto'])) {
          session_destroy();
          session_start();
          header("Location: index.php");
        }else{
          header("Location: index.php?controller=alumno&&action=show");
        }
        //echo ($id);
      }
    }
    
}// cierra clase

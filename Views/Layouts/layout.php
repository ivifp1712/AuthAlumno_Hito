<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d70d441cb5.js" crossorigin="anonymous"></script>
    <style>
        body{
            margin: 25px;
        }
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
        @import url('https://fonts.googleapis.com/css?family=Numans');
        html,body{
            font-family: 'Numans', sans-serif;
        }
        body { 
            margin: 0;
            height: 100%;
        }
        nav{
            background-color: black;
            padding: 25px;
            height: auto;
        }
        nav a {
            text-decoration: none;
            color: white;
            margin: 25px;
           
            font-size: 15px;
        }
        .login{
            float: right;
            margin-right:15px;
            
        }
        html{
            height: 100%;
        }
        body{
            background-image: url("imgs/fondo.jpg"), url("imgs/fondo.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            display: block;
            height: 100%;
        }
        #sesion{
            color: white;
        }
        a:hover{
            color:red;
        }
        .perfil{
            width: 50px;
        }
        @media screen and (max-width: 900px) {
            .login{
                float: right;
                margin-top: -40px;
        }
        }
    </style>
    <nav>
        <img src="imgs/icon.png" style="width: 75px;">
        <a href="index.php">Inicio</a>
        <?php
            if (isset($_SESSION["username"])) {
                echo('<a href="?controller=alumno&&action=showI">Alumno</a>');
            }else{
                echo('<a href="?controller=alumno&&action=register">Registrarse</a><a href="?controller=alumno&&action=login">Log In</a>');
            }
            if (isset($_SESSION["rol"]) && $_SESSION['rol'] == 1) {
                echo '<a href="?controller=alumno&&action=show">Administrador</a>';
            }
        ?>   
        <div class="login">
            <?php
           
            if (isset($_SESSION["username"] )&& isset($_SESSION["id"])) {
                //var_dump($_SESSION["username"]);
                require_once("connection.php");
                $mysqli = Db::getConnect();
                function sacarDatoss($dato)
                {
                    global $mysqli;
                    $stmt = $mysqli->prepare("SELECT ".$dato." from usuarios WHERE id = :id");
                    $stmt->bindValue(":id", $_SESSION["id"]);
                    $stmt->execute();
                    $row = $stmt->fetch(MYSQLI_ASSOC);
                    return $row[$dato];
                }
                echo('<div>');
                if (sacarDatoss("avatar") == "imgs/perfil.png") {
                    echo('<img src="../'.sacarDatoss("avatar").'" class="login perfil">');
                }else{
                    echo('<img src="'.sacarDatoss("avatar").'" class="login perfil">');
                }
                echo('<p class="login" style = "color:red; height: 50px">Hi, '.sacarDatoss("username").'!');
                echo('<button class="btn btn-block btn-secondary logout" id="logOut" style="width: 100px; margin: 5px;"><i class="fa fa-sign-out"></i><span>Logout</span></button>');
                echo("</div>");
                echo('<script>document.getElementById("logOut").addEventListener("click", function(e) {console.log("logOUT");window.location.href = "?controller=alumno&&action=logout";})</script>');
                

            }else{
                echo('<button class="btn btn-success btn-block" id="login"> Log In </button> ');
                echo(' <script>document.getElementById("login").addEventListener("click", function(e) {window.location.href = "?controller=alumno&&action=login";})</script> ');
            }
            ?>
        </div>
    </nav>

    <script>
        
        
        
        
    </script>
    <?php
    require_once('routing.php');
    ?>
</body>
</html>
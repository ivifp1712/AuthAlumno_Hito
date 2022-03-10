<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
            height: 10%;
        }
        nav a {
            text-decoration: none;
            color: white;
            margin: 25px;
           
            font-size: 15px;
        }
        .login{
            float: right;
            margin: 20px;
            margin-top:5px;
        }
        body{
            background-image: url("../imgs/fondo.jpg"), url("./imgs/fondo.jpg");
            background-repeat: no-repeat;
            background-size: cover;
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
            if (isset($_SESSION["user"])) {
                echo('<a href="alumno.php">Alumno</a><a href="crud.php">Administrador</a>');
            }else{
                echo('<a href="signup.php">Registrarse</a><a href="login.php">Log In</a>');
            }
        ?>   
        <div class="login">
            <?php
           
            if (isset($_SESSION["user"])) {
                require_once("conectar.php");
                function sacarDatoss($dato)
                {
                    global $mysqli;
                    $stmt = $mysqli->prepare("SELECT ".$dato." from usuarios WHERE id = ?");
                    $stmt->bind_param("s", $_SESSION["id"]);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    return $row[$dato];
                }
                echo('<div>');
                echo('<img src="'.sacarDatoss("avatar").'" class="login perfil">');
                echo('<p class="login" style = "color:red; height: 50px">Hi, '.sacarDatoss("username").'!');
                echo('<button class="btn btn-block btn-secondary logout" id="logOut" style="width: 100px"><i class="fa fa-sign-out"></i><span>Logout</span></button>');
                echo("</div>");
                echo('<script>document.getElementById("logOut").addEventListener("click", function(e) {console.log("logOUT");window.location.href = "logout.php";})</script>');
                

            }else{
                echo('<button class="btn btn-success btn-block" id="login"> Log In </button> ');
                echo(' <script>document.getElementById("login").addEventListener("click", function(e) {window.location.href = "login.php";})</script> ');
            }
            ?>
        </div>
    </nav>

    <script>
        
        
        
        
    </script>
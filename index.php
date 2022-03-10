<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="imgs/icon.png" type="image/x-icon">
</head>
<body>
    <?php
        session_start();
        require("nav.php");
    ?>
    <style>
        .welcome{
            display: block;
            position: abosolute;
            margin-top: 20%;
            color: white;
            text-align: center;
        }
        .welcome h1{
            font-size: 75px;
        }
        .logout{
            margin: 20px;
        }
    </style>
    <div class="welcome">
        <h1> Welcome </h1>
    </div>
</body>
</html>
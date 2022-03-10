<?php
   if (isset($_POST["us"])) {
    require_once("conectar.php");
    $us = $_POST["us"];
    $pasar = 0;
    for ($i = 0;$i < strlen($us) ;$i++){
       if ($us[$i] != " ") {
           $pasar = 1;
       }
       }
    if ($pasar != 1) {
        echo("NO");
    }
    $stmt = $mysqli->query("call comprobar('$us')");
    echo ($stmt->num_rows);
}

    if (isset($_POST["ma"])) {
        
        require_once("conectar.php");
        $ma = $_POST["ma"];
        if(filter_var($ma, FILTER_VALIDATE_EMAIL) === FALSE) {
            // Lanza una excepción si el email no es válido
            echo("NO");
        }
        $stmt = $mysqli->query("call comprobarEmail('$ma')");
        echo ($stmt->num_rows);
}
?>

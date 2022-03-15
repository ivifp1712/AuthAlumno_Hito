<?php
session_start();
session_destroy();
//echo(var_export($_SESSION));
echo('<script>window.location.href = "../index.php";</script>');
?>
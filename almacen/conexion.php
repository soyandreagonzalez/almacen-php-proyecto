<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
  $Host= "localhost";
  $Usuario= "root";
  $Pass= "";
  $Base= "Almacen";
  $Conexion= new mysqli($Host,$Usuario,$Pass,$Base);
    if ($Conexion->connect_error) {
        echo "Error de conexión";
        exit();
    }
?>
</body>
</html>

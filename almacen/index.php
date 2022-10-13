<!DOCTYPE html>
<html>
<head>
	<title>Probando</title>
	<script src="jquery.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="formulario">
    <form  method="POST" class="form-interno">

        Artículos <input type="text" name="Art" id="Art">
        <br> <br>

        Id <input type="text" name="Id" id="Id">
        <br> <br>

        Nombre <input type="text" name="Nom" id="Nom">
        <br> <br>

        Proveedor <input type="text" name="Prov" id="Prov">
        <br> <br>

        <input type="submit" value ="Registrar" name="btn-registrar">
        <br> <br>
        <input type="submit" value ="Buscar" name="btn-buscar">
        <br> <br>
        <input type="submit" value ="Actualizar" name="btn-actualizar">
        <br> <br>
        <input type="submit" value ="Eliminar" name="btn-eliminar">
    


    <?php

    include('conexion.php');
    $Art="";
    $Id="";
    $Nom="";
    $Prov="";
    if(isset($_POST["btn-registrar"])){
    $Art=$_POST['Art'];
    $Id=$_POST['Id'];
    $Nom=$_POST['Nom'];
    $Prov=$_POST['Prov'];

    if($Art==""||$Id==""||$Nom==""||$Prov==""){
        echo"campos obligatorios";
    }else{
        $result=$conexion->prepare("insert into datos(Articulos,Id,Nombre,Proveedor)value(?,?,?,?);");
        $result->bind_param("siss",$Art,$Id,$Nom,$Prov);
    }$result->execute();
    }

    if(isset($_POST['btn-buscar'])){   
        $doc=$_POST['Id'];
        $existe=0;
        if($Id==""){
        echo"campos vacios";
        }else{
            $resultado=mysqli_query($conexion,"select*from datos where Id='$Id'");
            while($consulta=mysqli_fetch_array($resultado)){
                $consultaArt = $consulta['Articulos'];
                $consultaId = $consulta['Id'];
                $consultaNom = $consulta['Nombre'];
                $consultaProv = $consulta['Proveedor'];
                echo "<script> 
                document.getElementById('Articulos').value = `{$consultaArt}`
                document.getElementById('Id').value =`{$consultaId}`
                document.getElementById('Nombre').value =`{$consultaNom}`
                document.getElementById('Proveedor').value =`{$consultaProv}`</script>";
            $existe++;
            }                              
        }   
    }
    if(isset($_POST["btn-actualizar"])){

        $Art=$_POST['Articulos'];
        $Id=$_POST['Id'];
        $Nom=$_POST['Nombre'];
        $Prov=$_POST['Proveedor'];
        
        if($Art==""||$Id==""||$Nom==""||$Prov==""){
            echo"campos obligatorios";
        }else{
            $existe=0;
            $resultado=mysqli_query($conexion,"SELECT * FROM datos where Id='$Id'");
            while($consulta=mysqli_fetch_array($resultado))
            {
                $existe++;
            }
        if($existe==0){
            echo "El documento no existe";
        }else{
            $_UPDATE_SQL="UPDATE datos SET
            Articulos='$Art',
            Id='$Id',
            Nombre='$Nom',
            Proveedor='$Prov'
            WHERE Id='$Id'";
            mysqli_query($conexion,$_UPDATE_SQL);
            }
        }
    }

    if(isset($_POST["btn-eliminar"])){
        $Id=$_POST['Id'];
        $existe=0;
        if($Id==""){
            echo"Debes escribir el documento";
        }else{
            $resultado=mysqli_query($conexion,"SELECT*FROM datos where Id='$Id'");
            while($consulta=mysqli_fetch_array($resultado))
            {
                $existe++;
            }
            if($existe==0){
                echo "El documento no existe";
            }else{
                $_DELETE_SQL="DELETE FROM datos WHERE Id='$Id'";
                mysqli_query($conexion,$_DELETE_SQL);
            }
        }
    }
    ?> 
</body>
</html>
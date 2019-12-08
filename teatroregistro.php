<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro Teatro</title>
</head>
<body>
    <?php
        $conexion = new mysqli('localhost','root','picopalo','teatro');

        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = sha1($_POST['password']);

            $sql = "INSERT INTO usuarios(usuario,contrasena) VALUES('$user','$password')";
            mysqli_query($conexion,$sql);

            header("Location:teatrologin.php");
           
        }
    ?>
    <img src="imagenes/logo-teatro.jpg" alt="logo" />
    <h1>Registrarme</h1>
    <form name="formulario" action="teatroregistro.php" method="post">
        <span>Usuario:</span> 
        <input type="text" name="user" value="<?php if(isset($_POST['user'])) echo $_POST['user'];?>"/>
        <?php if(isset($_POST['enviar']) && empty($_POST['user'])) echo "<span style='color:red'>¡Debes introducir un nombre de usuario!</span>";?>
        <br>
        <span>Contraseña:</span>
        <input type="text" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>" />
        <?php if(isset($_POST['enviar']) && empty($_POST['password'])) echo "<span style='color:red'>¡Debes introducir una contraseña!</span>";?>
        <br>
        <input type="submit" value="Registrarme" name="enviar" />
    </form>
    <p><a href="teatrologin.php">¡Ya estoy registrad@!</a></p>
</body>
</html>
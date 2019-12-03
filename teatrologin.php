<?php
    session_start();
    if(!empty($_POST['userid']) && !empty($_POST['password']))
    {
        $userid = $_POST['userid'];
        $password = sha1($_POST['password']);
        
        $conexion = new mysqli('localhost','root','picopalo','teatro');
        $sql = "SELECT * FROM  usuarios WHERE usuario='$userid' AND contrasena='$password'";
        $consulta = $conexion->query($sql);

        $resultado = $consulta->fetch_assoc();
        if($resultado != null)
        {
            $_SESSION['user'] = $resultado['usuario'];
            header("Location:teatropagina.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <img src="imagenes/logo-teatro.jpg" alt="logo" />
    <h1>Login</h1>
   <?php 
        if(isset($_SESSION['user']))
        {
            header("Location:teatropagina.php");
        } 
        else 
        { 
            if(isset($userid)){
                echo "<span style='color:red'>Datos incorrectos. Prueba de nuevo.</span>";
            } else{
                echo "<span style='color:blue'>Introduce tus credenciales para entrar</span>";
            }
            ?>
        <form action="teatrologin.php" method="post">
            <span>Usuario:</span>
            <input type="text" name="userid" value="<?php if(isset($_POST['userid'])) echo $_POST['userid'];?>"/>
            <?php if(empty($_POST['userid']) && isset($_POST['enviar'])) echo "<span style='color:red'>¡Debes introducir un nombre de usuario!</span>";?>
            <br>
            <span>Contraseña:</span>
            <input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"/>
            <?php if(empty($_POST['password']) && isset($_POST['enviar'])) echo "<span style='color:red'>¡Debes introducir una contraseña!</span>";?>
            <br>
            <input type="submit" value="Entrar" name="enviar" />
        </form>
    <?php
        }
    ?>
    <p>¿Aún no te has registrado? <a href="teatroregistro.php">¡Regístrate!</a></p>
</body>
</html>

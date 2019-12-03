<?php
    session_start();
    $conexion = new mysqli('localhost','root','picopalo','teatro');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teatro</title>
</head>
<body>
    <img src="imagenes/logo-teatro.jpg" alt="logo" />
    <p>¡Bienvenido, <b><?php echo $_SESSION['user']?></b>! (<a href="teatrologout.php">logout</a>)</p>
    <h1>Comprar Entrada</h1>
<?php
    $selected_val = $_POST['sesiones'];
    if(isset($_POST['cambiar'])){
        
        if($selected_val == "matinal"){

            echo "<h2>Sesion: ". $selected_val ."</h2>";

        } else if($selected_val == "tarde"){

            echo "<h2>Sesion: ". $selected_val ."</h2>";

        } else if($selected_val == "noche"){

            echo "<h2>Sesion: ". $selected_val ."</h2>";

        } 
    }
?>
    <img src="imagenes/escenario.jpg" alt="escenario">
    <br>
<?php
    
    $sql = "SELECT * FROM  sesiones";
    $consulta = $conexion->query($sql);

?>
    <form action="teatropagina.php" method="post">
        <select name="sesiones">
            <option value="matinal" selected="selected">Matinal</option>
            <option value="tarde">Tarde</option>
            <option value="noche">Noche</option>
        </select>
        <input type="submit" value="Seleccionar SESIÓN" name="cambiar" />
    </form>
    
</body>
</html>
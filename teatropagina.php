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
    //sesion sera igual al select
    $_GET['sesion'] = $_POST['sesiones'];
    $tituloSesion = 'matinal'; //titulo default
    if(isset($_POST['cambiar'])){
        //si se completa el form la sesion cambiara
        $tituloSesion = $_GET['sesion'];
        echo "<h2>SESIÓN: ". $tituloSesion ."</h2>";
        
    }else{
        echo "<h2>SESIÓN: ". $tituloSesion ."</h2>";
    }

    $sql = "SELECT disponibilidadSillas FROM sesiones WHERE sesion = '$tituloSesion'";
    $consulta = $conexion->query($sql);
    $sillas = $consulta->fetch_assoc();

    $arraySillas = str_split($sillas['disponibilidadSillas']);
?>
    <img src="imagenes/escenario.jpg" alt="escenario">
    <br>
<?php
    $tipoImg = ''; //tipo de imagen
    $y = 1; //fila
    $posicion = 0; //posicion de la silla
    echo "<table style='border-collapse: collapse; border: none;'>"; //tabla de sillas
    while($y <= 5){
        echo "<tr>";
            $x = 1; //celda
            while($x <= 10){
                //si la posicion del array es 0 la silla estará ocupada
                if($arraySillas[$posicion] == '0'){
                    $tipoImg = "<img src='imagenes/sillaocupada.jpg' alt='ocupada'/>";
                }else { //si no, estará libre
                    $tipoImg = "<a href='teatrocomprada.php?sesion=".$tituloSesion."&fila=".$y."&silla=".$x."&posicion=".$posicion."'><img src='imagenes/sillalibre.jpg' alt='libre'/></a>";
                }
                echo "<td>".$tipoImg."</td>";
                $x++;
                $posicion++;
            }
        echo "</tr>";
        $y++;
    }
    echo "</table>";
?>
    <form action="teatropagina.php?sesion=<?php echo $_GET['sesion'];?>" method="post">
        <select name="sesiones">
            <option value="matinal" <?php if($_GET['sesion'] == 'matinal') echo "selected='selected'";?>>Matinal</option>
            <option value="tarde" <?php if($_GET['sesion'] == 'tarde') echo "selected='selected'";?>>Tarde</option>
            <option value="noche" <?php if($_GET['sesion'] == 'noche') echo "selected='selected'";?>>Noche</option>
        </select>
        <input type="submit" value="Seleccionar SESIÓN" name="cambiar" />
    </form>
    
</body>
</html>
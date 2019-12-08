<?php
    //libreria TCPDF
    include('tcpdf/config/tcpdf_config.php');
    include('tcpdf/tcpdf.php');
    //Creamos el objeto TCPDF
    $entrada = new TCPDF();
    //quitamos la cabecera y el pie del pdf
    $entrada->setPrintHeader(false);
    $entrada->setPrintFooter(false);

    $entrada->Addpage('L','A5');

    $entrada->SetTitle("Entrada TEATRO");
    
    $sesion = $_GET['sesion'];
    $fila = $_GET['fila'];
    $silla = $_GET['silla'];
    
    

    
    $html = '
    <img src="imagenes/ticket1.png" alt="ticket" width="280" height="210" />
    <br>
    <table>
        <tr>
            <td><b>SESIÓN DE TEATRO</b></td>
            <td>'.$sesion.'</td>
        </tr>
        <tr>
            <td><b>FILA</b></td>
            <td>'.$fila.'</td>
        </tr>
        <tr>
            <td><b>SILLA</b></td>
            <td>'.$silla.'</td>
        </tr>
        <tr>
            <td class="doble"><i>Presenta esta entrada en taquilla</i></td>
        </tr>
    </table>
    <style>
        table {
            border-collapse: collapse;
        }
        td,table,tr {
            width: 135px;
            border: 1px solid black;
        }
        .doble{
            width: 270px;
        }
    </style>';          

    $entrada->writeHTML($html, true, false, true, false, '');
    //mostramos el pdf
    $entrada->Output('entradas/entrada.pdf','F');

    header("Location: teatrocomprada.php?sesion=$sesion&fila=$fila&silla=$silla");
?>
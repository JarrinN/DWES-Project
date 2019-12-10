<?php
    include('tcpdf/config/tcpdf_config.php');
    include('tcpdf/tcpdf.php');
   
    $entrada = new TCPDF();
    
    $entrada->setPrintHeader(false);
    $entrada->setPrintFooter(false);

    $entrada->Addpage('L','A5');

    $entrada->SetTitle("Entrada TEATRO");
    
    $nombre = $_GET['nombre'];
    $sesion = $_GET['sesion'];
    $fila = $_GET['fila'];
    $silla = $_GET['silla'];

    $trueFila = $fila + 1;
    $trueSilla = $silla + 1;
    
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
            <td>'.$trueFila.'</td>
        </tr>
        <tr>
            <td><b>SILLA</b></td>
            <td>'.$trueSilla.'</td>
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
    
    $path = "entradas/entrada$nombre.pdf";
    $entrada->writeHTML($html, true, false, true, false, '');
    $entrada->Output($path,'F');

    //---------------------------------------------------------------------------------------------------------------
    //CORREO
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 
    require 'PHPMailer/Exception.php'; 
    require 'PHPMailer/PHPMailer.php'; 
    require 'PHPMailer/SMTP.php'; 


    $mail = new PHPMailer(true);

    $correo = $_POST['email'];

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'javjarrin@gmail.com';                     // SMTP username
        $mail->Password   = 'picopalo99';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('javjarrin@gmail.com', 'Javier Jarrin');
        $mail->addAddress($correo);     // Add a recipient

        // Attachments
        $mail->addAttachment($path);         // Add attachments

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Entrada TEATRO';
        $mail->Body = 'Presente esta entrada en taquilla';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'La entrada ha sido enviada con exito!!';
    } catch (Exception $e) {
        echo "Mensaje NO enviado. Mailer Error: {$mail->ErrorInfo}";
    }
    //Vuelve a la pagina de compra
    header("Location: teatrocomprada.php?sesion=$sesion&fila=$fila&silla=$silla");
?>
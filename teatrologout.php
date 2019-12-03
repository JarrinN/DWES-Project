<?php
    session_start();
    if(isset($_SESSION['user'])){
        $_SESSION = array();
        session_destroy();
    }
    header("Location:teatrologin.php");
?>
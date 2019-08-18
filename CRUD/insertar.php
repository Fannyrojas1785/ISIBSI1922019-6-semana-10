<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        // Se comprueba si ya se habia iniciado la sesion.
        if(isset($_SESSION['usuario'])){
            echo 'Sesion iniciada correctamente.<br />';
            echo 'usuario: '.$_SESSION['usuario'].'<br />';
            echo 'password: '.$_SESSION['password'].'<br />';
        }
        else{
           header("Location:../principal.php");
        }
        ?>
    </body>
</html>

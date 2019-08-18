<?php
	require_once("sesion.class.php");

	$sesion = new sesion();
	
	if( isset($_POST["iniciar"]) )
	{
		
		$usuario = $_POST["usuario"];
		$password = $_POST["contrasenia"];
		
		if(validarUsuario($usuario,$password) == true)
		{			
			$sesion->set("usuario",$usuario);
			
			header("location: ../principal.php");
		}
		else 
		{
			echo "Verifica tu nombre de usuario y contraseña";
		}
	}
	
	function validarUsuario($usuario, $password)
	{
		$conexion = new mysqli("127.0.0.1",'root','','libreria');
		$consulta = "SELECT contrasenia from usuario WHERE nick = '$usuario';";
		
		$result = $conexion->query($consulta);
		
		if($result->num_rows > 0)
		{
			$fila = $result->fetch_assoc();
			if( strcmp($password,$fila["contrasenia"]) == 0 )
				return true;						
			else					
				return false;
		}
		else
				return false;
	}

?>
<html>
<head>
<title>Logeo de registro</title>
 <link type="text/css" href="../css/master2.css" rel="stylesheet" />
   <meta charset="utf-8" />
</head>

<body>
<form name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div>
   <div> <label>Usuario: </label> <input type="text" value= "" name = "usuario"/></div>
    <div><label>Contraseña: </label> <input type="password"   value= "" name = "contrasenia" /></div>
    <div><input type="submit" name ="iniciar" value="Iniciar Sesion"/></div>
	<p><br /><a href="registrousuario.php"> Registrar nuevo</a></p>
  </div>
</form>
</body>
</html>	
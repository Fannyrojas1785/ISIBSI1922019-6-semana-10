<!DOCTYPE html>	
<html lang= "es">
<head>
    <meta charset="utf-8" />
 

		 
    
 <title>Eliminacion de libro</title>
	
    
</head>

<body>
     <section>
        <div id="formulario_registro">
 <?php 
   $id = limpiarData($_GET['id']); 

  
 function limpiarData($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

      
   //-----------------------------------------------------Conexion---------------------------------------------
	if(!($conexion = new mysqli('127.0.0.1', 'root','','libreria')))
	{
		 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
     	 exit();
		 
	}else{ 
	print ("Conexion exitosa!!!"); 
	}
		$consulta = mysqli_query($conexion, "DELETE FROM libro WHERE id = '$id'") or die ("ERROR a eliminar");
mysqli_close($conexion);
?>
<p><br /><a href="../principal.php"> Volver al menú</a></p>
	</body>
</html>
	
	
 <!DOCTYPE html>	
<html lang= "es">
<head>
    <meta charset="utf-8" />
    

 <title>Actualizar</title>
	
    
</head>

<body>
     <section>
        <div id="formulario_registro">
 
 <?php 
 
  
 function limpiarData($data) {	
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


// ---------------------------------------Limpia espacios en blanco y caracteres especiales------------------------------------
				$titulo= limpiarData($_POST['titulo']);
                $autor=limpiarData($_POST['autor']);
			    $editorial=limpiarData($_POST['editorial']);
				$precio=limpiarData($_POST['precio']); 
 
   // ---------------------------------------Validacion Expreciones regulares------------------------------------
   
    function validarNombre($variable,  $pattern){
       if (preg_match($pattern, $variable)) {
            return  	True;
        }
        return  false;
    }
	
   //-----------------------------------------------------Conexion---------------------------------------------
	if(!($conexion = new mysqli('127.0.0.1', 'root','','libreria')))
	{
		 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
     	 exit();
		 
	}else{ 
	print ("<br/><br/>Conexion exitosa!!!"); 
	}
		$sql =  "UPDATE libro SET titulo = '$titulo', autor = '$autor', editorial='$editorial', precio='$precio' WHERE titulo = '$titulo'" ;

	if ($conexion->query($sql) == TRUE) {
    echo "   Se actualizo exitosamente!!";
} else {
    echo  "<br/><br/>Falló la creación de la tabla: (" . $conexion->errno . ") " .$sql . "<br>" . $conexion->error;
}

	
	
	
$conexion->close();

?>

<p><br /><a href="../principal.php"> Volver al menú</a></p>
	</body>
</html>
	
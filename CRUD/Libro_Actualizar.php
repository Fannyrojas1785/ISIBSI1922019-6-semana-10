<!DOCTYPE html>	
<html lang= "es">
<head>
    <meta charset="utf-8" />
    
<link type="text/css" href="../css/master.css" rel="stylesheet" />
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	 <script type="text/javascript" src="../js/principal.js"></script>
	
		 
  <title>Actualizar</title>
	
    
</head>

<body>
    
    <?php  // Inicializamos las variables que se usaran para los campos de texto del formulario.
    
   $id1=$_GET['id'];

   //-----------------------------------------------------Conexion---------------------------------------------
	if(!($conexion = new mysqli('127.0.0.1', 'root','','libreria')))
	{
		 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
     	 exit();
		 
	}else{ 
	print ("<br/><br/>Conexion exitosa!!!"); 
	}


	$consulta = mysqli_query($conexion,"SELECT * from libro WHERE id='$id1'")
	or die ("Error en conexion");


	   while($extraido = mysqli_fetch_array($consulta))
	   {
		    echo '<tr>';
			
	    $titulo=$extraido['titulo'];
		$autor=$extraido['autor'];
		$editorial=$extraido['editorial'];
		$precio=$extraido['precio'];
	   }


//----------------------------------------------------Creo la conexion
        if(isset($_POST['registrar'])){             
           	if(!($conexion = new mysqli('127.0.0.1', 'root','','libreria')))
	{
		 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
     	 exit();
		 
	}else{ 
	print ("<br/><br/>Conexion exitosa!!!"); 
	}
    
         

    // ---------------------------------------Validacion del parte del servidor metodo post------------------------------------
	
	
	// ---------------------------------------Limpia espacios en blanco y caracteres especiales------------------------------------
	 function limpiarData($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	 $titulo=limpiarData($_POST['titulo']);
		$autor==limpiarData($_POST['autor']);
		$editorial==limpiarData($_POST['editorial']);
		$precio==limpiarData($_POST['precio']);
				
				   
	

   // ---------------------------------------Validacion Expreciones regulares------------------------------------
   
    function validarNombre($variable,  $pattern){
       if (preg_match($pattern, $variable)) {
            return  	True;
        }
        return  false;
    }
	
	
	
	
	
     //-------------------------------Comprueba si todos los datos del usuario son validos. si no returna false
       function validarNombre($variable,  $pattern){
       if (preg_match($pattern, $variable)) {
            return  	True;
        }
        return  false;
    }
     //-------------------------------Comprueba si todos los datos del usuario son validos. si no returna false
    
	   function validarUsuario($titulo,$autor,$editorial,$precio){
      
	   return (
        validarNombre($titulo, "/^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,40}$/"  )  &&
        validarNombre($autor, "/^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,30}$/"  )  &&
		validarNombre($editorial, "/^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,20}$/"  )  &&
		validarNombre($precio, "/^-?\d+[\.]?\d\d$/"  ) 
        );
		}
	
     //--------------------------------Valida si los datos fueron ingresados correctamente
		 if ((validarUsuario($titulo,$autor,$editorial,$precio)) ) {
			 
			
			 
		$sql =  "UPDATE libro SET titulo = $titulo, autor = $autor, editorial=$editorial, precio=$precio WHERE titulo = $titulo1" ;
			 
	if ($conexion->query($sql) == TRUE) {
    echo "<br/><br/>Se registro creo correctamente";
} else {
    echo  "<br/><br/>Falló la creación de la tabla: (" . $conexion->errno . ") " .$sql . "<br>" . $conexion->error;
}
			    $conexion->close();
                header("Principal_insertar.php");
            						}
            else{
                // Si algo falla se recuperan los datos introducidos por el usuario
                // para que no tenga que reescribir los que estuviesen correctos.
                $titulo=$_POST['titulo'];
                $autor=$_POST['autor'];
			    $editorial=$_POST['editorial'];
			    $precio=$_POST['precio'];
			    }
        }
    ?>


   <section>
        <div id="formulario_registro">
<!-- Formulario de registro --> 
            <h2>Libreria </h2>
            <form action="Actualizar.php" method=POST >

			    <div >
                    <label for="titulo">Titulo:<span class="obligatorio">*</span></label>
                    <input type='text' id="titulo" name="titulo" maxlength="40" placeholder="Ingrese su titulo"
					title="Ingrese solo letras" pattern="^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,40}$"	required 
					value="<?php echo $titulo ?>" />
                </div>
				<div class="campoFormulario">
                    <label for="autor">Autor:<span class="obligatorio">*</span></label>
                    <input type='text' id="autor" name="autor" maxlength="30" placeholder="Ingrese su autor"
				 pattern="^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,30}$"	required 
					value="<?php echo $autor ?>" />
                </div>
				<div class="campoFormulario">
                    <label for="editorial">Editorial: <span class="obligatorio">*</span></label>
                    <input type='text' id="editorial" name="editorial" maxlength="20" 
					placeholder="Ingrese editorial" pattern="^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,30}$"	required 
					value="<?php echo $editorial ?>" />
                </div>
				<div class="campoFormulario">
   				<div class="campoFormulario">
				<label for="precio">Precio:<span class="obligatorio">*</span></label>
				<input type='text' id="precio" name="precio" maxlength="300" required 
				value="<?php echo $precio ?>" />
				</div>
                <div class="botonFormulario">
                <input type="submit" id="Actualizar" name="Actualizar" value="Actualizar">
				</div> 
		
            </form> 
		
			
        </div>
    </section>
</body>
</html>
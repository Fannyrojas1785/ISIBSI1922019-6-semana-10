<!DOCTYPE html>	
<html lang= "es">
<head>
    <meta charset="utf-8" />
    
 
   
 <link type="text/css" href="../css/master2.css" rel="stylesheet" />
  <script src="../js/principal.js" type="text/javascript"></script> 
	
  <title>Registro</title>
	
    
</head>

<body>
    
    <?php  // Inicializamos las variables que se usaran para los campos de texto del formulario.
       
             
		$nombre="";
		$usuario="";
        $password="";
        $pass="";
//----------------------------------------------------Creo la conexion
        if(isset($_POST['registrar'])){             
           	if(!($conexion = new mysqli('127.0.0.1', 'root','','libreria')))
	{
		 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
     	 exit();
		 
	}else{ 
	print ("<br/><br/>Conexion exitosa!!!"); 
	}
 
	
	// ---------------------------------------Limpia espacios en blanco y caracteres especiales------------------------------------
	 function limpiarData($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
				$nombre= limpiarData($_POST['nombre']);
                $usuario=limpiarData($_POST['usuario']);
                $password=limpiarData($_POST['password']);
            
				   $pass= Md5($password);


   // ---------------------------------------Validacion Expreciones regulares------------------------------------
   
    function validarNombre($variable,  $pattern){
       if (preg_match($pattern, $variable)) {
            return  	True;
        }
        return  false;
    }
	
	  //-------------------------------Comprueba si todos los datos del usuario son validos. si no returna false
    
	   function validarUsuario($nombre,$usuario,$pass,$password){
      
	  

        return (
        validarNombre($nombre, "/^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,50}$/"  )  &&
		validarNombre($usuario, "/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}.[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}$/"  )  &&
		validarNombre($password, "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*-_?&]{8,20}$/")
        );
    }
	
			 	 

			 //valida si los datos fueron ingresados correctamente
		 if ((validarUsuario($nombre,$usuario,$pass,$password)) ) {
			 
			
			 
		$sql =  "INSERT INTO usuario(Nombre, nick, contrasenia) VALUES ('$nombre','$usuario','$pass')";
			 
	if ($conexion->query($sql) === TRUE) {
    echo "<br/><br/>Se registro creo correctamente";
} else {
    echo  "<br/><br/>Falló la creación de la tabla: (" . $conexion->errno . ") " .$sql . "<br>" . $conexion->error;
}
	            $conexion->close();
                header("Location:../principal.php");
            
			
			
			}
            else{
                // Si algo falla se recuperan los datos introducidos por el usuario
                // para que no tenga que reescribir los que estuviesen correctos.
               
                $nombre=$_POST['nombre'];
           		$usuario=$_POST['usuario'];
                $password=$_POST['password'];
             

				
				
				
            }
        }
    ?>

    <section>
        <div id="formulario_registro">
<!-- Formulario de registro --> 
            <h2>Formulario de registro </h2>
            <form action="#" method=POST>
			
        	
					
					  <div class="campoFormulario">
                    <label for="nombre">Nombre:<span class="obligatorio">*</span></label>
                    <input type='text' id="nombre" name="nombre" maxlength="50" placeholder="Ingrese su nombre"onkeypress="return  soloLetras(event)"
					title="Ingrese solo letras, mayor de 3 digitos" pattern="^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,50}$"	required 
					value="<?php echo $nombre ?>" />
                </div>
					
               
				<div class="campoFormulario">
                    <label for="usuario">Usuario: <span class="obligatorio">*</span></label>
					<input type='text' id="usuario" name="usuario" maxlength="25"   placeholder="nombre.apellido" title="nombre.apellido" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}.[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}"  value="<?php echo $usuario ?>"  autocomplete="off"/>
                </div>
				
				
				
                <div class="campoFormulario">
                    <label for="password">Contraseña: <span class="obligatorio">*</span></label>
                    <input type='password' id="password" name="password" maxlength="20" placeholder="Ingrese contraseña" title="contener letras mayúsculas, minúsculas, números y los caracteres !?-. Su tamaño: entre 8 y 20 caracteres."
					pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*-_?&]{8,20}" 
					value="<?php echo $password ?>" autocomplete="off"/>
                </div>
            
      

                <div class="botonFormulario">
                    <input type="submit" id="registrar" name="registrar" value="Registrarse">
					<p><a href="../principal.php"> Volver al menú</a></p>
                </div>  
					
            </form> 
		
        </div>
		
    </section>
</body>
</html>
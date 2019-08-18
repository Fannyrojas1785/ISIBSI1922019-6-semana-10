<?php
	require_once("Seguridad/sesion.class.php");
	
	$sesion = new sesion();
	$usuario = $sesion->get("usuario");
	
	if( $usuario == false )
	{	
		header("Location: Seguridad/login.php");		
	}
	else 
	{
	?>
	<HTML>
	<head>

       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		 
  <link type="text/css" href="css/master2.css" rel="stylesheet" />
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	 
		
<title>Libreria</title>
	</head>
	<body>
	<h1>Hola:  <?php echo $sesion->get("usuario"); ?> </h1> <a href="Seguridad/cerrarsesion.php"> Cerrar Sesion </a>
	
    <?php  // Inicializamos las variables que se usaran para los campos de texto del formulario.
       
        $id=""; 
		$titulo="";
		$autor="";
		$editorial="";
		$precio="";
		
		$Base="libreria";
		$Tabla="libro";
 
//----------------------------------------------------Creo la conexion
        if(isset($_POST['registrar'])){             
           	if(!($conexion = new mysqli('127.0.0.1', 'root','',$Base)))
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
					 $titulorep=$titulo;
                $autorrep=$autor;
			    $editorialrep=$editorial;
			    $preciorep=$precio;

				
				
					$result = $conexion->query("SELECT titulo, autor, editorial, precio from $Tabla WHERE titulo='$titulo' and autor='$autor' and editorial='$editorial' and precio='$precio'");

						
					if (0 < $result->fetch_assoc()) {
								
							 echo "<br/><br/>Dato repetido";	
								 
				
				
			 }else{ 
			 $sql =  "INSERT INTO $Tabla(titulo, autor, editorial, precio) VALUES ('$titulo',
			 '$autor','$editorial','$precio')";
			 
			 if ($conexion->query($sql) == TRUE) {
    echo "<br/><br/>Se registro creo correctamente";
		 $id=""; 
	
			$titulo="";
			$autor="";
			$editorial="";
			$precio=""; 
} else {
    echo  "<br/><br/>Falló la creación de la tabla: (" . $conexion->errno . ") " .$sql . "<br>" . $conexion->error;
}
			    $conexion->close();
                header("Principal_insertar.php");}
		
			 
	
            						}
            else{
                // Si algo falla se recuperan los datos introducidos por el usuario
                // para que no tenga que reescribir los que estuviesen correctos.
                $titulo=$_POST['titulo'];
                $autor=$_POST['autor'];
			    $editorial=$_POST['editorial'];
			    $precio=$_POST['precio'];
		}}
       
    ?>

    <section>
<!-- Formulario de registro --> 
          
           
<div id="indice">

<h2>Libreria </h2>
<p>Seleccione la opcion que desea:</p>
<button class="accordion">Agregar</button>
<div class="panel">
<form action="#" method=POST >

			    <div class="campoFormulario">
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
				<label for="precio">Precio:<span class="obligatorio">*</span></label>
				<input type='text' id="precio" name="precio" maxlength="300" required 
				value="<?php echo $precio ?>" />
				</div>
                <div class="botonFormulario">
                <input type="submit" id="registrar" name="registrar" value="Registar">
				</div> 
		
            </form> 
			
	
</div> 
<button class="accordion">Actualizar </button>
<div class="panel">
<form method="get" action="CRUD/Libro_Actualizar.php">  
 <label for="editorial:">Ingrese num. de editorial a Actualizar:<span class="obligatorio">*</span></label>
 <?php

				$conn = new mysqli('127.0.0.1', 'root','',$Base) 
				or die ('Cannot connect to db');

					$result = $conn->query("SELECT id,titulo from libro");

					echo "<select id='id' name='id'  style=' width: 150px;'	required 
					value=''<?php echo $id ?>'/>";
					
					while ($row = $result->fetch_assoc()) {
								
								  unset($titulo);
								  unset($id);
								  $id = $row['id'];
								  $titulo = $row['titulo'];
								  echo '<option value="'.$id.'">'.$id.' - '.$titulo.'</option>';
								 
				}

					echo "</select>";

		
					?>

				
<input type="submit" id="Actualizar"  value="Actualizar"   />  
</form>

</div>
<button class="accordion">Eliminar</button>
<div class="panel">
<form method="get" action="CRUD/Eliminar.php"> 
 <label for="editorial:">Ingrese num. de editorial a eliminar:<span class="obligatorio">*</span></label>
 
 <?php

		$conn = new mysqli('127.0.0.1', 'root','',$Base) 
				or die ('Cannot connect to db');

					$result = $conn->query("SELECT id,titulo from libro");

					echo "<select id='id' name='id'  style=' width: 150px;'	required 
					value=''<?php echo $id ?>'/>";
					
					while ($row = $result->fetch_assoc()) {
								
								  unset($titulo);
								  unset($id);
								  $id = $row['id'];
								  $titulo = $row['titulo'];
								  echo '<option value="'.$id.'">'.$id.' - '.$titulo.'</option>';
								 
				}

					echo "</select>";

		
					?>


<input type="submit" value="Eliminar"/>  

</form>
</div>
<button class="accordion">I procedimiento almacenado</button>
<div class="panel">

<form method="Post" action="SP/Procedimientos.php" > 
 <label for="editorial:">Crear un procedimiento que reciba el nombre de una
editorial y luego aumenta en un 10% los precios de los
libros de la editorial.<span class="obligatorio">*</span></label>
 </br>Editorial:

<?php

				$conn = new mysqli('127.0.0.1', 'root','',$Base) 
				or die ('Cannot connect to db');

					$result = $conn->query("SELECT editorial from $Tabla group by editorial");

					echo "<select id='editorial' name='editorial'  style=' width: 150px;'	required 
					value=''<?php echo $editorial ?>' onblur='return validareditorial(this.value)/>";
					
					while ($row = $result->fetch_assoc()) {
								
								  unset($editorial);
								  $editorial = $row['editorial'];
								  echo '<option value="'.$editorial.'">'.$editorial.'</option>';
								 
				}

					echo "</select>";

					?>
	
<input type="hidden" name="procedimiento" value="Iprocedimiento">	
		<input id="precio" name="precio"  value=  "0"type="hidden" />% 
<input type="submit" value="Procesar"/>  

</form>
</div>
<button class="accordion">II procedimiento almacenado</button>
<div class="panel">
<form method="Post" action="SP/Procedimientos.php"> 
 <label for="editorial:">• Crear un segundo procedimiento almacenado que reciba 2
parámetros, el nombre de una editorial y el valor de
incremento (que por defecto sea el valor 10)<span class="obligatorio">*</span></label>
 
</br>Editorial:
<?php

				$conn = new mysqli('127.0.0.1', 'root','',$Base) 
				or die ('Cannot connect to db');

					$result = $conn->query("SELECT editorial from $Tabla group by editorial");

					echo "<select id='editorial' name='editorial'  style=' width: 150px;'	required 
					value=''<?php echo $editorial ?>' onblur='return validareditorial(this.value)/>";
					
					while ($row = $result->fetch_assoc()) {
								
								  unset($editorial);
								  $editorial = $row['editorial'];
								  echo '<option value="'.$editorial.'">'.$editorial.'</option>';
								 
				}

					echo "</select>";

					?>
					</br>
	<label for="precio">Precio:<span class="obligatorio">*</span></label>
				<input type='number' id="precio" name="precio" maxlength="300" min="10" value=  "10" required />% 
			<input type="hidden" name="procedimiento" value="IIprocedimiento">		
</br></br>
<input type="submit" value="Procesar"/> 
</br>



</form>


</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
</script>
</div>

</section>
	


<div>

 <?php 
  
   //-----------------------------------------------------Conexion---------------------------------------------
	if(!($conexion = new mysqli('127.0.0.1', 'root','','libreria')))
	{
		 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
     	 exit();
		 
	}else{ 
	print ("<br/><br/>Conexion exitosa!!!"); 
	}

 
	$consulta = mysqli_query($conexion,"SELECT * from libro")
	or die ("Error en conexion");

	
	echo '<table border="1">';
    echo '<tr>';
	echo '<th id="id">id</th>';
	echo '<th id="titulo">titulo</th>';
	echo '<th id="autor">autor</th>';
	
	echo '<th id="editorial">editorial</th>';
	echo '<th id="precio">precio</th>';
	
	   echo '</tr>';
	  

		

	   while($extraido = mysqli_fetch_array($consulta))
	   {
		    echo '<tr>';
		
		  echo '<td>'.$extraido['id'].'</td>';
		  echo '<td>'.$extraido['titulo'].'</td>';
		  echo '<td>'.$extraido['autor'].'</td>';
		  echo '<td>'.$extraido['editorial'].'</td>';
		  echo '<td>'.$extraido['precio'].'</td>';
		  
		  
		
		   echo '</tr>';

	   }

$conexion->close();
echo '</table>';

?>
</div>
	
	</body>
	
	
	</HTML>
	
	<?php 
	}	
?>
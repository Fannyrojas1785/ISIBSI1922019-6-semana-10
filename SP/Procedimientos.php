

<!DOCTYPE html>	
<html lang= "es">
<head>
    <meta charset="utf-8" />
    

		
<title>Libreria</title>
	
    
</head>

<body>
<?php
$Base="libreria";
$Tabla="libro";
$procedimiento=$_POST['procedimiento'];
$editorial=$_POST['editorial'];

//


$conn = new mysqli('127.0.0.1', 'root','',$Base) 
				or die ('Cannot connect to db');
if($procedimiento="Iprocedimiento")
	
{  

	$result = $conn->query("CALL SP_unparametro('$editorial')");

}	
if($procedimiento="IIprocedimiento")
	
{  	
$precio=$_POST['precio'];
$result = $conn->query("CALL SP_dosparametro('$editorial','$precio')");
}	


				

					
				

					
					
					
					

 if(isset($_GET['$procedimiento'])){ 



 } 
       
					?>
				<p><br /><a href="../principal.php"> Volver al menú</a></p>
		
</body>
</html>
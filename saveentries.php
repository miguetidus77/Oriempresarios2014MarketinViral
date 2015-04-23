<?php
	session_start();
	
	$site="localhost";
    $user="root";
    $pass="adriana63506474";
    $base="oriempblog";
    
    
    $conection=mysqli_connect($site, $user, $pass, $base) or die ("No has podido establecer conexión con el servidor".mysql_error());
    
    if(mysqli_connect_errno())
    {
        echo("Muy bien hecho, la cagaste");
    }

    $tituloEntrada=$_POST['tituloEntrada'];
    $articuloBy=$_SESSION['preneurid'];
	$articuloDate=$_POST['articuloDate'];
	$articuloId=$_POST['entrieIdentifier'];
	$entrieText=$_POST['hiddenCopyEditable'];
	$entrieType=$_POST['entrieState'];

	$findEntrie="SELECT entrie_identifier FROM entries WHERE entrie_identifier='".$articuloId."'";
	$search=mysqli_query($conection,$findEntrie);
	$result=mysqli_fetch_array($search);

	if($result==0){
		$query="INSERT INTO entries(blogger_id,entrie_title,entrie_date,entrie_identifier,entrie_text,entrie_state)VALUES('$articuloBy','$tituloEntrada','$articuloDate','$articuloId','$entrieText','$entrieType')";
		$insert=mysqli_query($conection,$query);
	}else{
		$query="UPDATE entries SET entrie_text='".$entrieText."', entrie_date='".$articuloDate."', entrie_state='".$entrieType."' WHERE entrie_identifier='".$articuloId."'";
		$insert=mysqli_query($conection,$query);
	}

	
	mysqli_close($conection);
				
	if($insert==false){
		echo 'Fallo al escribir en tabla de entradas Blog<br />';
	}
	if(mysqli_connect_errno()){
		$error="mysql error:".mysqli_errno().":".mysqli_connect_error();
		echo $error;
	}

?>
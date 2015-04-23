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

/*$fileFormat=array('.jpg','.jpeg','.png','.pdf','doc','xls','.xlsx');

	$totalFiles=count($_FILES['fileUp']['name']);
	for($i=0;$i<$totalFiles;$i++){
		$fileName=$_FILES['fileUp']['name'][$i];
		$fileTmpName=$_FILES['fileUp']['tmp_name'][$i];
		$fileExt=substr($fileName, strrpos($fileName, '.'));
		
		if(in_array($fileExt, $fileFormat)){
			if($fileExt==".jpg"){
				$fileSrc="userfiles/img/".$fileName;
			}
			if(move_uploaded_file($fileTmpName, "userfiles/img/".$fileName)){
				echo "<div id=\"msgUpload\">Archivo ".$fileName." se ha subido Exitosamente</div>";
			}else{
				echo "Ha ocurrido un error, Por Favor intentalo más tarde";
			}
		}else{
			echo "Tipo de Archivo no permitido.";
		}
	}*/

	
	

	$fileFormat=array('.jpg','.jpeg','.png','.pdf','doc','xls','.xlsx');
	$totalFiles=count($_FILES['fileUp']['name']);
	$dateUploadImage=date("y-m-d");
	$blogger_id=$_SESSION['preneurid'];

	for($i=0;$i<$totalFiles;$i++){
		$fileName=$_FILES['fileUp']['name'][$i];
		$fileTmpName=$_FILES['fileUp']['tmp_name'][$i];
		$fileExt=substr($fileName, strrpos($fileName, '.'));
		
		if(in_array($fileExt, $fileFormat)){
			if($fileExt==".jpg"){
				$fileSrc="userfiles/img/".$fileName;
				//$dateUploadImage=date("y-m-d");
				move_uploaded_file($fileTmpName, "userfiles/img/".$fileName);
				$search="SELECT img_src FROM images_blog WHERE img_src='$fileSrc'";
				$query=mysqli_query($conection,$search);
				$result=mysqli_num_rows($query);
				if($result==0){
				$query="INSERT INTO images_blog(blogger_id,img_src,img_date_upload)VALUES('$blogger_id','$fileSrc','$dateUploadImage')";
				$insert=mysqli_query($conection,$query);
				}
					
			}
			if($insert==false){
				echo 'Fallo al escribir en tabla de entradas Blog<br />';
			}
			if(mysqli_connect_errno()){
				$error="mysql error:".mysqli_errno().":".mysqli_connect_error();
				echo $error;
			}
		}
	}

	/*$search="SELECT img_src FROM images_blog WHERE img_date_upload='$dateUploadImage'";
	$querySearch=mysqli_query($conection,$search);
	$result=mysqli_fetch_array($querySearch);
	while($src==$result){
		$imgSrc=$src['img_src'];
		echo '<div class="imgBackSel"><img class="imgTmp" src="'.$imgSrc.'" width="100"/></div>';

	}*/


?>
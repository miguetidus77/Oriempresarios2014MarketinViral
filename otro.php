<!--<?php

/*$fileFormat=array('.jpg','.jpeg','.png','.pdf','doc','xls','.xlsx');

if(isset($_POST['Subir'])){
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
	}
}*/

?>-->
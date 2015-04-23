<html>
<head>
<title>Seleccionar una imagen con JavaScript</title>
<!--http://www.lawebdelprogramador.com/-->

<script type="text/javascript">
//Variable que contiene la ultima imagen seleccionada
var idImageSelected="";

//Funcion para seleccionar la imagen
function clickImage(idImage)
{
	if(idImageSelected==idImage)
	{
		//Si hemos pulsado en la imagen seleccionada, la desmarcamos
		document.getElementById(idImageSelected).style.border='solid 1px #ffffff';
		//Modificamos el valor del formulario con el valor de la imagen seleccionada
		document.nameform.elements["seleccionImagen"].value="";
		//Modificamos el valor en pantalla
		document.getElementById("imagenSeleccionada").innerHTML="";
		idImageSelected="";
	}else{
		if(idImageSelected)
		{
			//Eliminamos la seleccion anterior
			document.getElementById(idImageSelected).style.border='solid 1px #ffffff';
		}
		//Creamos la nueva seleccion
		document.getElementById(idImage).style.border='solid 1px #808080';
		//Modificamos el valor del formulario con el valor de la imagen seleccionada
		document.nameform.elements["seleccionImagen"].value=idImage;
		//Modificamos el valor en pantalla
		document.getElementById("imagenSeleccionada").innerHTML=idImage;
		//Guardamos el valor de la variable
		idImageSelected=idImage;
	}
}

//Funcion para deseleccionar la imagen
function unclickImage()
{
	//Eliminamos la seleccion
	document.getElementById(idImageSelected).style.border='solid 1px #ffffff';
	//Modificamos el valor del formulario con el valor de la imagen seleccionada
	document.nameform.elements["seleccionImagen"].value="";
	//Modificamos el valor en pantalla
	document.getElementById("imagenSeleccionada").innerHTML="";
}

</script>
</head>

<body>
<h1>Seleccionar una imagen con JavaScript</h1>
<?php
//Si hemos seleccionado una imagen hi hemos pulsado el boton enviar...
if($_POST["seleccionImagen"])
	echo "<p>Imagen enviada: ".$_POST["seleccionImagen"]."</p>";
?>
<p>Imagen seleccionada: <span id='imagenSeleccionada'></span></P>

<form action='' method='post' name='nameform'>
	<div style="clear:both;">
		<img src='img1.jpg' id='img1.jpg' style='vertical-align:middle;border:solid 1px #ffffff;' onclick="javascript:clickImage(this.id)" />
	</div>
	<div style="clear:both;">
		<img src='img2.jpg' id='img2.jpg' style='vertical-align:middle;border:solid 1px #ffffff;' onclick="javascript:clickImage(this.id)" />
	</div>
	<div style="clear:both;">
		<img src='img3.jpg' id='img3.jpg' style='vertical-align:middle;border:solid 1px #ffffff;' onclick="javascript:clickImage(this.id)" />
	</div>
	<input type='hidden' name='seleccionImagen' value='' />
	<input type='submit' value='Enviar' />&nbsp;<input type='button' value='Deseleccionar' onclick='javascript:unclickImage()' />
</form>
</body>
</html>
<?php
	function unirDB{
		$server="localhost";
		$usador="root";
		$codigo="adriana63506474";
		$info="diamantes";

		$conectar=mysqli_connect($server,$usador,$codigo,$info) or die("No te has conectado a la información". mysqli_error());

		if($conectar)
		{
			echo("Conexión realizada con exito./n Gracias por compartir tus conocimientos con el mundo");
		}
	}
?>
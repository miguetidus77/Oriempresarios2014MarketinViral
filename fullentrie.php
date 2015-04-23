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

    $preneurid=@$_SESSION['preneurid'];
    $id=$_GET['id'];
    

    if(isset($id)){
		$phrase="SELECT * FROM entries WHERE entrie_identifier='$id'";
		$phraseFind=mysqli_query($conection,$phrase);
		$phraseRow=mysqli_fetch_array($phraseFind);
		//$phraseTotal=mysqli_num_rows($phraseFind);
	}

	$authorId=$phraseRow['blogger_id'];
	$preneur="SELECT * FROM preneur_ownerblog WHERE preneur_id='$authorId'";
	$preneurFind=mysqli_query($conection,$preneur);
	$preneurRow=mysqli_fetch_array($preneurFind);
		//$phraseTotal=mysqli_num_rows($phraseFind);
	


?>

<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
		<title>OriEmpresarios Camino al Exito</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, maximum-scale=1">
		<link rel="stylesheet" href="normalize.css">
		<link rel="stylesheet" href="inicial.css">
	</head>
	<body>
		<header>
			<div id="headerSec">
				<img src="Image/logo2014-400px.png">
				<hgroup>
					<h1>Ori&Euml;mpresarios</h1>
					<h2>La perseverancia nos diferencia en nuestro camino al exito</h2>
				</hgroup>
			</div>
			<nav id="menuCabecera">
					<ul>
						<li>Nosotros</li>
						<li>Desarrollo Personal</li>
						<li>Oportunidad en MLM</li>
						<li>Contactanos</li>
					</ul>
				</nav>
			
		</header>

		<section id="albumMobile">
			<div id="fulEntrie">
				<?php

					$dateHour=$phraseRow['entrie_date'];
					$dateHour=substr($dateHour,-8);
					$dateDay=substr($phraseRow['entrie_date'],0,30);

					echo "<p>".$dateDay."</p>";
					$replaceBrakt=array("<",">");
					$replaceLine=array("[","]");
					$replace=str_replace($replaceLine,$replaceBrakt,$phraseRow['entrie_text']);
					echo $phraseRow['entrie_title'].'<br />';
					echo $replace;
					mysqli_free_result($phraseFind);
					mysqli_close($conection);
					echo "Publicado por: ".$preneurRow['preneur_name']." a las: ".$dateHour." ";
				?>
				<a href="index.php" title="Volver al Blog">Volver al Blog</a>
			</div>	
			<div>
				<h3>Archivo del Blog</h3>
			</div>
		</section>
		
		<footer>
			<ul>
				<li>Inicio</li>
				<li>Nosotros</li>
				<li>Oriblog</li>
				<li>Contactanos</li>
			</ul>
		</footer>
	</body>
</html>
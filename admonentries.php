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

	$searchId=$_SESSION['preneurid'];

	/*if(isset($searchId)){
		$phrase="SELECT * FROM entries ORDER BY entrie_date DESC, entrie_state";
		$phraseFind=mysqli_query($conection,$phrase);
		//$phraseRow=mysqli_fetch_array($phraseFind);
		$phraseTotal=mysqli_num_rows($phraseFind);
	}*/
?>

<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
		<title>OriEmpresarios Camino al Exito</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, maximum-scale=1">
		<script src="js/jquery-2.1.1.min.js"></script>
		<link rel="stylesheet" href="normalize.css">
		<link rel="stylesheet" href="inicial.css">
		<link rel="stylesheet" href="admonentries.css">
	</head>
	<body>
		<header>
			<div id="headerSec">
				<img src="Image/corazonDiamantelogo.png">
				<hgroup>
					<h1>Ori&Euml;mpresarios</h1>
					<h2>La perseverancia nos diferencia en nuestro camino al exito</h2>
				</hgroup>
			</div>
			<nav id="menuCabecera">
					<ul>
						<li><a href="index.php" title="Web Oriempresarios" alt="Web Oriempresarios">Inicio</a></li>
						<li><a href="oriblog.php" title="Publicaciones" alt="Publicaciones">Publicaciones</a></li>
						<li><a href="nuevoblog.php" alt="Crear Entrada" title="Crear Entrada" target="_self">Entrada</a></li>	
						<li><a href="admonusers.php" alt="Administrar Usuarios" title="Administrar Usuarios" target="_self">Usuarios</a></li>					
						<li><a href="yanomas.php" alt="Cerrar Sesión" title="Cerrar Sesión">Salir</a></li>
					</ul>
				</nav>
			
		</header>		
		<section>
			<div id="entriesdiv">
				<h3>Entradas</h3>
				<a href="#" id="seepublic">Publicados</a>
				<a href="#" id="seedraft">Borrador</a>
			</div>
		</section>
		<section id="panelEntries">
		<div id="public">
			<table>
				<tbody>
					<?php
						if(isset($searchId)){
							$phrase="SELECT * FROM entries WHERE entrie_state='Public' ORDER BY entrie_date DESC";
							$phraseFind=mysqli_query($conection,$phrase);
							//$phraseRow=mysqli_fetch_array($phraseFind);
							$phraseTotal=mysqli_num_rows($phraseFind);

							while($phraseRow=mysqli_fetch_array($phraseFind)){
							
							echo '<tr>';
							echo '<td><a href="fullentrie.php?id='.$phraseRow['entrie_identifier'].'">'.$phraseRow['entrie_title'].'</a></td>';						
							echo '<td>'.$phraseRow['entrie_date'].'</td>';
							echo '<td>'.$phraseRow['entrie_state'].'</td>';
							echo '<td><a href="nuevoblog.php?key='.$phraseRow['entrie_identifier'].'">Editar</a></td>';
							echo '<td>'.$phraseRow['entrie_identifier'].'</td>';
							echo '</tr>';
							
							}
						}
						
					?>	
				</tbody>
				
			</table>
		</div>
		<div id="draft">
			<table>
				<tbody>
					<?php
						if(isset($searchId)){
							$phrase1="SELECT * FROM entries WHERE entrie_state='Draft' ORDER BY entrie_date DESC";
							$phraseFind1=mysqli_query($conection,$phrase1);
							//$phraseRow=mysqli_fetch_array($phraseFind);
							$phraseTotal1=mysqli_num_rows($phraseFind1);

							while($phraseRow1=mysqli_fetch_array($phraseFind1)){
							
							echo '<tr>';
							echo '<td><a href="fullentrie.php?id='.$phraseRow1['entrie_identifier'].'">'.$phraseRow1['entrie_title'].'</a></td>';						
							echo '<td>'.$phraseRow1['entrie_date'].'</td>';
							echo '<td>'.$phraseRow1['entrie_state'].'</td>';
							echo '<td><a href="nuevoblog.php?key='.$phraseRow1['entrie_identifier'].'">Editar</a></td>';
							echo '<td>'.$phraseRow1['entrie_identifier'].'</td>';
							echo '</tr>';
							
							}
						}
						
					?>	
				</tbody>
				<?php
					
					mysqli_free_result($phraseFind);
					mysqli_close($conection);
				?>
				

			</table>
		</div>
			
		</section>

		<footer>
			
		</footer>
		<script>
		$(function(){

			$("#seepublic").click(function(){
				$("#public").show(400);
				$("#draft").hide(400);

			});
			$("#seedraft").click(function(){
				$("#public").hide(400);
				$("#draft").show(400);

			});




		});
		</script>
	</body>
</html>
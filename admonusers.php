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

	
		/*$phrase="SELECT * FROM entries WHERE entrie_state='Public' ORDER BY entrie_date DESC";
		$phraseFind=mysqli_query($conection,$phrase);
		$phraseRow=mysqli_fetch_array($phraseFind);
		$phraseTotal=mysqli_num_rows($phraseFind);
		$bloggerId=$phraseRow['blogger_id'];
	
		$phrase1="SELECT * FROM preneur_ownerblog WHERE preneur_id='".$bloggerId."'";
		$phraseFind1=mysqli_query($conection,$phrase1);
		$phraseRow1=mysqli_fetch_array($phraseFind1);*/

		@$nameShow=$_SESSION['preneurname'];
		$xplotName=explode(" ", $nameShow);
		//echo($nameShow=$_SESSION['preneurname']);
		//echo($_SESSION['preneurpass']);

		$phrase2="SELECT * FROM preneur_users ORDER BY preneur_date ASC";
		$phraseFind2=mysqli_query($conection,$phrase2);
		//$phraseRow2=mysqli_fetch_array($phraseFind2);
		//$phraseTotal2=mysqli_num_rows($phraseFind2);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Kalam:400,300' rel='stylesheet' type='text/css'>
		<title>OriEmpresarios Camino al Exito</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, maximum-scale=1">
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/inicial.js"></script>
		<link rel="stylesheet" href="normalize.css">
		<link rel="stylesheet" href="inicial.css">
		<link rel="stylesheet" href="admonusers.css">
	</head>
	<body>
		<div id="preHeader">
			<div id="axes">
				<ul id="preHeaderNav">	
					<li class="liLeft"><a href="http://co.oriflame.com/" target="_blank">Conoce Oriflame</a></li>
					<li class="liLeft"><a href="index.php" target="_blank">Inicio</a></li>				
					<?php
						if(isset($_SESSION['preneurname'])){
							echo('<li id="inicia" class="liRight"><a href="yanomas.php" id="register">Salir</a></li>');
							if(@$_SESSION['preneurid']==91496226){
								echo('<li id="admonentries" class="liRight"><a href="admonentries.php" title="Administrar Entradas">Entradas</a></li>');
								echo('<li id="newenter" class="liRight"><a href="nuevoblog.php" title="Crear Entradas">Crear</a></li>');								
								echo('<li id="publics" class="liRight"><a href="oriblog.php" title="Publicaciones" alt="Publicaciones">Publicaciones</a></li>');
							}
							echo('<li id="hola" class="liRight"><p>Hola '.$xplotName[0].'!!!</p></li>');
						}else{
							echo('<li class="liRight"><a href="#" id="inAxesLink">Ingresar</a></li>');
							echo('<li class="liRight"><a href="#" id="register">Registrate</a></li>');
						}
					?>	
				</ul>
					
			</div>								
		</div>
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
		<section>
			<table>
				<thead>
					<tr>
						<th>Fecha <br />
						Ingreso</th>
						<th>Hora <br />Ingreso</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Nick</th>
						<th>Email</th>
						<th>Patrocinador</th>
					</tr>
				</thead>
				<?php
					while($phraseRow2=mysqli_fetch_array($phraseFind2)){
						echo"<tr>";
						echo "<td>".$phraseRow2['preneur_date']."</td>";
						echo "<td>".$phraseRow2['preneur_hour']."</td>";
						echo "<td>".$phraseRow2['preneur_first_name']."</td>";
						echo "<td>".$phraseRow2['preneur_last_name']."</td>";
						echo "<td>".$phraseRow2['preneur_nick']."</td>";
						echo "<td>".$phraseRow2['preneur_mail']."</td>";
						echo "<td>".$phraseRow2['sponsor']."</td>";
						echo "<td><a href=\"userdataedit.php?key=".$phraseRow2['preneur_key']."\">Editar</a></td>";
						echo"</tr>";
					}
				?>
			</table>
		</section>
	<footer>
		<div>
			<p>Bienvenido a OriEmpresarios.</p>
		</div>	
	</footer>

</body>
</html>
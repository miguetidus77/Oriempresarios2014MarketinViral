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

	
		$phrase="SELECT * FROM entries WHERE entrie_state='Public' ORDER BY entrie_date DESC";
		$phraseFind=mysqli_query($conection,$phrase);
		$phraseRow=mysqli_fetch_array($phraseFind);
		$phraseTotal=mysqli_num_rows($phraseFind);
		$bloggerId=$phraseRow['blogger_id'];
	
		$phrase1="SELECT * FROM preneur_ownerblog WHERE preneur_id='".$bloggerId."'";
		$phraseFind1=mysqli_query($conection,$phrase1);
		$phraseRow1=mysqli_fetch_array($phraseFind1);

		@$nameShow=$_SESSION['preneurname'];
		$xplotName=explode(" ", $nameShow);
		//echo($_SESSION['preneurname']."+");
		//echo"<br />";
		//echo($_SESSION['preneurpass']."+");
	
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
				<link rel="stylesheet" href="normalize.css">
		<link rel="stylesheet" href="inicial.css">
		<link rel="stylesheet" href="admonusers.css">
	</head>
	<body>
		<div id="preHeader">
			<!--<div id="emptyHeader">
				<ul>
					<li><a href="http://co.oriflame.com/" target="_blank">Conoce Oriflame</a></li>
				</ul>
			</div>-->
			<div id="axes">
				<ul id="preHeaderNav">
					<li class="liLeft"><a href="http://co.oriflame.com/" target="_blank">Conoce Oriflame</a></li>
					<?php
						@$constantId=$_SESSION['preneurid'];
						@$constantPass=$_SESSION['preneurpass'];
						@$constantName=$_SESSION['preneurname'];
						@$constantKey=$_SESSION['preneurkey'];
						if(isset($constantName)){
							echo('<li id="inicia" class="liRight"><a href="yanomas.php" id="register">Salir</a></li>');
							if(@$constantId==91496226){
								echo('<li id="admonusers" class="liRight"><a href="admonusers.php" title="Administrar Usuarios">Usuarios</a></li>');
								echo('<li id="admonentries" class="liRight"><a href="admonentries.php" title="Administrar Entradas">Entradas</a></li>');
								echo('<li id="newenter" class="liRight"><a href="nuevoblog.php" title="Crear Entradas">Crear</a></li>');								
							}
							echo('<li id="myaccount" class="liRight"><a href="userdataedit.php?key='.$constantKey.'" title="Ver mi cuenta">Mi cuenta</a></li>');
							echo('<li id="hola" class="liRight"><p>Hola '.$xplotName[0].'!!!</p></li>');
						}else{
							echo('<li class="liRight"><a href="#" id="inAxesLink">Ingresar</a></li>');
							echo('<li class="liRight"><a href="#" id="register">Registrate</a></li>');
						}
					?>	
				</ul>
				<div id="inAxesForm">
					<form action="succesentrie.php" method="POST">
						<input type="text" placeholder="Nombre de Usuario" size="25" autocomplete="off" name="preneurname" />
						<input type="password" placeholder="Clave de Usuario" size="25" autocomplete="off" name="preneurpass" />
						<input type="submit" value="Ingresar" id="inAxesIn"/>
					</form>
				</div>			
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

		<section id="albumMobile">
			<div id="albumContenedor">
				<img src="">
				<img src="">
				<img src="">
			</div>
			<div id="albumMini">
				<img src="">
				<img src="">
				<img src="">
			</div>		
		</section>
		<section id="cambioInterno">
			
		</section>

		<section id="oportMlm">
			
		</section>
		
		<section id="oriBlog">
			<?php
				$idNum=0;
				while($phraseRow=mysqli_fetch_array($phraseFind)){

					$replaceBrakt=array("<",">");
					$replaceLine=array("[","]");
					$replace=str_replace($replaceLine,$replaceBrakt,$phraseRow['entrie_text']);
					$replace=substr($replace,0,150);
					$dateHour=$phraseRow['entrie_date'];
					$dateHour=substr($dateHour,-8);
					$dateDay=substr($phraseRow['entrie_date'],0,30);
					
					echo '<div class="indexEntries" style="background-color:rgba(255,255,255,0.5);margin-bottom:2px;width:70%;">';
					echo '<ul>';
					echo '<li>'.$dateDay.'</li>';
					if(!isset($constantPass)){
						echo '<li><a href="landregister.html"><h2>'.$phraseRow['entrie_title'].'</h2></a></li>';
					}else{
						echo '<li><a href="fullentrie.php?id='.$phraseRow['entrie_identifier'].'"><h2>'.$phraseRow['entrie_title'].'</h2></a></li>';
					}
					
					echo '<li><p>'.$replace.'</p></li>';
					if(!isset($constantPass)){
						echo '<li><a href="landregister.html">Ver más</a></li>';
					}else{
						echo '<li><a href="fullentrie.php?id='.$phraseRow['entrie_identifier'].'">Ver más</a></li>';
					}
					
					echo '<li><p>Publicado por: '.$phraseRow1['preneur_name'].' a las: '.$dateHour.'</p></li>';
					
					echo '</ul>';

					echo '</div>';

				}
				mysqli_free_result($phraseFind);
				mysqli_close($conection);
			?>
		</section>
		<section id="newPreneurForm">
			<div>
				<form action="newpreneur.php" method="POST" name="newPreneurUser" id="formUserRegister">
					<div><input type="text" value="Miguel" name="preneur_user_name" placeholder="Nombre" class="preneur_validar" id="preneurTextName"></div>
					<div><input type="text" name="preneur_user_last" placeholder="Apellido" class="preneur_validar" id="preneurTextLast"></div>
					<div><input type="text" name="preneur_user_mail" placeholder="Email" class="preneur_validar"></div>
					<div><input type="text" name="preneur_user_nick" placeholder="Nombre Usuario" class="preneur_validar"></div>
					<div><input type="password" name="preneur_user_pass" placeholder="Clave de usuario" id="pass1" class="preneur_validar"></div>
					<div id="passfieldindex">
						<div id="barresultindex">
							<div></div>
						</div>
						<div id="safepasstextindex"></div>
					</div>
					<div id="tipspassindex">
						<h4>Genera una Contraseña Segura</h4>
						<p>Tu contraseña debe tener mínimo los siguientes puntos</p>
							<ul>
								<div id="ulpass1in">
									<li id="li1in">Mínimo 8 Caracteres</li>
									<li id="li2in">Letras Minúsculas</li>
									<li id="li3in">Letras Mayúsculas</li>
								</div>
								<div id="ulpass2in">
									<li id="li4in">Mínimo un Número</li>
									<li id="li5in">Mínimo un Caracter Especial<br /> °|¬@!"#$%&\/=?*,;.^'+\-_\\() </li>
								</div>
							</ul>
					</div>
					<div id="resultpassin"></div>
					<div><input type="password" name="preneur_user_pass1" placeholder="Confirma Tu Clave" id="pass2" class="preneur_validar"></div>
					<div><input type="text" name="preneur_user_sponsor" placeholder="Quien te invito" class="preneur_validar" id="sponsor" /></div>					
					
					<input type="hidden" name="preneur_user_date" id="preneur_user_date" >
					<input type="hidden" name="preneur_user_key" id="preneur_user_key">
					<input type="submit" name="preneur_user_reg" value="Registro" disabled="disabled" class="disabled">
				</form>
				<div id="hiddeFormRegister">
					<span>X</span>	
				</div>
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

		<script src="js/index.js"></script>

		
	</body>
</html>
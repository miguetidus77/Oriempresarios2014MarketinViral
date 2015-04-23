<?php
echo"
	<div id="preHeader">
			<div id="emptyHeader">
				<ul>
					<li><a href="http://co.oriflame.com/" target="_blank">Conoce Oriflame</a></li>
				</ul>
			</div>
			<div id="axes">
				<ul id="preHeaderNav">					
					<?php
						if(isset($_SESSION['preneurname'])){
							echo('<li id="inicia"><a href="yanomas.php" id="register">Salir</a></li>');
							if(@$_SESSION['preneurid']==91496226){
								echo('<li id="admonusers"><a href="admonusers.php">Administrar Usuarios</a></li>');
								echo('<li id="newenter"><a href="nuevoblog.php">Crear Entrada</a></li>');								
							}
							echo('<li id="hola"><p>Hola '.$xplotName[0].'!!!</p></li>');
						}else{
							echo('<li><a href="#" id="inAxesLink">Ingresar</a></li>');
							echo('<li><a href="#" id="register">Registrate</a></li>');
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
";
?>
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
		$phraseRow1=mysqli_fetch_array($phraseFind1);

		@$nameShow=$_SESSION['preneurname'];
		$xplotName=explode(" ", $nameShow);*/
		//echo($nameShow=$_SESSION['preneurname']);
		//echo($_SESSION['preneurpass']);

		@$key=$_GET['key'];
		$phrase2="SELECT * FROM preneur_users WHERE preneur_key='".$key."' ORDER BY preneur_date ASC";
		$phraseFind2=mysqli_query($conection,$phrase2);
		$phraseRow2=mysqli_fetch_array($phraseFind2);
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
							echo('<li id="hola" class="liRight"><p>Hola '.$_SESSION['preneurname'].'!!!</p></li>');
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
			<form action="actupass.php" method="POST" style="width:90%;margin:2em auto;">
				
				<div id="basicinfo">
					<h3>Información Básica</h3>
					<div id="name-field">
						<label>Nombre:</label>
						<input type="text" value="<?php echo $phraseRow2['preneur_first_name'] ?>" />
					</div>
					<div id="last-name-field">
						<label>Apellido:</label>
						<input type="text" value="<?php echo $phraseRow2['preneur_last_name'] ?>" />
					</div>
					<div id="username-field">
						<label>Usuario:</label>
						<input type="text" value="<?php echo $phraseRow2['preneur_nick'] ?>" />
					</div>
					<div id="email-field">
						<label>Email:</label>
						<input type="text" value="<?php echo $phraseRow2['preneur_mail'] ?>" />
					</div>	
					<div>
						<input type="submit" name="probeinfo" value="Actualizar" disabled />
					</div>				
				</div>
				<div id="passinfo">
					<h3>Cambiar tu contraseña</h3>					
					<div id="newPass">
						<div>
							<label for="actualpass">Contraseña Actual:</label>
							<input type="password" id="actualpass" name="actualpass" class="inputempty" autocomplete="off" />
							<input type="hidden" value="<?php echo $_GET['key']; ?>" name="userkey" />
							<div id="resultText" style="display:none;">
								<p></p>
							</div>
							<div id="precarga">
								<img src="precarga.gif" />
							</div>
						</div>
						<div>
							<label for="passnew">Nueva contraseña:</label>
							<input type="password" id="passnew" class="inputdisabled" name="passnew" disabled />
							<div id="passfield">
								<div id="barresult">
									<div></div>
								</div>
								<div id="safepasstext"></div>
							</div>
							<div id="tipspass">
								<h4>Genera una Contraseña Segura</h4>
								<p>Tu contraseña debe tener mínimo los siguientes puntos</p>
								<ul>
									<div id="ulpass1">
										<li id="li1">Mínimo 8 Caracteres</li>
										<li id="li2">Letras Minúsculas</li>
										<li id="li3">Letras Mayúsculas</li>
									</div>
									<div id="ulpass2">
										<li id="li4">Mínimo un Número</li>
										<li id="li5">Mínimo un Caracter Especial<br /> °|¬@!"#$%&\/=?*,;.^<>'+\-_\\() </li>
									</div>
								</ul>
							</div>
							<div id="resultpass">
								
							</div>
						</div>
						<div>
							<label for="passchk">Confirma Contraseña:</label>
							<input type="password" id="passchk" class="inputdisabled" name="passchk" disabled />
						</div>					
						<div>
							<input type="submit" name="probepass" value="Actualizar" disabled />
						</div>
						<!--El cambio de contraseña lo hacemos bien primero evaluando la caontraseña actual con ajax o bien colocando la contraseña nueva y verificando el cambio con la contraseña actual.-->
					</div>

				</div>
				
				

			</form>
				<!--<?php
					//while($phraseRow2=mysqli_fetch_array($phraseFind2)){
					//	echo"<tr>";
					//	echo "<td>".$phraseRow2['preneur_date']."</td>";
					//	echo "<td>".$phraseRow2['preneur_hour']."</td>";
					//	echo "<td>".$phraseRow2['preneur_name']."</td>";
					//	echo "<td>".$phraseRow2['preneur_nick']."</td>";
					//	echo "<td>".$phraseRow2['preneur_mail']."</td>";
					//	echo "<td>".$phraseRow2['sponsor']."</td>";
					//	echo "<td><a href=\"userdataedit.php?key=".$phraseRow2['preneur_key']."\">Editar</a></td>";
					//	echo"</tr>";
					//}
				?>-->
			
		</section>
	<footer>
		<div>
			<p>Bienvenido a OriEmpresarios.</p>
		</div>	
	</footer>
	<script>
	$(function(){
		
		function findPass(){
				$.ajax({
				type:"POST",
				url:"probepass.php",
				data:$("form").serialize(),
				success:function(msg){
					if(msg=="1"){
						$("#precarga").slideUp(800);
						$(".inputdisabled").css({
							"opacity":"1",
							"border-color":"green"
						}).removeAttr("disabled");
						$("#resultText").hide(800);
						$("#resultText p").html("");
						$("input[name='probepass']").removeAttr("disabled");
						//$("#passnew").removeAttr("disabled");
						//$("#passchk").removeAttr("disabled");
						//$("#resultText").show(500);
						//$("#resultText p").html(msg);
					}else{
						$("#precarga").slideUp(800);
						$("#resultText").show(500);
						$("#resultText p").html("!Rectifica por favor tus datos¡");
						$(".inputdisabled").attr("disabled","disabled").css("opacity","0.8");

					}
				}
			});
			}

			function actuaPass(){
				$.ajax({
				type:"POST",
				url:"actupass.php",
				data:$("form").serialize(),
				success:function(mss){
					if(mss=="1"){
						$("#precarga").hide();
						$("#resultText").show(500);
						$("#resultText p").html("!Tu información ha sido satisfactoriamente actualizada¡");
						$(".inputdisabled").val("").attr("disabled","disabled");
						$("input[name='probepass']").attr("disabled","disabled");
						$("#resultpass").slideUp();
						$("#tipspass").slideDown();
					}else{
						$("#resultText").show(800);
						$("#resultText p").html("!Fallo Seguridad, ingresa otra clave de usuario¡");
						$(".inputdisabled").value("");
					}				
					
				}
				
				});
			}

		$("input[name='actualpass']").focusout(function(){
			$("#precarga").show(800);

			window.setTimeout(findPass,3000);			

		});
		
		

		$("#passnew").keyup(function(){
			$("#passfield").slideDown(500);

			$("#barresult").animate({"height":"0.8em"},500,"linear",function(){
				$("#safepasstext").animate({"height":"0.8em"},500,"linear");
			});

			var passfield=$("#passnew").val();
			
			var compare=passfield.match(/[a-z]/),
			compare2=passfield.match(/[A-Z]/),
			compare3=passfield.match(/[0-9]/),
			compare4=passfield.match(/[°|¬@!"#$%&\/=?*,;.^<>'+\-_\\()]/);
			var gradesafe=0;

			if(compare!=null){
				$("#li2").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li2").css("color","rgba(7,158,196,1)");
			}
			if(compare2!=null){
				$("#li3").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li3").css("color","rgba(7,158,196,1)");
			}
			if(compare3!=null){
				$("#li4").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li4").css("color","rgba(7,158,196,1)");
			}
			if(compare4!=null){
				$("#li5").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li5").css("color","rgba(7,158,196,1)");
			}
			if(passfield.length>=8){
				$("#li1").css("color","rgba(118,214,29,1)");
				gradesafe++;
			}else{
				$("#li1").css("color","rgba(7,158,196,1)");
			}			
			
			if(gradesafe==2 && passfield.length>=8){
				$("#safepasstext").html("¡Contraseña con Bajo grado de seguridad!");
				$("#safepasstext").css("color","rgba(232,46,69,1)");
				$("#barresult div").animate({"width":"+=17%"},800);
			}
			if(gradesafe==3 && passfield.length>=8){
				$("#safepasstext").html("¡Contraseña con Aceptable grado de seguridad!");
				$("#safepasstext").css("color","orange");
				$("#barresult div").animate({"width":"50%"},800).css("background-color","rgba(232,138,27,1)");
			}
			if(gradesafe==4 && passfield.length>=8){
				$("#safepasstext").html("¡Contraseña con Buen grado de seguridad!");
				$("#safepasstext").css("color","blue");
				$("#barresult div").animate({"width":"75%"},800).css("background-color","rgba(0,81,245,1)");
			}
			if(gradesafe==5 && passfield.length>=8){
				$("#safepasstext").html("¡Contraseña con Excelente grado de seguridad!");
				$("#safepasstext").css("color","green");
				$("#barresult div").animate({"width":"100%"},800).css("background-color","rgba(0,255,23,1)");
			}
			if(passfield.length==0 || passfield.length<8){
				$("#safepasstext").html("¡Contraseña muy corta, puedes mejorar la Seguridad!");
				$("#safapasstext").css("color","red");	
				$("#barresult div").animate({"width":"+=1%"},500,"linear").css("background-color","rgba(232,0,10,1)");			

			}
			//arregalr que al borrar la contraseña se baje la barra de seguridad.

		});

		$("input[name='probepass']").click(function(e){
			e.preventDefault();
			var pass1=$("#passnew").val();
			var pass2=$("#passchk").val();
			 if(pass1==pass2){
			 	$("#precarga").show(800);
			 	$("#tipspass").slideUp(500);
			 	$("#resultpass").show();
			 	$("#resultpass").html("!Tu pase de seguridad ha sido creado. Acceso Concedido¡");			 	
			
				window.setTimeout(actuaPass,8000);

			 }else{
			 	$("#precarga").show(800);
			 	$("#tipspass").slideUp(500);
			 	$("#resultpass").show();
			 	$("#resultpass").html("!Verifica tus contraseñas. Acceso Denegado¡");
			 }


		});

		/*$("input[type='submit']").click(function(e){
			//e.preventDefault();
			$.ajax({
				type:"POST",
				url:"probepass.php",
				data:$("form").serialize(),
				success:function(msg){
					alert(msg);
					//$("#resultText").show(500);
					//$("#resultText p").html(msg);
				}
			});
		});*/



	});
	</script>

</body>
</html>
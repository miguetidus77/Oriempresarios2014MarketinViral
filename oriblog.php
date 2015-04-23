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
		//echo($nameShow=$_SESSION['preneurname']);
		//echo($_SESSION['preneurpass']);
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
	</head>
	<body>
		<div id="preHeader">
			<div id="axes">
				<ul id="preHeaderNav">
					<li class="liLeft"><a href="http://co.oriflame.com/" target="_blank">Conoce Oriflame</a></li>	
					<li class="liLeft"><a href="index.php" target="_blank">Inicio</a></li>				
					<?php
						@$constantId=$_SESSION['preneurid'];
						@$constantPass=$_SESSION['preneurpass'];
						@$constantName=$_SESSION['preneurname'];
						if(isset($constantName)){
							echo('<li id="inicia" class="liRight"><a href="yanomas.php" id="register">Salir</a></li>');
							if(@$constantId==91496226){
								echo('<li id="admonusers" class="liRight"><a href="admonusers.php" title="Administrar Usuarios">Usuarios</a></li>');
								echo('<li id="admonentries" class="liRight"><a href="admonentries.php" title="Administrar Entradas">Entradas</a></li>');
								echo('<li id="newenter" class="liRight"><a href="nuevoblog.php" title="Crear Entrada">Crear</a></li>');								
							}
							echo('<li id="hola" class="liRight"><p>Hola '.$xplotName[0].'!!!</p></li>');
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
					echo '<li><a href="fullentrie.php?id='.$phraseRow['entrie_identifier'].'"><h2>'.$phraseRow['entrie_title'].'</h2></a></li>';
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

		<footer>
			<ul>
				<li>Inicio</li>
				<li>Nosotros</li>
				<li>Oriblog</li>
				<li>Contactanos</li>
			</ul>
		</footer>
		<script>
		$(function(){
			$("#register").click(function(){
				$("#newPreneurForm").show();
				$("#newPreneurForm").animate({					
					left:0,
					opacity:1
				},1000);
			});
			$("#hiddeFormRegister").click(function(){
				$("#newPreneurForm").animate({
					opacity:0,
					left:1025
				},800,function(){
					$("#newPreneurForm").hide();
				});
				
			});


			setInterval(function indexDatos(){
				var nameDay=["Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo"];
				var nameMonth=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
				var date=new Date();
				var year=date.getFullYear(),
					mont=date.getMonth(),
					mes=(mont<10)?'0'+mont:mont,
					montName=nameMonth[mont],
					day=date.getDate(),
					dia=(day<10)?'0'+day:day,
					dayNum=date.getDay()-1,
					nameDate=(dayNum===-1)?nameDay[6]:nameDay[dayNum],
					hour=date.getHours(),
					hora=(hour<10)?'0'+hour:hour,
					min=date.getMinutes(),
					minut=(min<10)?'0'+min:min,
					second=date.getSeconds(),
					seg=(second<10)?'0'+second:second;
				var finalindexDate=nameDate+"," +dia+" de "+montName+" de "+year+" - "+hora+":"+minut+":"+seg;
				$("#preneur_user_date").val(finalindexDate);
				console.log(dayNum);
				//return finalindexDate;
			},1000);
			

			function randomIdEntrie(){				
				var stringId="";
				var char="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				for(r=0;r<16;r++){
					var randNum=Math.floor((Math.random()*char.length)+1);
					stringId+=char.charAt(randNum);
				}
				return stringId;
			}
			
			function identifierRandomEntrie(){
					var date=new Date();
					var year=date.getFullYear(),
					mes=date.getMonth(),
					day=date.getDate();
					var random=randomIdEntrie();
					var dayDate=(day<10)?'0'+day:day;
					var monDate=(mes<10)?'0'+mes:mes;
					var identifier=year+"-"+mes+"-"+dayDate+"-"+random;
					
					return identifier;
								
			}
			var identifier=identifierRandomEntrie();
			$("#preneur_user_key").val(identifierRandomEntrie());
		
			$("#pass2").blur(function(){
				var pass1=$("#pass1").val(),
				pass2=$("#pass2").val();
				if(pass1!=pass2){
					$("#alert").show();
				}else{
					$("#alert").css('display','none');
				}
			});

			$(".preneur_validar").blur(function(){
				var empty=$(this).val();
				if(empty==0){
					$(this).css({
						'background-color':'red',
						'color':'white'
					});
				}else{
					$(this).css({
						'background-color':'white',
						'color':'inherit'
					});
				}
			});

			$("#inAxesLink").click(function(e){
				event.preventDefault(e);
				$("#inAxesForm").show();
				$("#inAxesForm").animate({
					height:"3em",
					width:"10%"
				},1500);

			});

			/*var linumber=$("#preHeaderNav li").size();
			console.log(linumber);
			if(linumber==2){
				$("#preHeaderNav").css('margin-left', '20em');
			}else{
				$("#preHeaderNav").css('margin-left', '11em');
			}*/




		});
		</script>
	</body>
</html>
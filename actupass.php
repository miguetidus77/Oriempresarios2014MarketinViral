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

    //$passactual=$_POST['actualpass'];
    $passnew=$_POST['passnew'];
    $probeKey=$_SESSION['preneurkey'];
    
    $findPreneur="SELECT * FROM preneur_users WHERE preneur_pass='$passnew' LIMIT 1";
    $preneurquery=mysqli_query($conection,$findPreneur);
    $preneurRow=mysqli_num_rows($preneurquery);

  if($preneurRow==0){
		$newPassUpdate="UPDATE preneur_users SET preneur_pass='$passnew' WHERE preneur_key='$probeKey' ";
		$preneurUpdate=mysqli_query($conection,$newPassUpdate);
		if($preneurUpdate){
			echo "1";
		}else{
			echo "0";
		}
    }
?>
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

    echo('<meta charset="UTF-8">');

    $preneurname=$_POST['preneur_user_name'];
    $preneurmail=$_POST['preneur_user_mail'];
    $preneurnick=$_POST['preneur_user_nick'];
    $preneurpass=$_POST['preneur_user_pass'];
    $preneursponsor=$_POST['preneur_user_sponsor'];
    $preneurdate=$_POST['preneur_user_date'];
    $preneur_Date=explode("-",$preneurdate);
    $preneurFecha=$preneur_Date[0];
    $preneurHour=$preneur_Date[1];
    $preneurkey=$_POST['preneur_user_key'];
    $preneurip=$_SERVER['REMOTE_ADDR'];
    $preneurbrow=$_SERVER['HTTP_USER_AGENT'];
    

    $findPreneur1="SELECT preneur_pass FROM preneur_users WHERE preneur_pass='".$preneurpass."'";
    $findPreneur2="SELECT preneur_nick FROM preneur_users WHERE preneur_nick='".$preneurnick."'";
    $findPreneur3="SELECT preneur_mail FROM preneur_users WHERE preneur_mail='".$preneurmail."'";
    $preneurquery1=mysqli_query($conection,$findPreneur1);
    $preneurRow1=mysqli_num_rows($preneurquery1);
    $preneurquery2=mysqli_query($conection,$findPreneur2);
    $preneurRow2=mysqli_num_rows($preneurquery2);
    $preneurquery3=mysqli_query($conection,$findPreneur3);
    $preneurRow3=mysqli_num_rows($preneurquery3);

    if($preneurRow1>0){
		echo 'La clave de usuario que deseas ingresar ya existe en nuestros registros.
    				Por favor intenta nuevamente. Gracias';
		echo('<meta http-equiv="REFRESH" content="15;url=index.php"> ');    	    	
    }elseif($preneurRow2>0){
		echo 'El nombre de usuario que deseas ingresar ya existe en nuestros registros.
    				Por favor intenta nuevamente. Gracias';
   	    echo('<meta http-equiv="REFRESH" content="15;url=index.php"> ');        	
    }elseif($preneurRow3>0){
    	echo 'El email que deseas ingresar ya existe en nuestros registros.
    				Por favor intenta nuevamente. Gracias';
   	    echo('<meta http-equiv="REFRESH" content="15;url=index.php"> ');	 
    }else{
	    	$query="INSERT INTO preneur_users(preneur_nick,preneur_name,preneur_pass,preneur_mail,preneur_date,preneur_hour,sponsor,preneur_key,dirip,databrow)VALUES('$preneurnick','$preneurname','$preneurpass','$preneurmail','$preneurFecha','$preneurHour','$preneursponsor','$preneurkey','$preneurip','$preneurbrow')";
			$insert=mysqli_query($conection,$query);

			$_SESSION['preneurUserKey']=$preneurkey;
			$_SESSION['preneurUserName']=$preneurname;
			$_SESSION['preneurUserPass']=$preneurpass;

            echo 'Gracias por registrarte, en breve llegará a tu correo una email de activación.
            Ve y activate y accede al mundo del Sistema de Marketing Multinivel para dar rienda suelta a 
            tus SUEÑOS';
            echo('<meta http-equiv="REFRESH" content="15;url=index.php"> ');
    	}
    	//echo 'El nombre de usuario, la clave o el email que deseas ingresar ya existe en nuestros registros.
    	//Por favor intenta nuevamente. Gracias'; 
    	//echo('<meta http-equiv="REFRESH" content="0;url=index.php"> ');	
    	
    
    mysqli_free_result($preneurquery1);
    mysqli_free_result($preneurquery2);
    mysqli_free_result($preneurquery3);
    mysqli_close($conection);
    



?>
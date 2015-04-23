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

    $preneurname=$_POST['preneurname'];
    $preneurpass=$_POST['preneurpass'];

    $findPreneur="SELECT * FROM preneur_ownerblog WHERE preneur_pass='$preneurpass' and preneur_nick='$preneurname' LIMIT 1";
    $preneurquery=mysqli_query($conection,$findPreneur);
    $preneurRow=mysqli_num_rows($preneurquery);

    if($preneurRow!=0){
		while($preneurResult=mysqli_fetch_array($preneurquery)){
	    	$_SESSION['preneurname']=$preneurResult['preneur_first_name'];
	    	$_SESSION['preneurpass']=$preneurResult['preneur_pass'];
	    	$_SESSION['preneurid']=$preneurResult['preneur_id'];
	    	$_SESSION['preneurkey']=$preneurResult['preneur_own_key'];	  

            header("location:admonentries.php");   	   	
    	}
        
    }else{
    	$findPreneur="SELECT * FROM preneur_users WHERE preneur_pass='$preneurpass' and preneur_nick='$preneurname' LIMIT 1";
    	$preneurquery=mysqli_query($conection,$findPreneur);
        $preneurRow=mysqli_num_rows($preneurquery);

        if($preneurRow!=0){
            while($preneurResult=mysqli_fetch_array($preneurquery)){
                $_SESSION['preneurname']=$preneurResult['preneur_first_name'];
                $_SESSION['preneurpass']=$preneurResult['preneur_pass'];
                $_SESSION['preneurkey']=$preneurResult['preneur_key']; 
                
                header("location:index.php");  
            }  
            
        }else{
            echo('Estas tratando de acceder a un sitio web restringido');
            echo'<meta http-equiv="Refresh" content="5;URL=index.php">';
        }

    }

    //if($_SESSION['preneurid']=$preneurResult['preneur_id']==0 || $_SESSION['preneurkey']=$preneurResult['preneur_key']==0){
        
        //Enviar a pagina de registro de nuevo usuario
   // }
    

?>
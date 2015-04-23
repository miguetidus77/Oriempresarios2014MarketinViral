<?php
session_start();
/*$string='<a href="--">Link</a>';
$stringArray=array("<",">");
$stringReplace=array("[","]");
$result=str_replace($stringArray, $stringReplace, $string);
echo $result;*/
//include 'blogconection.php';
//conection();
 	$site="localhost";
    $user="root";
    $pass="adriana63506474";
    $base="oriempblog";
    
    
    $conection=mysqli_connect($site, $user, $pass, $base) or die ("No has podido establecer conexión con el servidor".mysql_error());
    
    if(mysqli_connect_errno())
    {
        echo("Muy bien hecho, la cagaste");
    }

   
echo'<meta charset="utf-8">';

$tituloEntrada=$_POST['tituloEntrada'];
$articuloBy=$_SESSION['preneurid'];
$articuloDate=$_POST['articuloDate'];
$articuloId=$_POST['entrieIdentifier'];
$entrieText=$_POST['hiddenCopyEditable'];
$entrieType=$_POST['entrieState'];


$charHtmlTag=array("<",">");
$charHtmlTagRem=array("[","]");
$imagePath="userfiles/img/";

//echo $entrieText;
//echo $articuloId;

//$result=str_replace($charHtmlTag, $charHtmlTagRem, $entrieText);
$articuloText=str_replace($charHtmlTag, $charHtmlTagRem, $entrieText);

$findEntrie="SELECT entrie_identifier FROM entries WHERE entrie_identifier='".$articuloId."'";
$search=mysqli_query($conection,$findEntrie);
$result=mysqli_num_rows($search);

if($result==0){
    $search="INSERT INTO entries(blogger_id,entrie_title,entrie_date,entrie_identifier,entrie_text,entrie_state)VALUES('$articuloBy','$tituloEntrada','$articuloDate','$articuloId','$articuloText','$entrieType')";
    $insert=mysqli_query($conection,$search);
}else{
    $query="UPDATE entries SET entrie_text='".$articuloText."', entrie_date='".$articuloDate."',entrie_state='".$entrieType."' WHERE entrie_identifier='".$articuloId."'";
    $insert=mysqli_query($conection,$query);
}

if($insert==false){
    echo 'Fallo al escribir en tabla de entradas Blog<br />';
}
if(mysqli_connect_errno()){
    $error="mysql error:".mysqli_errno().":".mysqli_connect_error();
    echo $error;
}


mysqli_close($conection);



echo('<meta http-equiv="REFRESH" content="0;url=admonentries.php"> ');  
?>
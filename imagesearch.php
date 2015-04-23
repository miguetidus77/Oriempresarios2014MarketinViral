<?php
include 'blogconection.php'
conection();

function searchImg(){
	$search="SELECT img_src FROM images_blog";
	$query=mysqli_query($conection,$search);
	$result=mysqli_num_rows($query);
	if($result!=0){
		$insert="allow";
	}
}
?>
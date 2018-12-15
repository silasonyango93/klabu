<?php
 require 'connection.php';

	global $connection;
	
$id=$_POST["id"];
 //$sql = "select * from ProfilePictures WHERE ProfilePictures.id=70";
 $sql = "SELECT * FROM `profilepictures` WHERE `profilepictures`.`id`=$id";
  
 $result = mysqli_query($connection,$sql);
 
 
 $number_of_rows=mysqli_num_rows($result);
	
	$temp_array=array();
	
	if($number_of_rows>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
		 $temp_array[] = $row;
 
		}
	}else{
		
		echo "w";
	}
	
	header('Content-Type:application/json');
	
	
	echo json_encode(array("result"=>$temp_array));
 
 
mysqli_close($connection);
 ?>
 
 
 
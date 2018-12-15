<?php
require 'connection.php';

	global $connection;
	
	
	
	
	
$sql = "select * from ProfilePictures WHERE ProfilePictures.id=54";
 $res = mysqli_query($connection,$sql);
 
 if($res)
 {
	 while($id=mysqli_fetch_assoc($res)){
		 $url=$id['ActualImage'];
		 echo $url;
		
	 }
	
 }
 
 
  
 
 
	
	mysqli_close($connection);

?>

 
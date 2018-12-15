<?php
 require 'connection.php';

	global $connection;
	
	$ProductId=$_POST["ProductId"];
 $sql = "select * from `products` INNER JOIN `users` ON `products`.`id`=`users`.`id` WHERE `products`.`productid`=$ProductId";
  
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
 
 
 
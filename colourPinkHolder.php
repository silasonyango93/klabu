<?php
 require_once('dbConnect.php');
 
 $UserId=$_POST["id"];
 $ProductId=$_POST["ProductId"];
 
 $sql = "SELECT * FROM `bookedproducts` WHERE `bookedproducts`.`id`=$UserId AND `bookedproducts`.`ProductId`=$ProductId";
 
 $result = mysqli_query($con,$sql);
 
 
 $number_of_rows=mysqli_num_rows($result);
	
	$temp_array=array();
	
	if($number_of_rows>0)
	{
	while($row=mysqli_fetch_assoc($result))
		{
		 //$temp_array[] = $row;
		 
		//$time=$row['UploadTime'];
		$data="present";

		$row["data"]=$data;
		$temp_array[] = $row;
		}
	}else{
		$row["data"]="absent";
		$temp_array[] = $row;
	}
	
	header('Content-Type:application/json');
	
	
	echo json_encode(array("result"=>$temp_array));
 
 
  
 mysqli_close($con);
 ?>
 
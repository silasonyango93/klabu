<?php
 require_once('dbConnect.php');
 include 'fireBaseFunctions.php';
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 $BookerId=$_POST["id"];
 $ProductId=$_POST["ProductId"];
 
 
$sql = "select * from `users` INNER JOIN `products` ON `users`.`id`=`products`.`id` WHERE `products`.`productid`=$ProductId";
 
 $res = mysqli_query($con,$sql);
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		 $ProductOwnerId=$idd['id'];
		 $firebase_token=$idd['token_value'];
		 $ProductOwnerName=$idd['name'];
		 $ProductOwnerCampus=$idd['Campus'];
		 $ProductOwnerAddress=$idd['Address'];
		 $ProductType=$idd['ProductType'];
		
	 }
	
 }
 
 $sql = "select * from `users`  WHERE `users`.`id`=$BookerId";
 
 $res = mysqli_query($con,$sql);
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		 
		 
		 $BookerIdName=$idd['name'];
		 $BookerIdCampus=$idd['Campus'];
		 $BookerIdAddress=$idd['email'];
		
	 }
	
 }
 
 
 $message = array
          (
		'body' 	=> $BookerIdName.' of '.$BookerIdCampus.' campus ,Phone no: '.$BookerIdAddress.' is interested in your '.$ProductType,
		'title'	=> 'Notification',
		'click_action' => 'BOOKINGS',
	'NewsId' => $BookerId,
             	
          );
          
          send_notifications($firebase_token, $message);
 
 $query="INSERT INTO `bookedproducts`(`id`,`ProductId`,`BookedDate`,`ProductOwnerId`) VALUES('$BookerId','$ProductId',NOW(),'$ProductOwnerId');"; 
 // $response["success"] = TRUE
// echo json_encode($response);
 mysqli_query($con,$query) or die(mysqli_error($con));
 mysqli_close($con);}
 ?>
 
 <form  action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">
   
	Booker Id:<br>
    <input name="id" type="text" value="" size="30"/><br> 
	
	Product Id:<br>
    <input name="ProductId" type="text" value="" size="30"/><br> 
	
	
	 <input type="submit" value="Send"/> 
	 </form>
	
 
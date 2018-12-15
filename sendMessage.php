<?php
 require_once('dbConnect.php');
  include 'fireBaseFunctions.php';
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 
 $SenderId =$_POST["SenderId"];
 $RecepientId=$_POST["RecepientId"];
 $ProductId=$_POST["ProductId"];
 $Message=$_POST["Message"];
 $UserName=$_POST["UserName"];
	$temp_array=array(); 
 
 $sql = "select * from `users` WHERE `users`.`id`=$RecepientId";
 
 $res = mysqli_query($con,$sql);
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		
		 $firebase_token=$idd['token_value'];
		 
		
	 }
	
 }
 
 $message = array
          (
		'body' 	=> $Message,
		'title'	=> $UserName,
		'click_action' => 'BOOKINGS',
             	
          ); 
          
         //$firebase_token="eJRLHdE78Es:APA91bGbkCuOr7dKMqVhmsRnYnjD7bRiZhgIVw--Iq3h3b9mRbRRHjQHtM3Ni9AlejbSpIzVFAhfLsuLknF8YnG2amsXWfbFEkzsdQ1DjXXeuYPh302l1rwGdci96lWJ2Hao7UBbRz2S";
 
 send_notifications($firebase_token, $message);
 
 
 $query="INSERT INTO `messages` (`SenderId`, `RecepientId`, `Message`, `ProductId`, `timestamp`) VALUES ('$SenderId', '$RecepientId', '$Message', '$ProductId',NOW());"; 
 // $response["success"] = TRUE
// echo json_encode($response);
 mysqli_query($con,$query) or die(mysqli_error($con));
 mysqli_close($con);}
 ?>
 
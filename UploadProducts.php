<?php
require 'connection.php';
include 'fireBaseFunctions.php';

	global $connection;
   if($_SERVER['REQUEST_METHOD']=='POST'){
      $errors= array();
	  
	  $id = $_POST['id'];
	  $ProductType = $_POST['ProductType'];
	  $ProductMake = $_POST['ProductMake'];
	  $ProductColour = $_POST['ProductColour'];
	  $Price = $_POST['Price'];
	  $OtherDescriptions = $_POST['OtherDescriptions'];
	  $Category = $_POST['Category'];
	  $image = $_POST['image'];
      
      $ImageId=uniqid();
 
 $path = "uploads/$ImageId.png";
 
 //$server_ip = gethostbyname(gethostname());
 
 $actualpath = "https://www.zebaki.co.ke/Klabu/$path";
	  
	  $sql = "INSERT INTO `products` (`ProductId`, `id`, `ProductType`, `ProductMake`, `ProductColour`, `Price`, `OtherDescriptions`, `ProductImageUrl`, `ActualImage`, `UploadTime`, `Category`) VALUES (NULL, '$id', '$ProductType', '$ProductMake', '$ProductColour', '$Price', '$OtherDescriptions', '$actualpath', '$ImageId', NOW(), '$Category')"; 
	   if(mysqli_query($connection,$sql)){
 $isUploaded=file_put_contents($path,base64_decode($image));
 
 if($isUploaded==FALSE)
 {echo "Upload failed";}
 else{
 echo "Successfully Updated";}
 
 
 $sql = "select * from products WHERE `products`.`ActualImage` LIKE '%$NextImage%'";
 
 //$res = mysqli_query($con,$sql);
 
 $res =mysqli_query($connection,$sql) or die("The Product does not exist.");
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		 $NewProductId=$idd['ProductId'];
		
		 //echo "y";
		
	 }
	
 }
 
 
 
 
 
/* $sql = "select * from permanentquery INNER JOIN users ON `users`.`id`=`permanentquery`.`id` WHERE  `permanentquery`.`ProductType` LIKE '%$ProductType%' OR `permanentquery`.`ProductMake` LIKE '%$ProductMake%' OR `permanentquery`.`ProductColour` LIKE '%$ProductColour%' OR `permanentquery`.`HighestPrice` = $Price OR `permanentquery`.`Campus` LIKE '%$Campus%' OR `permanentquery`.`LowestPrice` = $Price";*/
 
 $sql = "select * from permanentquery INNER JOIN users ON `users`.`id`=`permanentquery`.`id` WHERE `permanentquery`.`ProductType` LIKE '%$ProductType%' AND $Price BETWEEN `permanentquery`.`HighestPrice` AND `permanentquery`.`LowestPrice`";
 
 $res =mysqli_query($connection,$sql) or die("The permanent query does not exist.");
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		 
		 $firebase_token=$idd['token_value'];
		 
		 echo $firebase_token;
		 echo "zzzzz";
		 
		 
		 $message = array
          (
		'body' 	=> 'We may have found a '.$ProductType.' that meets your requirements',
		'title'	=> 'Notification',
		'click_action' => 'UPLOAD',
	'NewsId' => $NewProductId,
             	
          );
          
          send_notifications($firebase_token, $message);
		
		 //echo "y";
		
	 }
	
 }
 
 
	   }
 
function getToken($connection,$id)
{
    echo "Ndani";
    $sql = "select * from users WHERE `users`.`id` = $id";
 
 //$res = mysqli_query($con,$sql);
 
 $res =mysqli_query($connection,$sql) or die("The user does not exist.");
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		 
		 
		 $firebase_token=$idd['token_value'];
		
		 //echo "y";
		
	 }
	
 }
 
 
 return $firebase_token;
}
 
 mysqli_close($connection);
 }
?>

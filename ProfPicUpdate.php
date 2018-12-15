<?php
 require_once('dbConnect.php');
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $image = $_POST['image'];
 	  $UserId = $_POST['id'];
 
 
 $ImageId=uniqid();
 
 $path = "uploads/$ImageId.png";
 
 //$server_ip = gethostbyname(gethostname());
 
 $actualpath = "https://www.zebaki.co.ke/Klabu/$path";
 
 $sql = "select * from `profilepictures` WHERE `profilepictures`.`id`=$UserId";
 $res = mysqli_query($connection,$sql);
 
 if($res)
 {
	 while($idd=mysqli_fetch_assoc($res)){
		 $ActualImage=$idd['ActualImage'];
		 //echo $ActualImage;
		
	 }
	
 }
 
$sql = "UPDATE `profilepictures` SET `url` = '$actualpath', `ActualImage` = '$ImageId' WHERE `profilepictures`.`id` = $UserId"; 

 
 if(mysqli_query($con,$sql)){
 $isUploaded=file_put_contents($path,base64_decode($image));
 
 //file_put_contents($ImagePath,base64_decode($ImageData));
 
 unlink("uploads/$ActualImage.png");
 
 if($isUploaded==FALSE)
 {echo "Upload failed";}
 else{
 echo "Successfully Updated";}
 }
 
 mysqli_close($con);
 }else{
 echo "Error";
 }
 ?>
 
 
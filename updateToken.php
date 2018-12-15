
<?php
 require_once('dbConnect.php');

	global $connection;
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 
 $token_value =$_POST["token_value"];
 $id =$_POST["UserId"];
 
 $query="UPDATE `users` SET `token_value` = '$token_value' WHERE `users`.`id` = $id";

 mysqli_query($con,$query) or die(mysqli_error($con));
 
 echo "imefika";
 
 mysqli_close($con);}
 ?>
 
 <form  action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">
   
	token_value:<br>
    <input name="token_value" type="text" value="" size="30"/><br> 
    UserId:<br>
    <input name="UserId" type="text" value="" size="30"/><br> 
	
	
	
	 <input type="submit" value="Send"/> 
	 </form>	
	
<?php
require 'connection.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	createStudent();
}

function createStudent()
{
	global $connection;
	$HostelName = $_POST['HostelName'];
	$OtherDescriptions = $_POST['OtherDescriptions'];
	$Price = $_POST['Price'];
	$id=$_POST["id"];
	$temp_array=array();
	
	//$query="UPDATE `zebakico_Klabu`.`ProfilePictures` SET `id` =$id,`url` = '$grade' WHERE `student_details`.`Admission_No` = $Admission_No;";
	$query="INSERT INTO `products` (`ProductId`,`id`, `ProductImageUrl`, `ProductType`, `ProductMake`, `ProductColour`, `Price`, `OtherDescriptions`, `ActualImage`, `UploadTime`) VALUES (NULL, '$id', 'http://www.zebaki.co.ke/Klabu/AdminUploads/58c3edbb05002.png', '$HostelName', 'Hostel room', 'I would like to sell my room', '$Price', '$OtherDescriptions', '58c3edbb05002',NOW())"; 
	mysqli_query($connection,$query) or die(mysqli_error($connection));
	$temp_array[0] =TRUE;
		header('Content-Type:application/json');
echo json_encode(array("details"=>$temp_array));

	
	mysqli_close($connection);
}
?>
<!--<form  action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">
   
	ID:<br>
    <input name="id" type="text" value="" size="30"/><br> 
	Hostel Name:<br>
    <input name="HostelName" type="text" value="" size="30"/><br> 
	Price:<br>
    <input name="Price" type="text" value="" size="30"/><br> 
	Other Descriptions/Comments:<br>
    <input name="OtherDescriptions" type="text" value="" size="30"/><br> 
	
	
	 <input type="submit" value="Send"/> 
	 </form>-->	
	
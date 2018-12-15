<?php
require 'connection.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	createStudent();
}

function createStudent()
{
	global $connection;
	
	$id=$_POST["id"];
	$temp_array=array();
	
	//$query="UPDATE `zebakico_Klabu`.`ProfilePictures` SET `id` =$id,`url` = '$grade' WHERE `student_details`.`Admission_No` = $Admission_No;";
	$query="INSERT INTO `permanentquery` (`id`, `ProductType`, `ProductMake`, `ProductColour`, `Price`, `Campus`, `OtherDescriptions`) VALUES ('$id', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');";
	mysqli_query($connection,$query) or die(mysqli_error($connection));
	$temp_array[0] =TRUE;
		header('Content-Type:application/json');
echo json_encode(array("details"=>$temp_array));

	
	mysqli_close($connection);
}
?>
<html>
   <body>
      
      <form action="" method="POST" enctype="multipart/form-data">
	  <input type="text" name="id" />
        
         <input type="submit"/>
      </form>
      
   </body>
</html>
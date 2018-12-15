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
	$ProductType=$_POST["ProductType"];
	$ProductMake=$_POST["ProductMake"];
	$ProductColour=$_POST["ProductColour"];
	$HighestPrice=$_POST["HighestPrice"];
	$Campus=$_POST["Campus"];
	$LowestPrice=$_POST["LowestPrice"];
	
	$temp_array=array();
	
	$query="UPDATE `permanentquery` SET `ProductType` ='$ProductType',`ProductMake` ='$ProductMake',`ProductColour` ='$ProductColour',`HighestPrice` ='$HighestPrice',`Campus` ='$Campus',`LowestPrice` ='$LowestPrice' WHERE `permanentquery`.`id` = $id;";
	
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
          
          id:<br>
	  <input type="text" name="id" />
	  </br>
	  
	   ProductType:<br>
	  <input type="text" name="ProductType" />
	  </br>
	  ProductMake:<br>
	  <input type="text" name="ProductMake" />
	  </br>
	  ProductColour:<br>
	  <input type="text" name="ProductColour" />
	  </br>
	  HighestPrice:<br>
	  <input type="text" name="HighestPrice" />
	  </br>
	  Campus:<br>
	  <input type="text" name="Campus" />
	  </br>
	  LowestPrice:<br>
	  <input type="text" name="LowestPrice" />
	  </br>
	   
        
         <input type="submit"/>
      </form>
      
   </body>
</html>
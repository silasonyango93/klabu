




<?php
 
require_once 'DB_Functions.php';
$db = new DB_Functions();

require_once 'dbDetails.php';
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
 
    // receiving the post params
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$Address = $_POST['Address'];
	$Campus = $_POST['Campus'];
	
	

 
    // check if user is already existed with the same email
    if ($db->isUserExisted($email)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($name, $email, $password,$Address,$Campus);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            //$response["uid"] = $user["unique_id"];
			$response["id"] = $user["id"];
			$id= $user["id"];
            $response["name"] = $user["name"];
            $response["email"] = $user["email"];
            $response["created_at"] = $user["created_at"];
			$response["Address"] = $user["Address"];
			$response["Campus"] = $user["Campus"];
           // $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
			
				
			$query="INSERT INTO `permanentquery` (`PermanentQueryId`, `id`, `ProductType`, `ProductMake`, `ProductColour`, `Price`, `Campus`, `OtherDescriptions`) VALUES ('NULL', '88', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');"; 
			
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
			
			}
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

//getUserDetails($email);

function getUserDetails($email){
$connection = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
	
	
	$query = "SELECT user_id,email,name FROM users WHERE email='$email'";
	$result=mysqli_query($connection,$query);
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
echo json_encode(array("details"=>$temp_array));



}
	?>	

<form  action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">
   
	Name:<br>
    <input name="name" type="text" value="" size="30"/><br> 
	Phone No:<br>
    <input name="email" type="text" value="" size="30"/><br> 
	Password:<br>
    <input name="password" type="text" value="" size="30"/><br> 
	Address:<br>
    <input name="Address" type="text" value="" size="30"/><br> 
	Campus:<br>
    <input name="Campus" type="text" value="" size="30"/><br> 
	
	
	 <input type="submit" value="Send"/> 
	 </form>	
	





	
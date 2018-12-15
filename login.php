<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email']) && isset($_POST['password'])) {
 
    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password);
 
    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        //$response["uid"] = $user["unique_id"];
		$response["id"] = $user["id"];
        $response["name"] = $user["name"];
        $response["email"] = $user["email"];
        $response["created_at"] = $user["created_at"];
		$response["Address"] = $user["Address"];
        //$response["user"]["updated_at"] = $user["updated_at"];
        echo json_encode($response);
		
			
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>

<form  action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">
   
	
	Phone No:<br>
    <input name="email" type="text" value="" size="30"/><br> 
	Password:<br>
    <input name="password" type="text" value="" size="30"/><br> 
	
	
	 <input type="submit" value="Send"/> 
	 </form>	
	
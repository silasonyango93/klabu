<?php
 require_once('dbConnect.php');
 //$id=$_POST["id"];
$sql = "select * from Products WHERE Products.id=67 ORDER BY DATE(UploadTime) DESC,UploadTime DESC";
 
 $res = mysqli_query($con,$sql);
 //echo $res;
 $response=array();
 if($res)
 {
	 while($id=mysqli_fetch_assoc($res)){
		 $UploadTime=$id['UploadTime'];
		 $Period=nicetime($UploadTime);
		 $ProductType=$id['ProductType'];
		 
		  $response["error"] = FALSE;
        
        $response["Period"] =$Period;
        $response["ProductImageUrl"] = $id['ProductImageUrl'];
		$response["ProductType"] = $id['ProductType'];
		$response["ProductMake"] = $id['ProductMake'];
		
		$response["ProductColour"] = $id['ProductColour'];
		$response["Price"] = $id['Price'];
		$response["OtherDescriptions"] = $id['OtherDescriptions'];
		$response["id"] = $id['id'];
		$response["ProductId"] = $id['ProductId'];
       
        echo json_encode(array("result"=>$response));
		
		
		
 }}
	
 else if($res==""){
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
 /*else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}*/
 
 
 
 function nicetime($date)
{
date_default_timezone_set("Africa/Nairobi");
if(empty($date)) {
    return "No date provided";
}

$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
$lengths         = array("60","60","24","7","4.35","12","10");

$now             = time();
$unix_date         = strtotime($date);

   // check validity of date
if(empty($unix_date)) {    
    return "Bad date";
}

// is it future date or past date
if($now > $unix_date) {    
    $difference     = $now - $unix_date;
    $tense         = "ago";

} else {
    $difference     = $unix_date - $now;
    $tense         = "from now";
}

for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
    $difference /= $lengths[$j];
}

$difference = round($difference);

if($difference != 1) {
    $periods[$j].= "s";
}

return "$difference $periods[$j] {$tense}";
}
 

	
	
	mysqli_close($con);

	
	
?>

 
	
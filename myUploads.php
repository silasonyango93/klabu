<?php
 require_once('dbConnect.php');
$id=$_POST["id"];

 
 //$sql = "select * from Products WHERE Products.id=$id ORDER BY DATE(UploadTime) DESC,UploadTime DESC";
 
 $sql = "SELECT * FROM `products` INNER JOIN `users` ON `users`.`id`=`products`.`id` INNER JOIN `profilepictures` ON `profilepictures`.`id`=`users`.`id` WHERE `products`.`id`=$id ORDER BY DATE(UploadTime) DESC,UploadTime DESC";
 
 $result = mysqli_query($con,$sql);
 
 
 $number_of_rows=mysqli_num_rows($result);
	
	$temp_array=array();
	
	if($number_of_rows>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
		 //$temp_array[] = $row;
		 
		$time=$row['UploadTime'];
		$Period=nicetime($time);

		$row["Period"]=$Period;
		$temp_array[] = $row;
		}
	}else{
		
		echo "w";
	}
	
	header('Content-Type:application/json');
	
	
	echo json_encode(array("result"=>$temp_array));
 
 
 
 
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
 
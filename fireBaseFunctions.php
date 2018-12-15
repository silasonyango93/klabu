<?php
 require_once('dbConnect.php');
 
 
 


 function send_notifications($firebase_token, $message) {
		     
    $url = 'https://fcm.googleapis.com/fcm/send';
    
    $fields = array(
        'to'=>$firebase_token,
        'data'=>$message
    );
    
    $headers = array(
        'Authorization:key=AAAA7lWgCr4:APA91bHGoiEdvlGMDwhZaWfTFiYlh4Wj36sPLgMngKfClYM7G9SJJLgTXTthni1cOQ5vrlvOB5kpuCe6lsyaw8tREj9uhNnXfJI0ls6S0urCA9v9BsKLLtHhLaqplQz7XN8QAwj6iQNP',
        'Content-Type:application/json'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
    $result = curl_exec($ch);
    if($result === FALSE){
        die('Curl failed:'.curl_error($ch));
    }
    curl_close($ch);
    return $result;
} 
 
 ?>
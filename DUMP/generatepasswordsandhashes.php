<?php
include("../EVOTE/include.php");

die();
$sqllli = "SELECT * FROM b_sm_logins where lum_valid =1 and lum_id = 265";
$sqllli = $conn->query($sqllli);

if ($sqllli->num_rows > 0) {
    // output data of each row
    while($row = $sqllli->fetch_assoc()) {
		

$uid = $row['lum_username'];
$email = $row['lum_email'];


$pas=md5(md5(sha1($uid.$email)));
	$hash = gen_hash($pas,$email);
	   if($conn->query("update `b_sm_logins` set `lum_password` = '".$pas."' , `lum_hash` ='".$hash."' where `lum_id` = '".$row['lum_id']."'")){
		   
	   }else{
		   die($conn->error.'Error at '. $row['lum_id']);
	   }
	   
    }
} else {
    echo "0 results";
}

?>

<?php
die();
include("../EVOTE/include.php");
$uid = "987656789";

$email = "a.raina@gemswis.com";


$pas=md5(md5(sha1($uid.$email)));
	$hash = gen_hash($pas,$email);



var_dump($pas);
var_dump($hash);

?>
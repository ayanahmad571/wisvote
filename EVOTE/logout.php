<?php
session_start();

session_destroy();

if(isset($_GET['thanksforvoting'])){
	header('Location: login.php?yeahvtdlst');
}else{
	header('Location: index.php');
}
?>
<?php

if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}

if(isset($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']) and trim($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']) != ''){
	if(ins_pgview($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'],basename($_SERVER['PHP_SELF']),$conn)){
	}else{
		die('#ERRHOM1');
	}
}else{
	
	#newhash
	session_regenerate_id();
	$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'] = give_uniqid();
	
	if(ins_msview($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'],$conn)){
	}else{
		die('#ERRHOM3');
	}
	#hash pgname 
if(ins_pgview($_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'],basename($_SERVER['PHP_SELF']),$conn)){
	}else{
		die('#ERRHOM4');
	}

}






if((count($_POST) > 0)  or (count($_GET) > 0)){
	if((count($_POST) > 0)){
		if(isset($_SERVER['HTTP_REFERER'])){
		}else{
			die('Refferer Not Found');
		}
		if((strpos($_SERVER['HTTP_REFERER'],'http://ahmadanonymous.ddns.net') == '0') or (strpos($_SERVER['HTTP_HOST'],'http://localhost/') == '0') or (strpos($_SERVER['HTTP_REFERER'],'http://192.168.1.') == '0'))
	{
	  //only process operation here
	}else{
		die('Only tld process are allowed');
	}
	}

}else{
	
	die(header('Location: master-action.php'));
	
}


#
#register
if(isset($_POST['ok'])){
	var_dump($_POST);
if( !isset($_POST['usr_pass']) or !isset($_POST['usr_eml'])){
	die('Please Enter all the data');
}



##

$email = $_POST['usr_eml'];

$pw = md5(md5(sha1($_POST['usr_pass'])));


$hash = gen_hash($pw,$email);
#pass and email and secret md5(sha1())


$sqla = "
INSERT INTO `b_sm_logins`(`lum_username`, `lum_password`, `lum_hash`,`lum_valid`) VALUES (
'".trim($email)."',
'".trim($pw)."',
'".trim($hash)."',
'0'
)
";


if ($conn->query($sqla) === TRUE) {
	
    header('Location: login.php');
	
    } else {
    echo  $conn->error."Error###maa4";
}


}
#
#login
if(isset($_POST['uid']) and isset($_POST['email'])){
	
	if(!is_numeric(trim($_POST['uid']))){
		die('User-ID must be numeric');
	}
	
	if(!is_email(trim($_POST['email']))){
		die('Invalid email format');
	}
	

	
	
	$uid = trim($_POST['uid']);
	$email = trim($_POST['email']);
	
	$pas=md5(md5(sha1($uid.$email)));
	$hash = gen_hash($pas,$email);
	
var_dump($pas);var_dump($hash);
die();

	if(ctype_alnum($hash.$pas)){
	}else{
		die("Credentials Not valid");
	}
	$t_hash = 20202018;
if($uid == $t_hash){
	$usr_type = 2;
}else{
	$usr_type = 1;
}
if($usr_type == 1){

		$selectusersfromdbsql = "SELECT * FROM b_sm_logins where 
lum_type = 1 and
lum_email= '".$email."' and
lum_username = '".$uid."' and
lum_password = '".$pas."' and
lum_hash= '".$hash."' and
lum_valid = 1

";
}else{

		$selectusersfromdbsql = "SELECT * FROM b_sm_logins where 
lum_type = 2 and
lum_email= '".$email."' and
lum_username= '".$t_hash."' and
lum_password = '".$pas."' and
lum_hash= '".$hash."' and
lum_valid = 1

";
}
		
$usrres = $conn->query($selectusersfromdbsql);
if ($usrres->num_rows == 1) {
    // output data of each row
    while($usrrw = $usrres->fetch_assoc()) {
        
		$insqqqqq = "insert into 
		`b_sv_auth_pass`(`ap_admno`,`ap_name`,`ap_dob`,`ap_house`,`ap_class`,
		`ap_lin`,`ap_lot`,`ap_sess_hash`,`ap_ip`,`ap_dnt`) 
		VALUES(
		'".$email."',
		'".$usrrw['lum_name']."',
		'".$uid."',
		'".$usrrw['lum_house']."',
		'".$usrrw['lum_class']." ".$usrrw['lum_section']."',
		'1',
		'0',
		'".$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']."',
		'".$_SERVER['REMOTE_ADDR']."',
		'".time()."'
		)";
		if($conn->query($insqqqqq)){
		
		session_regenerate_id();
		
		
		$_SESSION['SBSEVOTE_SESS_ID'] = md5(sha1(md5(md5(sha1('083qrhjedfj0248ure42i0h 282uwehfiuh 2h482t4hu4e9whfu428oyqeiuwfhjfdjbf9h759eyt20hojrfbmisk834ui')).uniqid().time()).time()).uniqid());
		$_SESSION['EVT_USR_DB_ID'] = $usrrw['lum_id'];
		session_write_close();
		
			header('Location: home.php');
			die();
		
    	}else{
			die("ERRMAinffgveiu");
		}
	}
} else {
	
	
	################################################################################33##
	
if($usr_type == 1){
	$sqllli = "INSERT INTO b_sv_auth_fail ( `af_adm_no`, `af_dob`, `af_sess_hash`, `af_ip`, `af_dnt`, `af_server_dump`)
							VALUES ('".$email."', '".$uid."', '".$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']."',
							 '".$_SERVER['REMOTE_ADDR']."', '".time()."',
							  '".($conn->escape_string($_SERVER['HTTP_USER_AGENT']))."')";
							
							if ($conn->query($sqllli) === TRUE) {								
									header('Location: login.php?errflag_li');
									die();
							} else {
								echo "ERRMAUINFOIEJOJOIJOIJ";
							}

die("User not found");

}elseif($usr_type ==2){
	
	$sqllli = "INSERT INTO b_sv_auth_fail ( `af_adm_no`, `af_dob`, `af_sess_hash`, `af_ip`, `af_dnt`, `af_server_dump`)
							VALUES ('".$email."', '".$uid."', '".$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']."',
							 '".$_SERVER['REMOTE_ADDR']."', '".time()."',
							  '".($conn->escape_string($_SERVER['HTTP_USER_AGENT']))."')";
							
							if ($conn->query($sqllli) === TRUE) {								
									header('Location: login.php?errflag_li');
									die();
							} else {
								echo "ERRMAUINFOIEJOJOIJOIJ";
							}

 die("User not found");
	
}

		
	
	
	}
	
	
		
}
#
#


	$serverdir = 'http://sbsvote.ddns.net/';

#
#
if(isset($_POST['mod_add'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['mod_a_long_name'])){
		$nm = $_POST['mod_a_long_name'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_href'])){
		$href = $_POST['mod_a_href'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_icon'])){
		$ico = $_POST['mod_a_icon'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_sub_menu']) and is_numeric($_POST['mod_a_sub_menu'])){
		if(in_range($_POST['mod_a_sub_menu'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$subm = $_POST['mod_a_sub_menu'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_ifadmin']) and is_numeric($_POST['mod_a_ifadmin'])){
		if(in_range($_POST['mod_a_ifadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 2');
		}
		$ifadm = $_POST['mod_a_ifadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_ifnotadmin']) and is_numeric($_POST['mod_a_ifnotadmin'])){
		if(in_range($_POST['mod_a_ifnotadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 3');
		}
		$ifnoadm = $_POST['mod_a_ifnotadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_ifnotlogin']) and is_numeric($_POST['mod_a_ifnotlogin'])){
		if(in_range($_POST['mod_a_ifnotlogin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		$ifnlogin = $_POST['mod_a_ifnotlogin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333mod_a_minadl
	if(isset($_POST['mod_a_iflogin']) and is_numeric($_POST['mod_a_iflogin'])){
		if(in_range($_POST['mod_a_ifadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 5');
		}
		$iflogin = $_POST['mod_a_iflogin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_minadl']) and is_numeric($_POST['mod_a_minadl'])){
		if(in_range($_POST['mod_a_minadl'],0,10,true)){
		}else{
			die('Values other than 10 to 0 are not allowed 7');
		}
		$minada = $_POST['mod_a_minadl'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_valid']) and is_numeric($_POST['mod_a_valid'])){
		if(in_range($_POST['mod_a_valid'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 6');
		}
		$vali_s = $_POST['mod_a_valid'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	if($conn->query("INSERT INTO `e_sv_modules`(`mo_name`, `mo_href`, `mo_icon`, `mo_ifadmin`, `mo_ifnoadmin`, `mo_if_no_log_in`, `mo_if_log_in`,`mo_min_ad_level` , `mo_sub_mod`, `mo_valid`) VALUES (
	'".$nm."',
	'".$href."',
	'".$ico."',
	".$ifadm.",
	".$ifnoadm.",
	".$ifnlogin.",
	".$iflogin.",
	".$minada.",
	".$subm.",
	".$vali_s."
	)")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'e_sv_modules','insert', "INSERT INTO `e_sv_modules`(`mo_name`, `mo_href`, `mo_icon`, `mo_ifadmin`, `mo_ifnoadmin`, `mo_if_no_log_in`, `mo_if_log_in`,`mo_min_ad_level` , `mo_sub_mod`, `mo_valid`) VALUES (
	'".$nm."',
	'".$href."',
	'".$ico."',
	".$ifadm.",
	".$ifnoadm.",
	".$ifnlogin.",
	".$iflogin.",
	".$minada.",
	".$subm.",
	".$vali_s."
	)",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: admin_mods.php');
	}else{
		die('ERRMAGRTBRHR%Y$T%HTIEB(FD');
	}
}
##
##
if(isset($_POST['add_user'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1 and lum_ad_level >= 8");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['usr_f_name'])){
		$nm = $_POST['usr_f_name'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_email'])){
		if(is_numeric($_POST['usr_email'])){
		$eml = $_POST['usr_email'];
		}else{
			die('AdmNo not Valid');
		}
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_pw'])){
		$pw = md5(md5(sha1($_POST['usr_pw'])));
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_acc']) and is_numeric($_POST['usr_acc'])){
		if(in_range($_POST['usr_acc'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 2');
		}
		$ad = $_POST['usr_acc'];
	}else{
		die('Enter all Fields Correctly 3');
	}
	############################33333333
	if(isset($_POST['usr_acc_l']) and is_numeric($_POST['usr_acc_l'])){
		if(in_range($_POST['usr_acc_l'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		$adlvl = $_POST['usr_acc_l'];
	}else{
		die('Enter all Fields Correctly 2');
	}

$hash = gen_hash($pw,$eml);

$checkusrnm = getdatafromsql($conn,"select * from b_sm_logins where lum_username = '".trim($eml)."'");
if(is_array($checkusrnm)){
	die("An acoount with the same admission number already exists.");
}

#########################
	if($conn->query("INSERT INTO `b_sm_logins`(`lum_username`, `lum_password`, `lum_hash`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($eml)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')")){





	##
		$ltid = $conn->insert_id;
		
						##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'b_sm_logins','insert', "INSERT INTO `b_sm_logins`(`lum_username`, `lum_password`, `lum_hash`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($eml)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###



	$sqlb = "INSERT INTO `sm_logins_rel`(`l_usr_name`, `l_rel_lum_id`, `l_usr_adm_no`) VALUES (
'".$nm."',
'".$ltid."',
'".$eml."')";

	if ($conn->query($sqlb) === TRUE) {
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'sm_logins_rel','insert', $sqlb ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	
    header('Location: admin_user.php');
} else {
    echo "Error##rujioma";
}
	

	##
	
	}else{
		die('ERRMAIGOTURG');
	}
}
##
##
#
#
#_______________________________START ADMINMUN_______________________
if(isset($_POST['ha_com']) and isset($_POST['com_make_ac'])){
	if(ctype_alnum(trim($_POST['ha_com']))){
		$checkit = getdatafromsql($conn,"select * from sm_stocks where md5(md5(sha1(sha1(md5(md5(concat(stck_id,'jijnfiirjfnirokijfkorkvnkorvfk'))))))) = '".$_POST['ha_com']."' and stck_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update sm_stocks set stck_valid =1 where stck_id= ".$checkit['stck_id']."")){
								##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'sm_stocks','update', "update sm_stocks set stck_valid=1 where stck_id= ".$checkit['stck_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_comp.php');
			}else{
				die('ERRRMA!JOINJFO');
			}
		}else{
			die("No Mun\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['ha_com']) and isset($_POST['com_make_inac'])){
	if(ctype_alnum(trim($_POST['ha_com']))){
		$checkit = getdatafromsql($conn,"select * from sm_stocks where md5(md5(sha1(sha1(md5(md5(concat(stck_id,'egkjtnr newsdnjjenfkv ijfkorkvnkorvfk'))))))) = '".$_POST['ha_com']."' and stck_valid = 1");
		
		if(is_array($checkit)){
			if($conn->query("update sm_stocks set stck_valid =0 where stck_id= ".$checkit['stck_id']."")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'sm_stocks','update', "update sm_stocks set stck_valid =0 where stck_id= ".$checkit['stck_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_comp.php');
			}else{
				die('ERRRMA!JOINJFWFEAO');
			}
		}else{
			die("No Mun\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END ADMINMUN_______________________
#_______________________________START MODULES_______________________
if(isset($_POST['hash_ac']) and isset($_POST['tab_act'])){
	if(ctype_alnum(trim($_POST['hash_ac']))){
		$checkit = getdatafromsql($conn,"select * from e_sv_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'njhifverkof2njbivjwj bfurhib2jw'))))))) = '".$_POST['hash_ac']."' and mo_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update e_sv_modules  set mo_valid =1 where mo_id= ".$checkit['mo_id']."")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'e_sv_modules ','update', "update e_sv_modules  set mo_valid =1 where mo_id= ".$checkit['mo_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_mods.php');
			}else{
				die('ERRRMA!JOIrfedNJFO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['hash_inc']) and isset($_POST['tab_inact'])){
	if(ctype_alnum(trim($_POST['hash_inc']))){
		$checkit = getdatafromsql($conn,"select * from e_sv_modules  where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'hbujeio03ir94urghnjefr 309i4wef'))))))) = '".$_POST['hash_inc']."' and mo_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update e_sv_modules  set mo_valid =0 where mo_id= ".$checkit['mo_id']."")){				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'e_sv_modules ','update', "update e_sv_modules  set mo_valid =0 where mo_id= ".$checkit['mo_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


								header('Location: admin_mods.php');
			}else{
				die('ERRRMAjn4rifJOINJFWFEAO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END MODULES_______________________
#_______________________________START POSITIONS_______________________
if(isset($_POST['hash_ac_pos']) and isset($_POST['pos_act'])){
	if(ctype_alnum(trim($_POST['hash_ac_pos']))){
		$checkit = getdatafromsql($conn,"select * from c_master_positions where md5(md5(sha1(sha1(md5(md5(concat(pos_id,'njhifverkof2njbivjwjbfurhib2jw'))))))) = '".$_POST['hash_ac_pos']."' and pos_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update c_master_positions  set pos_valid =1 where pos_id= ".$checkit['pos_id']."")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'c_master_positions ','update', "update c_master_positions  set pos_valid =1 where pos_id= ".$checkit['pos_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_pos.php');
			}else{
				die('ERRRMA!JOIrfedNJFO');
			}
		}else{
			die("No Position Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['hash_inc_pos']) and isset($_POST['pos_inact'])){
	if(ctype_alnum(trim($_POST['hash_inc_pos']))){
		$checkit = getdatafromsql($conn,"select * from c_master_positions  where 
		md5(md5(sha1(sha1(md5(md5(concat(pos_id,'hbujeio03ir94urghnjefr309i4wef'))))))) = '".$_POST['hash_inc_pos']."' and pos_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update c_master_positions  set pos_valid =0 where pos_id= ".$checkit['pos_id']."")){				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'c_master_positions ','update', "update c_master_positions  set pos_valid =0 where pos_id= ".$checkit['pos_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


								header('Location: admin_pos.php');
			}else{
				die('ERRRMAjn4rifJOINJFWFEAO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END POSITIONS_______________________
#_______________________________START POSITIONS_______________________
if(isset($_POST['hash_inc_candid']) and isset($_POST['candid_inact'])){
	if(ctype_alnum(trim($_POST['hash_inc_candid']))){
		$checkit = getdatafromsql($conn,"select * from d_participants  where 
		md5(md5(sha1(sha1(md5(md5(concat(pa_id,'uirhfiuerkhu h5eiur htuikeh5riu ghetbf'))))))) = '".$_POST['hash_inc_candid']."' and pa_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update d_participants  set pa_valid =0 where pa_id= ".$checkit['pa_id']."")){				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'d_participants ','update', "update d_participants  set pa_valid =0 where pa_id= ".$checkit['pa_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINC3kjtfeiujrhgTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


								header('Location: admin_parts.php');
			}else{
				die('ERRRMAjn4rersfOINJFWFEAO');
			}
		}else{
			die("select * from d_participants  where 
		md5(md5(sha1(sha1(md5(md5(concat(pa_id,'uirhfiuerkhu h5eiur htuikeh5riu ghetbf'))))))) = '".$_POST['hash_inc_candid']."' and pa_valid =1"."No participant Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END POSITIONS_______________________
#_______________________________START USER_______________________
if(isset($_POST['yh_com']) and isset($_POST['usr_make_ac'])){
	if(ctype_alnum(trim($_POST['yh_com']))){
		$checkit = getdatafromsql($conn,"select * from b_sm_logins where 
		md5(md5(sha1(sha1(md5(md5(concat(lum_id,'hir39efnewsfejirjeofkvjrjdnjjenfkvkijonreij3nj'))))))) = '".$_POST['yh_com']."' and lum_valid = 0");
		
		if(is_array($checkit)){
			if($checkit['lum_username'] == '741'){
				die('Super user can\'t be modified');
			}
			if($conn->query("update b_sm_logins set lum_valid =1 where lum_id= ".$checkit['lum_id']."")){
								
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'b_sm_logins','update', "update b_sm_logins set lum_valid =1 where lum_id= ".$checkit['lum_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_user.php');
			}else{
				die('ERRMA3jonkj34oirvfingj');
			}
		}else{
			die("No User Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#
if(isset($_POST['yh_com']) and isset($_POST['usr_make_inac'])){
	if(ctype_alnum(trim($_POST['yh_com']))){
		$checkit = getdatafromsql($conn,"select * from b_sm_logins where 
		md5(md5(sha1(sha1(md5(md5(concat(lum_id,'hir39efnewsfejirjrjdnjjenfkv ijfkorkvnkorvfk'))))))) = '".$_POST['yh_com']."' and lum_valid = 1");
		
		if(is_array($checkit)){
			if($checkit['lum_username'] == '741'){
				die('Super user can\'t be deleted');
			}
			if($conn->query("update b_sm_logins set lum_valid =0 where lum_id= ".$checkit['lum_id']."")){
				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'b_sm_logins','update', "update b_sm_logins set lum_valid =0 where lum_id= ".$checkit['lum_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




				
								header('Location: admin_user.php');
			}else{
				die('ERRMA3joingj');
			}
		}else{
			die("No User Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END USER_______________________
#
#
#
if(isset($_POST['edit_mod'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_emmp__1i'])){
		if(ctype_alnum(trim($_POST['hash_emmp__1i']))){
			$editmun = getdatafromsql($conn,"select * from e_sv_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'lkoegnuifvh bnn njenjn'))))))) = '".$_POST['hash_emmp__1i']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	############################33333333
	if(isset($_POST['edit_mod_lngnme'])){
		$nm = $_POST['edit_mod_lngnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_shrtnme'])){
		$href = $_POST['edit_mod_shrtnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_icon'])){
		$ico = $_POST['edit_mod_icon'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_sub']) and is_numeric($_POST['edit_mod_sub'])){
		if(in_range($_POST['edit_mod_sub'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$subm = $_POST['edit_mod_sub'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_ifadmin']) and is_numeric($_POST['edit_ifadmin'])){
		if(in_range($_POST['edit_ifadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 2');
		}
		$ifadm = $_POST['edit_ifadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_ifnoadmin']) and is_numeric($_POST['edit_ifnoadmin'])){
		if(in_range($_POST['edit_ifnoadmin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 3');
		}
		$ifnoadm = $_POST['edit_ifnoadmin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_ifnologin']) and is_numeric($_POST['edit_ifnologin'])){
		if(in_range($_POST['edit_ifnologin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 4');
		}
		$ifnlogin = $_POST['edit_ifnologin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_iflogin']) and is_numeric($_POST['edit_iflogin'])){
		if(in_range($_POST['edit_iflogin'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 5');
		}
		$iflogin = $_POST['edit_iflogin'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mominadlvl']) and is_numeric($_POST['edit_mominadlvl'])){
		if(in_range($_POST['edit_mominadlvl'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 6');
		}
		$minadlvl = $_POST['edit_mominadlvl'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	
	if(1==0){
		#You have not been authorised by SBSEVOTE but by trustee so the user has to grant your changes #
		die("You have not been authorised by SuperUser ");
	}else{
		if($conn->query("UPDATE `e_sv_modules` SET 
`mo_name`= '".$nm."',
`mo_href`='".$href."',
`mo_icon`='".$ico."',
`mo_ifadmin`='".$ifadm."',
`mo_ifnoadmin`='".$ifnoadm."',
`mo_if_no_log_in`='".$ifnlogin."',
`mo_if_log_in`='".$iflogin."',
`mo_sub_mod`='".$subm."',
`mo_min_ad_level` = '".$minadlvl."'
where mo_id = ".trim($editmun['mo_id'])."")){
	
	
	##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'e_sv_modules','update',"UPDATE `e_sv_modules` SET 
`mo_name`= '".$nm."',
`mo_href`='".$href."',
`mo_icon`='".$ico."',
`mo_ifadmin`='".$ifadm."',
`mo_ifnoadmin`='".$ifnoadm."',
`mo_if_no_log_in`='".$ifnlogin."',
`mo_if_log_in`='".$iflogin."',
`mo_sub_mod`='".$subm."',
`mo_min_ad_level` = '".$minadlvl."'
where mo_id = ".trim($editmun['mo_id'])."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_mods.php');
		}else{
			die('ERRMAerskirore9njr3ei9jinj');
		}
	}

}
##
##
if(isset($_POST['edit_user'])){
		if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1 and lum_ad_level >= 9");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_chkr'])){
		if(ctype_alnum(trim($_POST['hash_chkr']))){
			$editmun = getdatafromsql($conn,"select * from b_sm_logins where md5(md5(sha1(sha1(md5(md5(concat(lum_id,'f2frbgbe 2fgtegrfr3gbter 24rfgr324frgtr3f 3gr32fgr32f4gr'))))))) = '".$_POST['hash_chkr']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	
	if(isset($_POST['edit_us_nme'])){
		$nm = trim($_POST['edit_us_nme']);
	}else{
		die('Enter all Values 2');
	}
	
	if(isset($_POST['edit_us_adm']) and is_numeric($_POST['edit_us_adm'])){
		if(in_range($_POST['edit_us_adm'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$admer = $_POST['edit_us_adm'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	if(isset($_POST['edit_us_amdlvl']) and is_numeric($_POST['edit_us_amdlvl'])){
		if(in_range($_POST['edit_us_amdlvl'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$admlvl = $_POST['edit_us_amdlvl'];
	}else{
		die('Enter all Fields Correctly');
	}
	

	
		
	if(1==0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by SIMSBSSTMK but by trustee so the user has to grant your changes ");
	}else{
		$querytobeinserted = "
UPDATE 
	`b_sm_logins` a
SET 
	a.lum_ad='".$admer."',
	a.lum_ad_level='".$admlvl."',
	a.lum_name='".$nm."'
WHERE
	a.lum_id = ".trim($editmun['lum_id'])."";
		if($conn->query($querytobeinserted)){
		
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'b_sm_logins','update',$querytobeinserted,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

	header('Location: admin_user.php');
		}else{
			die('EmrfuRRMAers');
		}
	}

}
##
##
if(isset($_POST['acrbeo'])){
	
	if(isset($_POST['class'])){
		$class = $_POST['class'];
	}else{
		$class = NULL;
	}

	if(isset($_POST['type'])){
		$type = $_POST['type'];
	}else{
		$type = NULL;
	}

	if(isset($_POST['outer'])){
		$outer = $_POST['outer'];
	}else{
		$outer = NULL;
	}

	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}else{
		$page = NULL;
	}
	
	if(isset($_POST['href'])){
		$href = $_POST['href'];
	}else{
		$href = NULL;
	}
	
	
	
	
	$sql  = "INSERT INTO `a_pg_click`(`href_type`, `href_linkedto`, `href_page`, `href_dnt`, `href_hash`) VALUES ('".$class."|".$outer."|".$type."','".$href."','".$page."','".time()."','".$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID']."')";
	
	if($conn->query($sql)){
		echo md5(md5(sha1('iejrfoejrsugveuodhxtgnuivjex'.time())));
		
	}else{
		die($conn->error."ERRMAIJNOUEIHG)");
	}
	
}
##
##
if(isset($_POST['hash_ffipa'])){
	#jijnfiirj3woi#esrgujrvoiejs4rijfkvnkorvfk
	if(ctype_alnum(trim($_POST['hash_ffipa']))){
		$checkit = getdatafromsql($conn,"select * from sm_sessions 
		where md5(sha1(md5(concat('woi4jhfoiehrguijvnes',sess_id))))= 
		'".$_POST['hash_ffipa']."' and sess_valid = 1");
		
		
		if(is_array($checkit)){
			if($conn->query("update sm_sessions set sess_valid =0 where sess_id= ".$checkit['sess_id']."")){				
		##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['EVT_USR_DB_ID'],'sm_sessions','update', "update sm_sessions set sess_valid =0 where sess_id= ".$checkit['sess_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###





								header('Location: admin_session.php');
			}else{
				die('ERRRMAwhgieuk5sgrejnrhbejif');
			}
		}else{
			die("No TL rel in Instructions Found");
		}
	}else{
		die('Invalid Entries');
	}
}
##
#
if(isset($_POST['fund_add'])){
	
	if(isset($_POST['add_wlt_fund_usrid']) and isset($_POST['add_funds_fund'])){
		if(is_numeric($_POST['add_funds_fund'])){
			}else{
				die('Amount has to be Numeric');
			}
		
	}else{
		die('Enter all fields');
	}
	
	
		if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1 and lum_ad_level >=8");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	
	
	if(in_range(($_POST['add_funds_fund']),0,10000000,true)){
	}else{
		die('Max of 10Million INR can be entered in one transaction.');
	}
	
	####################
		if(isset($_POST['add_wlt_fund_usrid'])){
		if(ctype_alnum(trim($_POST['add_wlt_fund_usrid']))){
			$edituser = getdatafromsql($conn,"select * from b_sm_logins where md5(md5(sha1(md5(concat('erjfgviuerdhghvex',lum_id))))) = '".$_POST['add_wlt_fund_usrid']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($edituser)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}

	####################

$isql = "INSERT INTO `sm_wallet_funds`(`wf_rel_lum_id`, `wf_gen_rel_lum_id`, `wf_val`) VALUES (
'".$edituser['lum_id']."',
'".$getdatus['lum_id']."',
'".$_POST['add_funds_fund']."'
)";
	
if($conn->query($isql)){
##### Insert Logs ##################################################################VV3###
		if(preplogs($edituser,$_SESSION['EVT_USR_DB_ID'],'sm_wallet_funds','insert', $isql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###
	
	header('Location: admin_funds.php');
}
}
##
##
if(isset($_POST['a_comp_add'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1 and lum_ad_level >=8");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['a_comp_nm'])){
		$flnm = $_POST['a_comp_nm'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['stck_pr_b']) and is_numeric($_POST['stck_pr_b'])){
		
		$basep = $_POST['stck_pr_b'];
	}else{
		die('Enter all Fields Correctly bp');
	}
	############################33333333
	#####file upload
	
	if($conn->query("INSERT INTO `sm_stocks`(`stck_name`) VALUES ('".$flnm."')")){
		$inwrt = $conn->insert_id;
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'sm_stocks','insert', "INSERT INTO `sm_stocks`(`stck_name`) VALUES ('".$flnm."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%eigvidjgivjeiosezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

		
		}else{
			die('ERRMAR29JF');
		}
		
		
	if($conn->query("INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
	'".$inwrt."',
	'".$basep."',
	'".time()."',
	'".time()."',
	'0')")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'sm_stocks_price_rel','insert',
		"INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
	'".$inwrt."',
	'".$basep."',
	'".time()."',
	'".time()."',
	'0')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


		}else{
			die('ERRMAR293WJF');
		}
		
		
	for($fg = 1;$fg<46;$fg++){
		
		if(!is_numeric($_POST['stck_pr_up_'.$fg])){
			die('Only numeric values');
		}
		if($conn->query("INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
		".$inwrt.",
		'".$_POST['stck_pr_up_'.$fg]."',
		'".time()."',
		'".time()."',
		'".$fg."')")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'sm_stocks_price_rel','insert', 
		"INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
		".$inwrt.",
		'".$_POST['stck_pr_up_'.$fg]."',
		'".time()."',
		'".time()."',
		'".$fg."')"
		 ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

			
		}else{
			die('ERRMAR293WHJF');
		}
		
	}
	

if(trim($conn->error) == ''){
	header('Location: admin_comp.php');
}
	
	####file upload ends

}
if(isset($_POST['edit_stck'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1 and lum_ad_level >=8");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['h_com'])){
		if(ctype_alnum(trim($_POST['h_com']))){
			$editmun = getdatafromsql($conn,"select * from sm_stocks where md5(md5(sha1(sha1(md5(md5(concat(stck_id,'9irbfheierifhe3 4r3r04 j49i4u49igrhru9git'))))))) = '".$_POST['h_com']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	if(isset($_POST['stck_edit_fullnme'])){
		$longname = trim($_POST['stck_edit_fullnme']);
	}else{
		die('Enter all Values 2');
	}
	
	if(isset($_POST['stck_edit_img'])){
		$nimg = trim($_POST['stck_edit_img']);
	}else{
		die('Enter all Values 5.,5');
	}
	
	if(isset($_POST['stck_pr_ed_b']) and is_numeric($_POST['stck_pr_ed_b'])){
		$basep = trim($_POST['stck_pr_ed_b']);
	}else{
		die('Enter all Values 5.,5');
	}
	
	
	
	for($fg = 1;$fg<46;$fg++){
		
		if(!is_numeric($_POST['stck_pr_edit_up_'.$fg])){
			die($_POST['stck_pr_edit_up_'.$fg].'Only numeric values');
		}
		
	}
	
	
	
	
	if($conn->query("UPDATE sm_stocks set stck_name = '".$longname."', stck_img = '".$nimg."' where stck_id = ".$editmun['stck_id'])){
		##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'sm_stocks','update', "UPDATE sm_stocks set stck_name = '".$longname."' and stck_img = '".$nimg."' where stck_id = ".$editmun['stck_id'] ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


	}else{
		die('ERRMAIUNGFEOIRJGOINEIW4OJR');
	}
	
	if($conn->query("UPDATE sm_stocks_price_rel set stp_valid = 0 where stp_rel_stck_id =  ".$editmun['stck_id'])){
		
		##
		
		$inwrt = $editmun['stck_id'];
		
##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'sm_stocks_price_rel','update', "UPDATE sm_stocks_price_rel set stp_valid = 0 where stp_rel_stck_id =  ".$editmun['stck_id'] ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

		
		
		
		if($conn->query("INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
	'".$inwrt."',
	'".$basep."',
	'".time()."',
	'".time()."',
	'0')")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'sm_stocks_price_rel','insert', "INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
	'".$inwrt."',
	'".$basep."',
	'".time()."',
	'".time()."',
	'0')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

		
		
		}else{
			die('ERRMARWRSGF293WJF');
		}
		
		
	for($fg = 1;$fg<46;$fg++){
		
		if(!is_numeric($_POST['stck_pr_edit_up_'.$fg])){
			die('Only numeric values');
		}
		if($conn->query("INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
		".$inwrt.",
		'".$_POST['stck_pr_edit_up_'.$fg]."',
		'".time()."',
		'".time()."',
		'".$fg."')")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'sm_stocks_price_rel','insert', "INSERT INTO `sm_stocks_price_rel`( `stp_rel_stck_id`, `stp_val`, `stp_from`, `stp_till`, `stp_pos`) VALUES (
		".$inwrt.",
		'".$_POST['stck_pr_edit_up_'.$fg]."',
		'".time()."',
		'".time()."',
		'".$fg."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


		}else{
			die('ERRMAR2FF93WHJF');
		}
		
	}
		##
	}else{
		die("ERRMADELE");
	}
	
	
	

if(trim($conn->error) == ''){
	header('Location: admin_comp.php');
}
	
	
	
	
}
##
if(isset($_POST['add_rep_news'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1 and lum_ad_level >=8");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
		
		if($conn->query("update sm_news set nw_valid = 0 where 1")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'sm_news','update',  "update sm_news set nw_valid = 0 where 1",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

			
		}else{
			die('UNABLE TO DELETE OLD NEWS ARTICLES');
		}
	for($fg = 1;$fg<46;$fg++){
		
		if($conn->query("INSERT INTO `sm_news`( `nw_text`,`nw_from`, `nw_up_pos`) VALUES (
		'".$_POST['nw_pr_up_'.$fg]."',
		'".time()."',
		'".$fg."')")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'sm_news','insert', "INSERT INTO `sm_news`( `nw_text`,`nw_from`, `nw_up_pos`) VALUES (
		'".$_POST['nw_pr_up_'.$fg]."',
		'".time()."',
		'".$fg."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

			
		}else{
			die('ERRMAR293WHJF');
		}
		
	}
	

if(trim($conn->error) == ''){
	header('Location: admin_news.php');
}
	
	####file upload ends

}
##
##
if(isset($_POST['buy_stock']) and isset($_POST['buy_stock_stp'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
	}else{
		die('You Must be logged <br>
<a href="login.php"><button>Click to Login</button></a>');
	}
	
	
	
	if(is_numeric($_POST['buy_stock'])){
		$qty = $_POST['buy_stock'];
	}else{
		die('Stock qty has to be numeric');
	}
	
	
	if(ctype_alnum($_POST['buy_stock_stp'])){
		$hash = $_POST['buy_stock_stp'];
		
		$getdata = getdatafromsql($conn,"select * from sm_stocks_price_rel where md5(sha1(md5(md5(concat(stp_id,'hbrhugu8hi3re9ui3hefug3irefgir29oiwh4g38ohu5egr3i5ehgru'))))) = '".trim($hash)."' and stp_valid =1");
		if(!is_array($getdata)){
			die("Could not find the price");
		}

	}else{
		die('Stock qty has to be numeric');
	}
	
$getwallet = "select * from p_balance where wf_rel_lum_id = ".$_SESSION['EVT_USR_DB_ID']."
";


			$getwallet = getdatafromsql($conn,$getwallet);
			
			if(!is_array($getwallet)){
				die("Could not load your wallet amount");
			}
			
			
			if(($getwallet['wf_balance']) < ($qty*$getdata['stp_val'])){
				die('Not enough funds');
			}
			
			if(!isset($_SESSION['EVT_USR_DB_ID'])){
				die('Login to continue');
			}
			
			
			if($conn->query("INSERT INTO `sm_transactions`(
			`tr_rel_stck_id`, `tr_rel_lum_id`,
			 `tr_rel_stp_id`, `tr_qty`, 
			 `tr_time`, `tr_ip`) VALUES (
			 '".$getdata['stp_rel_stck_id']."',
			 '".$_SESSION['EVT_USR_DB_ID']."',
			 '".$getdata['stp_id']."',
			 '".$qty."',
			 '".time()."',
			 '".$_SERVER['REMOTE_ADDR']."'
			 
			 )")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdata,$_SESSION['EVT_USR_DB_ID'],'sm_transactions','insert', "INSERT INTO `sm_transactions`(
			`tr_rel_stck_id`, `tr_rel_lum_id`,
			 `tr_rel_stp_id`, `tr_qty`, 
			 `tr_time`, `tr_ip`) VALUES (
			 '".$getdata['stp_rel_stck_id']."',
			 '".$_SESSION['EVT_USR_DB_ID']."',
			 '".$getdata['stp_id']."',
			 '".$qty."',
			 '".time()."',
			 '".$_SERVER['REMOTE_ADDR']."'
			 
			 )" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

				 
				 header('Location: markets.php');
			}else{
				die('ERRMAOI4WJGF38EIRGHNO');
			}
	
}
if(isset($_POST['sell_stock']) and isset($_POST['sell_stock_stp'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
	}else{
		die('You Must be logged <br>
<a href="login.php"><button>Click to Login</button></a>');
	}
	
	
	
	if(is_numeric($_POST['sell_stock'])){
		$qty = $_POST['sell_stock'];
	}else{
		die('Stock qty has to be numeric');
	}
	
	
	if(ctype_alnum($_POST['sell_stock_stp'])){
		$hash = $_POST['sell_stock_stp'];
		
		$getdata = getdatafromsql($conn,"select * from sm_stocks_price_rel where md5(sha1(md5(md5(concat(stp_id,'hbrhugu8hi3re9ui3hefug3irefgir29oiwh4g38ohu5eg3i5ehgru'))))) = '".trim($hash)."' and stp_valid =1");
		if(!is_array($getdata)){
			die("Could not find the price");
		}

	}else{
		die('Stock qty has to be numeric');
	}
	
			
			if(!isset($_SESSION['EVT_USR_DB_ID'])){
				die('Login to continue');
			}
			
			
			
			
			$getsellab = "select sum(tr_qty) as sellab from sm_transactions 
			where tr_valid =1 and 
			tr_rel_stck_id = ".$getdata['stp_rel_stck_id']."
			and
			tr_rel_lum_id = ".$_SESSION['EVT_USR_DB_ID']."
			group by tr_rel_stck_id
";


			$getsellab = getdatafromsql($conn,$getsellab);
			
			if(!is_array($getsellab)){
				echo '0';
			}
			
			
			
				$getsold = "select sum(ts_qty) as sellab from sm_transactions_sell 
			where ts_valid =1 and
			ts_rel_stck_id = ".$getdata['stp_rel_stck_id']."
			and 
			ts_rel_lum_id = ".$_SESSION['EVT_USR_DB_ID']."
			group by ts_rel_stck_id
";


			$getsold = getdatafromsql($conn,$getsold);
			
			if(!is_array($getsold)){
				$getisold = 0;
			}else{
				$getisold = $getsold['sellab'];
			}
			
			
			if($getsold > $getsellab){
				die('You don\'t have enough to sell ');
			}
			
			
			if($conn->query("INSERT INTO `sm_transactions_sell`(
			`ts_rel_stck_id`, `ts_rel_lum_id`,
			 `ts_rel_stp_id`, `ts_qty`, 
			 `ts_time`, `ts_ip`) VALUES (
			 '".$getdata['stp_rel_stck_id']."',
			 '".$_SESSION['EVT_USR_DB_ID']."',
			 '".$getdata['stp_id']."',
			 '".$qty."',
			 '".time()."',
			 '".$_SERVER['REMOTE_ADDR']."'
			 
			 )")){
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdata,$_SESSION['EVT_USR_DB_ID'],'sm_transactions_sell','insert', "INSERT INTO `sm_transactions_sell`(
			`ts_rel_stck_id`, `ts_rel_lum_id`,
			 `ts_rel_stp_id`, `ts_qty`, 
			 `ts_time`, `ts_ip`) VALUES (
			 '".$getdata['stp_rel_stck_id']."',
			 '".$_SESSION['EVT_USR_DB_ID']."',
			 '".$getdata['stp_id']."',
			 '".$qty."',
			 '".time()."',
			 '".$_SERVER['REMOTE_ADDR']."'
			 
			 )" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGsezfdTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

				 
				 header('Location: markets.php');
			}else{
				die('ERRMAOI4WJGF38EIRGHNO');
			}
	
}
##
##
if(isset($_POST['pos_add'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['pos_title'])){
		$nm = $_POST['pos_title'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['pos_desc'])){
		$desc = $_POST['pos_desc'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['pos_type']) and ctype_alnum($_POST['pos_type'])){
		$type = $_POST['pos_type'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	$checktyp = getdatafromsql($conn,"select * from c_master_vote_types where md5(sha1(md5(concat(vt_id,
					'ersjfvuehr8f9j398wou4 r98f3o4uw 8oug3wourhgn')))) ='".$type."'");
	if(is_array($checktyp)){
		$type = $checktyp['vt_id'];
	}else{
		die('Invalid Type');
	}
	############################33333333
	if(isset($_POST['pos_min_class']) and is_numeric($_POST['pos_min_class'])){
		if(in_range($_POST['pos_min_class'],6,12,true)){
		}else{
			die('Values other than 12 to 6 are not allowed.');
		}
		$minclass = $_POST['pos_min_class'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['pos_valid']) and is_numeric($_POST['pos_valid'])){
		if(in_range($_POST['pos_valid'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 6');
		}
		$vali_s = $_POST['pos_valid'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	if($conn->query("INSERT INTO `c_master_positions`( `pos_title`, `pos_desc`, `pos_type`, `pos_class_valid`, `pos_added`, `pos_ad_rel_lum_id`, `pos_valid`) VALUES (
	'".$nm."',
	'".$desc."',
	'".$type."',
	".$minclass.",
	".time().",
	".$_SESSION['EVT_USR_DB_ID'].",
	".$vali_s."
	)")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'e_sv_modules','insert', "INSERT INTO `c_master_positions`( `pos_title`, `pos_desc`, `pos_type`, `pos_class_valid`, `pos_added`, `pos_ad_rel_lum_id`, `pos_valid`) VALUES (
	'".$nm."',
	'".$desc."',
	'".$type."',
	".$minclass.",
	".time().",
	".$_SESSION['EVT_USR_DB_ID'].",
	".$vali_s."
	)",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: admin_pos.php');
	}else{
		die($conn->error.'ERRMAGRTBRHR%Y$T%HTIEB(FD');
	}
}
#
if(isset($_POST['edit_pos'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_i_1i'])){
		if(ctype_alnum(trim($_POST['hash_i_1i']))){
			$editmun = getdatafromsql($conn,"select * from c_master_positions where md5(md5(sha1(sha1(md5(md5(concat(pos_id,'lkoegnuifvh bnn njenn'))))))) = '".$_POST['hash_i_1i']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	############################33333333
	if(isset($_POST['edit_pos_lngnme'])){
		$nm = $_POST['edit_pos_lngnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_pos_desc'])){
		$desc = $_POST['edit_pos_desc'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_pos_minadlvl']) and is_numeric($_POST['edit_pos_minadlvl'])){
		if(in_range($_POST['edit_pos_minadlvl'],6,12,true)){
		}else{
			die('Values other than 12 to 6 are not allowed');
		}
		$minlvl = $_POST['edit_pos_minadlvl'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	
	if(1==0){
		#You have not been authorised by SBSEVOTE but by trustee so the user has to grant your changes #
		die("You have not been authorised by SuperUser ");
	}else{
		if($conn->query("UPDATE `c_master_positions` SET 
`pos_title`= '".$nm."',
`pos_desc`='".$desc."',
`pos_class_valid`='".$minlvl."'
where pos_id = ".trim($editmun['pos_id'])."")){
	
	
	##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'c_master_positions','update',"UPDATE `c_master_vote_types` SET 
`pos_title`= '".$nm."',
`pos_desc`='".$desc."',
`pos_class_valid`='".$minlvl."'
where pos_id  = ".trim($editmun['pos_id'])."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_pos.php');
		}else{
			die('ERRMAerskirore9njr3ei9jinj');
		}
	}

}
#
#
if(isset($_POST['par_add'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['par_name'])){
		$nm = $_POST['par_name'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['par_admno']) and is_numeric($_POST['par_admno'])){
		$admno = $_POST['par_admno'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['par_position']) and ctype_alnum($_POST['par_position'])){
		$position = $_POST['par_position'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	$checktyp = getdatafromsql($conn,"select * from c_master_positions where md5(sha1(md5(concat(pos_id,
					'erihfiuekrhskuheurhs uheudrhgfud hiurehgiuehs98')))) ='".$position."'");
	if(is_array($checktyp)){
		$position = $checktyp['pos_id'];
	}else{
		die('Invalid Position');
	}
	############################33333333
	if(isset($_POST['par_house']) and ctype_alnum($_POST['par_house'])){
		$house = $_POST['par_house'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	$checktyp2 = getdatafromsql($conn,"select * from c_master_houses where md5(sha1(md5(concat(ho_id,
					'iufheurgurehgu wrfwuirhsf iurs')))) ='".$house."'");
	if(is_array($checktyp2)){
		$house = $checktyp2['ho_id'];
	}else{
		die('Invalid House');
	}



/*___________________________________________________________________________________________________________*/
	if($conn->query("INSERT INTO `d_participants`( `pa_name`, `pa_adm_no`, `pa_rel_ho_id`, `pa_rel_pos_id`) VALUES (
	'".$nm."',
	'".$admno."',
	'".$house."',
	".$position."
	)")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['EVT_USR_DB_ID'],'d_participants','insert', "INSERT INTO `d_participants`( `pa_name`, `pa_adm_no`, `pa_rel_ho_id`, `pa_rel_pos_id`) VALUES (
	'".$nm."',
	'".$admno."',
	'".$house."',
	".$position."
	)",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMAkejgnioejrfnkjESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: admin_parts.php');
	}else{
		die($conn->error.'ERRMAGjenfiu4eroT%HTIEB(FD');
	}
}
#
#
if(isset($_POST['edit_par'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_edit_par'])){
		if(ctype_alnum(trim($_POST['hash_edit_par']))){
			$editmun = getdatafromsql($conn,"select * from d_participants where md5(md5(sha1(sha1(md5(md5(concat(pa_id,'jwfuiejrsijfiejsrijnn'))))))) = '".$_POST['hash_edit_par']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}

	############################33333333
	if(isset($_POST['edit_par_lngnme'])){
		$nm = $_POST['edit_par_lngnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_par_admno']) and is_numeric($_POST['edit_par_admno'])){
		$admno = $_POST['edit_par_admno'];
	}else{
		die('Enter all Fields Correctly 1');
	}
	############################33333333
	if(isset($_POST['edit_par_house']) and ctype_alnum($_POST['edit_par_house'])){
		$house = $_POST['edit_par_house'];
	}else{
		die('Enter all Fields Correctly 2');
	}
	
	$checktyp2 = getdatafromsql($conn,"select * from c_master_houses where md5(sha1(md5(concat(ho_id,
					'kjrhvuerhgfehsrjhtekhs5riu gkesjtrhgu k')))) ='".$house."'");
	if(is_array($checktyp2)){
		$house = $checktyp2['ho_id'];
	}else{
		die('Invalid House');
	}
	############################33333333

	if(1==0){
		#You have not been authorised by SBSEVOTE but by trustee so the user has to grant your changes #
		die("You have not been authorised by SuperUser ");
	}else{
		if($conn->query("UPDATE `d_participants` SET 
`pa_name`= '".$nm."',
`pa_adm_no`='".$admno."',
`pa_rel_ho_id`='".$house."'
where pa_id = ".trim($editmun['pa_id'])."")){
	
	
	##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['EVT_USR_DB_ID'],'d_participants','update',"UPDATE `d_participants` SET 
`pa_name`= '".$nm."',
`pa_adm_no`='".$admno."',
`pa_rel_ho_id`='".$house."'
where pa_id = ".trim($editmun['pa_id'])."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMAekjrgivuedgueiBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_parts.php');
		}else{
			die('ERRMAerskiroiehgfuiehdriufghnjr3ei9jinj');
		}
	}

}
#
#

if(isset($_POST['add_vote'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('No User found');
		}
	}else{
		die('Login to do this action');
	}
	
	
$checks = "SELECT * FROM c_master_positions c where pos_class_valid <= ".$getdatus['lum_class']." and pos_user_type = ".$getdatus['lum_type']."  and pos_valid = 1 and pos_id not in (SELECT vb_rel_pos_id FROM d_vote_bank where vb_rel_lum_id = ".$getdatus['lum_id']." and vb_valid =1 group by vb_rel_pos_id) ORDER BY pos_id LIMIT 1";

$checks = getdatafromsql($conn,$checks);


if(!is_array($checks)){
die("Vote Limit Exhausted<br>
Go to home page");
}


if(isset($_POST['vote_candid_h']) and ctype_alnum($_POST['vote_candid_h'])){
	$checkcandid = getdatafromsql($conn,"select * from d_participants where 
	md5(sha1(md5(sha1(md5(sha1(sha1(md5(md5(concat(pa_id,'uiyfhiery 937854 9378y gt9835y 98y359 gyuygh ayan 873987 yhgehiusig hiuehuhgiuhegheuhrghuhuihhioait yerthiutiuetuierhtiuht iuehrtiuhuihr tiuhreiuheuih iuehgrhgghiuehgriuhaiuiurheiuhgiurehguiohaeoriugh93854t7y39 y2099 090342eioij bh97gh .;;i3 uh8935'))))))))))=
	 '".$_POST['vote_candid_h']."' and pa_valid =1");
}else{
	die('Invalid Candidate ERRLEVEL7');
}

if(trim($checks['pos_id']) !== trim($checkcandid['pa_rel_pos_id'])){
	die('You are not allowed to vote for this position yet');
}


if($checks['pos_type'] == 1){
	#housewise
	if(trim($checkcandid['pa_rel_ho_id']) == trim($getdatus['lum_house'])){
	}else{
		die("Candidate\'s House and your house are not the same");
	}

}

if(trim($checks['pos_class_valid']) <= trim($getdatus['lum_class'])){
}else{
	die('You are not eligible to vote for this position');
}

$insql = "INSERT INTO `d_vote_bank`(`vb_rel_lum_id`, `vb_rel_pos_id`, `vb_rel_pa_id`, `vb_ip`, `vb_time`) VALUES (
'".trim($getdatus['lum_id'])."',
'".trim($checks['pos_id'])."',
'".trim($checkcandid['pa_id'])."',
'".trim($_SERVER['REMOTE_ADDR'])."',
'".time()."'
)";

if($conn->query($insql)){
	header('Location:acomp.php');
}else{
	die('ERRMA(ERROR inserting vote '.encrypt($conn->error,'oiu4r845 egh3erfiduh3804wu9fui4nert g874y5t8o g4il5dt ugo8iued5 thygued h5urthyu5d hrtygue hdto8u3he 4oru3oies4urjifk4heisrxbf jeka hruygfbrdtg5r5d7t8g4v8tr7g45ed4xrd05 2sdx5e4sr5 e48s0 w4886e 68sr0gf48e408s gesr40g8e 4rs8043').')');
}
}
##
##
if(isset($_POST['add_archive'])){
	if(isset($_SESSION['EVT_USR_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from b_sm_logins where lum_id = ".$_SESSION['EVT_USR_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	
	
	$tab = array('a_ms_views','a_pg_click',
            'a_page_views',
            'a_sv_user_logs','b_sv_auth_fail','b_sv_auth_pass','b_sm_logins','c_master_positions','d_participants','d_vote_bank');
			
			$newm = time();
	if(EXPORT_TABLES($conn,$newm,$tab)){
	}else{
		die('0');
	}
	
	$insqq = "INSERT INTO `f_sv_backups`(`bckp_name`, `bckp_table_name`, `bckp_src`, `bckp_rel_lum_admno`, `bckp_dnt`, `bckp_ip`) VALUES ('".$newm."','".implode(', ',$tab)."',
	'backups/".$newm.".sql',".$getdatus['lum_username'].",'".time()."','".$_SERVER['REMOTE_ADDR']."')";
	
	if($conn->query($insqq)){
	}else{
		die('ErrMa Uploading Backup To server');
	}
	
	
foreach($tab as $t){
	$sqlq = "truncate ".$t;
	if($conn->query($sqlq)){
	}else{
		die('ERR truncating '.$t.' '.$conn->error);
	}
	
}


$insqq = "INSERT INTO `b_sm_logins`(
`lum_name`, `lum_username`, `lum_password`, `lum_y`, `lum_m`, `lum_d`, `lum_hash`, `lum_class`, `lum_section`, `lum_house`, `lum_ad`, `lum_ad_level`) VALUES (
'".trim($getdatus['lum_name'])."',
'".trim($getdatus['lum_username'])."',
'".trim($getdatus['lum_password'])."',
'".trim($getdatus['lum_y'])."',
'".trim($getdatus['lum_m'])."',
'".trim($getdatus['lum_d'])."',
'".trim($getdatus['lum_hash'])."',
'".trim($getdatus['lum_class'])."',
'".trim($getdatus['lum_section'])."',
'".trim($getdatus['lum_house'])."',
'".trim($getdatus['lum_ad'])."',
'".trim($getdatus['lum_ad_level'])."'

)";
	
	if($conn->query($insqq)){
	}else{
		die('ErrMa Uploading Backup To server');
	}
	

	
	header('Location: admin_archive.php');
	
		

}

?>








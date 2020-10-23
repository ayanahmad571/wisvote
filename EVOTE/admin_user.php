<?php
include('include.php');
?>
<?php 
include('page_that_has_to_be_included_for_every_user_visible_page.php');
?>

<?php

if($login == 1){
	if(trim($_USER['lum_ad']) == 1){
		$admin = 1;
	}else{
		$admin = 0;
	}
}else{
	$admin = 0;
	die('Login to View this page <a href="login.php"><button>Login</button></a>');
}


if($admin == 0){
	die('<h1>503 </h1><br>
Access Denied');
}

$sed = getdatafromsql($conn,"select * from e_sv_modules where mo_href = '".basename($_SERVER['PHP_SELF'])."'");
if(is_array($sed)){

}else{
	die('ErrorADMM(UH');
}


if($_USER['lum_ad_level'] >= $sed['mo_min_ad_level']){
}else{
	die('<h1>503 </h1><br>
Access Denied');
}






?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
    <link href="assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

        
    </head>


    <body>

        <!-- Aside Start-->
        <aside class="left-panel">

             
        <?php
		give_brand();
		?>
            <?php 
			get_modules($conn,$login,$admin,$_USER);
			?>
                
        </aside>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">
                    

                    <!-- Right navbar -->
                    <?php
                    if($login==1){
						include('ifloginmodalsection.php');
					}
					?>
                    
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
            <div class="page-title"> 
                    <h3 class="title">Welcome <?php echo ucwords($_USER['lum_name'])?> !</h3> 
                </div>



                 <!-- end row -->

                <div class="row">
                    

                    <div class="col-lg-12	">

                        <div class="panel panel-default"><!-- /primary heading -->
                            <div class="portlet-heading">
      
                            <div class="panel-heading">
                                <h3 class="panel-title">Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->

                               <?php

if($_USER['lum_ad_level'] == 10){
	$boxsql = "SELECT * FROM `votes_details_all` ";

}else{
	$boxsql = "SELECT * FROM `votes_details` where lum_valid =1";

}
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		if($boxrw['lum_valid'] == 1){




			if(($boxrw['lum_id'] == $_SESSION['EVT_USR_DB_ID']) and ($boxrw['lum_id'] !== '1') ){
				
				$give = '';
			$bg = 'info';
			
			
		}else{
			
			
			$give = '
			<form action="master_action.php" method="post">
		<input name="yh_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['lum_id'].'hir39efnewsfejirjrjdnjjenfkv ijfkorkvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger m-t-20" name="usr_make_inac" value="Disable" />
';			$bg = 'info';
			
		}
		




		}else{
			if(($boxrw['lum_id'] == $_SESSION['EVT_USR_DB_ID']) and ($boxrw['lum_id'] !== '1') ){
				
				$give = '';
			$bg = 'danger';
			
			
		}else{
			
			
			$give = '<form action="master_action.php" method="post">
		<input name="yh_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['lum_id'].'hir39efnewsfejirjeofkvjrjdnjjenfkvkijonreij3nj')))))).'" />
			<input type="submit" class="btn btn-success m-t-20" name="usr_make_ac" value="Enable" />
			';
			$bg = 'danger';
			
		}
		
		
			
		}
		
		
		
		if($boxrw['lum_ad'] == 0){
			$admi_p = 'Not Admin';
		}else{
			$admi_p= 'Admin';
		}
		
		if(($boxrw['lum_id'] == $_SESSION['EVT_USR_DB_ID']) and ($boxrw['lum_id'] !== '1') ){
			$give .= '&nbsp;&nbsp;&nbsp;<a  data-toggle="tooltip" data-placement="top" title="You are logged in with this account. Log out to make any changes " class="btn btn-sm btn-danger m-t-20 ion-edit"></a></form>';
		}else{
			$give .= '&nbsp;&nbsp;&nbsp;<a data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['lum_id']))).'" class="btn btn-sm btn-warning m-t-20 ion-edit"></a></form>';
		}
		

		
		echo '
<div class="col-xs-12">
	<!-- Start Profile Widget -->
	<div style="border:1px grey solid" class="profile-widget text-center">
		<div class="bg-'.$bg.' bg-profile"></div>
		<img src="';
		
		
if($boxrw['lum_type'] == 1){
	echo "http://stepsys.org/files/images/stu_pics/".$boxrw['lum_image'].'_'.$sbssessid;
}else{
	echo "http://sbs-school.org/sbsweb/files/staffimages/".$boxrw['lum_image'];
}

		echo'.jpg" class="thumb-lg img-circle img-thumbnail" alt="img">
		<h3>'.$boxrw['lum_name'].'</h3>
		'.$give.'
		<ul class="list-inline widget-list clearfix">
			<li class="col-md-4"><span>'.$boxrw['lum_name'].'</span>Name</li>
			<li class="col-md-4"><span>'.$admi_p.'</span>Admin</li>
			<li class="col-md-4"><span>'.$boxrw['lum_ad_level'].'</span>Admin Level</li>
			<li class="col-md-12"><span>'.$boxrw['lum_username'].'</span>Login Username</li>
			<li class="col-md-12"><span>'.$boxrw['lum_email'].'</span>Email</li>
		</ul>
	</div>
	<!-- End Profile Widget -->
</div>

                                        
	';
	if(($cc % 1) == 0){
		echo '</div><div class="row">';
	}
	$cc++;
	#first loop ends
	$munsclaimed = 'None';
    }
} else {
    echo "0 results";
}
 ?> 
 
 
                                        
                                 
                                        <!-- -->
                                    </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    
                </div> <!-- End row -->


            </div> <!-- End row -->


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            
       
 <?php
if($_USER['lum_ad_level'] == 10){
	$msql  = "SELECT * FROM `votes_details_all` ";

}else{
	$msql = "SELECT * FROM `votes_details` where lum_valid =1";

}
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		foreach($mrw as $me=>$m){
			$mrw[$me] = trim($m);
		}
		echo '
<div id="'.md5(md5(sha1($mrw['lum_id']))).'" class="modal fade" role="dialog">
  <div class="modal-full modal-dialog">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['lum_name'].'</h4>
      </div>
      <div class="modal-body">
        <form action="master_action.php" method="post">
		
<div class="form-group">
	<label>Name: </label>
	<input name="edit_us_nme" type="text" class="form-control" value="'.$mrw['lum_name'].'"/>
</div>

<div class="form-group">
	<label>Admin: </label>
	<input name="edit_us_adm" type="number" min="0" max="1" class="form-control" value="'.$mrw['lum_ad'].'"/>
</div>

<div class="form-group">
	<label>Access Level: </label>
	<input name="edit_us_amdlvl" type="number" min="" max="10" class="form-control" value="'.$mrw['lum_ad_level'].'"/>
</div>







<div class="row">
	<div class="col-xs-6">
	<input type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['lum_id'].'f2frbgbe 2fgtegrfr3gbter 24rfgr324frgtr3f 3gr32fgr32f4gr')))))).'" name="hash_chkr" />
		<input style="float:right" type="submit" class="btn btn-success" name="edit_user" value="Save">
	</div>
	<div class="col-xs-6">
		<button type="reset" class="btn btn-danger">Reset</button>
	</div>
</div>
	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


  </div>
</div>
		
	';
	
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?>             
                  <!-- Footer Start -->
            <footer class="footer">
<?php auto_copyright(); // Current year?>

  AhmadAnonymous.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
  


      <?php  
	  get_end_script();
	  ?>   
       <script src="assets/timepicker/bootstrap-datepicker.js"></script>


<script>
$(document).ready(function() {
	$('.datepicker').datepicker();		
});
</script>
      
           </body>

</html>

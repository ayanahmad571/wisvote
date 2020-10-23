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

$sed = getdatafromsql($conn,"select * from sm_modules where mo_href = '".basename($_SERVER['PHP_SELF'])."'");
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
<meta http-equiv="refresh" content="100" >

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
                 <!-- end row -->
                <div class="row">
                    

                    <div class="col-lg-12	">
<h3><?php echo (date('d',time()) * 1).'/'.(date('m',time()) * 1).date('/Y @ h:i:s A',time()); ?></h3>
                        <div class="panel panel-default"><!-- /primary heading -->
                            <div class="portlet-heading">
      
                            <div class="panel-heading">
                                <h3 class="panel-title">Stock Market Simulation Session Management</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                    <div class="row">
                                    <div class="col-xs-12">
                                    <?php

$oxsql = "SELECT * FROM `sm_sessions` a
where a.sess_from <= '".(time())."' and a.sess_till >= '".time()."' and a.sess_valid =1";
$oxres = $conn->query($oxsql );

if ($oxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($oxrw = $oxres->fetch_assoc()) {
		#firts loop begins
		echo '

	

                                        
	';
	$done = round((((time() - trim($oxrw['sess_from']))/(trim($oxrw['sess_till']) - trim($oxrw['sess_from'])))*100),1)
	  ?>
    <div class="col-md-12">
    <div class="row">  
      <div class="progress">
                                    <div class="progress-bar progress-bar-pink progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $done; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $done; ?>%;">
                                        <span class=""><?php echo $done; ?>% </span>
                                    </div>
                                </div>
                                
                                </div>
                                
                          
      <div class="row">                          
<strong>Time left (s)</strong>: <?php echo ($oxrw['sess_till'] - time()) ?> seconds                                
</div>
    <br>

      <div class="row">
    <form action="master_action.php" method="post">
    <input  type="hidden" name="hash_ffipa" value="<?php echo md5(sha1(md5('woi4jhfoiehrguijvnes'.$oxrw['sess_id']))) ?>"/>
   	 <button type="submit" class="btn btn-danger btn-lg">Stop Session</button>
    </form>
    </div>
    
<hr>
	
</div>

    <?php
	if(($cc % 1) == 0){
		echo '</div><div class="row">';
	}
	$cc++;
	#first loop ends
    }
} else {
 ?>
                                     <form action="master_action.php" method="post" >

  <div class="col-md-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">Add Session</h3> 
		</div> 
		<div class="panel-body"> <!--
			<p>Starting in: <input class="form-control" required name="sess_in_min" type="text" placeholder="Minutes to start this new session after eg:10" /></p> -->
			<p><input class="btn btn-success "   name="sess_add" type="submit" value="Add Session"/></p> 
		</div> 
	</div>
</div>
</form>
 <?php
}
 ?> 
 
                                    </div>
                                    </div>
 
                                        <!-- --></div>
                                        
                                        <div class="row">
                                         <?php

$boxsql = "SELECT * FROM `sm_sessions` a 
left join `b_sm_logins` b on a.sess_gen_rel_lum_id = b.lum_id 
left join `sm_logins_rel` c on a.sess_gen_rel_lum_id = c.l_rel_lum_id order by sess_gen_dnt DESC";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		if($cc == 1){
			$lates= ' (Latest)';
		}else{
			$lates = '';
		}
		#firts loop begins
		echo '
<div class="col-md-6">
	<div ';
			if($boxrw['sess_valid']==1){
				echo '
style="border:1px solid green" ';
			}else{
				echo'
style="border:1px solid red" ';
			}
			echo' class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">'.$boxrw['sess_id'].' '.$lates.'<span style="float:right">
			</span></h3> 
		</div> 
		<div class="panel-body"> 
			<p><strong>Started by</strong>: '.$boxrw['l_usr_name'].'</p> 
			<p><strong>Session From</strong>: '.date('D, d M Y , h:i:s A',$boxrw['sess_from']).'  <br>
<strong>Session Till</strong>: '.date('D, d M Y , h:i:s A',$boxrw['sess_till']).'</p><br>
 
<hr>
<strong>TS</strong>:'.time().'
<hr>			<p><strong>Session generated on</strong>: '.date('D, d M Y , h:i:s A',$boxrw['sess_gen_dnt']).'</p> 
			<p>
			';
			if($boxrw['sess_valid']==1){
				echo '
<hr style="border-bottom:6px solid green;border-radius:5px">';
			}else{
				echo'
<hr style="border-bottom:6px solid red;border-radius:5px">';
			}
			echo'
			</p>
			
		</div> 
	</div>
</div>
                                        
	';
	if(($cc % 2) == 0){
		echo '</div><div class="row">';
	}
	$cc++;
	#first loop ends
    }
} else {
    echo "No sessions Found";
}
 ?> 
 
 
                                        
                                 
                                        <!-- -->
                                    </div> </div>
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
            
            <!-- Footer Start -->
            
 
            
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

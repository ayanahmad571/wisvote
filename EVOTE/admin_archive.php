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
                                <h3 class="panel-title">Repository</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT * FROM `f_sv_backups`";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		echo '
<div class="col-md-6">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">'.$boxrw['bckp_name'].'</h3> 
		</div> 
		<div class="panel-body"> 
			<p>Table Name: <em style="color:blue">'.$boxrw['bckp_table_name'].'</em></p> 
			<p>Src: <em style="color:blue">'.$boxrw['bckp_src'].'</em></p> 
			<p>Time: '.date("D, d M Y @ H:i:s",$boxrw['bckp_dnt']).'</p> 
			';
			echo'
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
    echo "No Repositories Found";
}
 ?> 
 <form action="master_action.php" method="post" >
 <div class="col-md-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">Archive Current Schema</h3> 
		</div> 
		<div class="panel-body"> 
        	<p>
            <ul class="list">
            <li>Archive and Truncate <strong>a_ms_views</strong>,
            <strong>a_pg_click</strong>,
            <strong>a_page_views</strong>,
            <strong>a_sv_user_logs</strong></li>
         
            <li>Archive and Truncate <strong>b_sv_auth_fail</strong>,
            <strong>b_sv_auth_pass</strong></li>

            <li>Archive and Truncate <strong>b_sm_logins <u>(except 741)</u></strong>,
            <strong>c_master_positions</strong>,
            <strong>d_participants</strong>,
            <strong>d_vote_bank</strong></li>
            </ul>
            </p>
			<p><input type="hidden" name="add_archive" value="2" /></p>
			<p><button type="submit" class="btn btn-block btn-lg btn-success">Archive</button></p>
		</div> 
	</div>
</div>
 </form>
 
                                        
                                 
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
           </body>

</html>

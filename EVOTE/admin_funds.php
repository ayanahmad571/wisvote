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
                    <h3 class="title">Welcome <?php echo ucwords($_USER['l_usr_name'])?> !</h3> 
                </div>



                 <!-- end row -->

                <div class="row">
                    

                    <div class="col-lg-12	">

                        <div class="panel panel-default"><!-- /primary heading -->
                            <div class="portlet-heading">
      
                            <div class="panel-heading">
                                <h3 class="panel-title">Wallet Funds</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT * FROM `b_sm_logins` a 
left join sm_logins_rel b on a.lum_id = b.l_rel_lum_id
left join p_balance c on a.lum_id = ifnull(c.wf_rel_lum_id,a.lum_id) 
where a.lum_valid = 1 and b.l_usr_valid = 1";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins

?>

                    <div class="col-lg-6">
                        <!-- Start Profile Widget -->
                        <div class="profile-widget text-center">
                            <div class="bg-info bg-profile"></div>
                            <img src="http://stepsys.org/files/images/stu_pics/<?php echo $boxrw['l_usr_adm_no'] ?>_<?php echo $sbssessid; ?>.jpg" class="thumb-lg img-circle img-thumbnail" alt="img">
                            <h3><?php echo $boxrw['l_usr_name'] ?></h3>
                            <h4>&#8377; <?php if(is_null($boxrw['wf_balance'])){echo '0';}else{echo number_format($boxrw['wf_balance'],3);}  ?></h4>
                        </div>
                        <!-- End Profile Widget -->
                    </div>


<?php	if(($cc % 2) == 0){
		echo '</div><div class="row">';
	}
	$cc++;
	#first loop ends
    }
} else {
    echo "0 results";
}
 ?> 
 <form action="master_action.php" method="post" >
 <div class="col-md-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">Add Wallet Funds</h3> 
		</div> 
		<div class="panel-body"> 
			<p>User: 
            <select class="form-control" required name="add_wlt_fund_usrid" >
            
            <?php
$sql = "SELECT * FROM `b_sm_logins` a 
left join sm_logins_rel b on a.lum_id = b.l_rel_lum_id
where a.lum_valid = 1 and b.l_usr_valid = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo md5(md5(sha1(md5('erjfgviuerdhghvex'.$row['lum_id'])))) ?>">
        <?php echo $row['l_usr_name'] ?></option>
        <?php
    }
} else {
    echo "<option>No users found</option>";
}
 ?> 
            </select>
            
            
</p>			<p>Amount to be added: 
<input class="form-control"  required  name="add_funds_fund" type="number" max="10000000" min="0" placeholder=" Upto 1 crore" /></p> 
			<p><input class="btn btn-success "   name="fund_add" type="submit" value="Add Funds"/></p> 
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
       <script src="assets/timepicker/bootstrap-datepicker.js"></script>


<script>
$(document).ready(function() {
	$('.datepicker').datepicker();		
});
</script>
      
           </body>

</html>

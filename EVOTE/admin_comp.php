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
                                <h3 class="panel-title">Companies</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                  <form action="master_action.php" method="post" >
 <div class="col-xs-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">Add new Company to Listing</h3> 
		</div> 
		<div class="panel-body"> 
            <p>Company Name: <input class="form-control" required  name="a_comp_nm" type="text" placeholder="Tata Steel " /></p>
            
            <hr>
            <h3>Prices</h3>
<div class="row">
<div class="col-xs-12">
	<input required name="stck_pr_b" placeholder="Base Price" type="text" class="form-control" />
</div><br>

<hr>
<?php 
for($rr =1;$rr<46;$rr++){
	echo '
<div class="col-xs-2">
	<input required name="stck_pr_up_'.$rr.'" placeholder="Update no. '.$rr.' " type="text" class="form-control" />
</div>
';

if(($rr % 6) == 0){
	echo '</div><br><div class="row">';
}
}

?>            
</div>            
            
            </div>

			<p><input class="btn btn-success " name="a_comp_add" type="submit" value="Add Company"/></p> 
		</div> 
	</div>
 </form>

                                </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                   
                                    <br>


                                    
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT * FROM `sm_stocks` where stck_valid =1";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		if((($cc-1) > 0) and (($cc-1) % 3) == 0){
			echo '</div><div class="row">';
		}

		
		echo '
<div class="col-md-4">
	<div ';
			if($boxrw['stck_valid']==1){
				echo '
style="border:5px solid green" ';
			}else{
				echo'
style="border:4px solid red" ';
			}
			
			
			
			
			echo' class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">'.$boxrw['stck_name'].'<span style="float:right">
			<a data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['stck_id'].'hfrjeidi'))).'" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body">  

<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1">
	
	<img style="width:100%" src="'.$boxrw['stck_img'].'" alt="'.$boxrw['stck_name'].'" />
	</div>
	</div>
	<br>


			<h2 align="center">'.$boxrw['stck_name'].'</h2> 
			

			<p>
			';
			if($boxrw['stck_valid']==1){
				echo '
<hr style="border-bottom:6px solid green;border-radius:5px">';
			}else{
				echo'
<hr style="border-bottom:6px solid red;border-radius:5px">';
			}
			echo'
			</p>

			<p>
			';
			if($boxrw['stck_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['stck_id'].'egkjtnr newsdnjjenfkv ijfkorkvnkorvfk')))))).'" />
			<input type="submit" class="btn btn-danger" name="com_make_inac" value="Make InActive" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="ha_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['stck_id'].'jijnfiirjfnirokijfkorkvnkorvfk')))))).'" />
		<input type="submit" class="btn btn-success" name="com_make_ac" value="Make Active" />
		</form>';
			}
			echo'
			</p>
		</div> 
	</div>
</div>
                                        
	';
	
	$cc++;
	#first loop ends

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


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            
 <?php

$msql = "SELECT * FROM `sm_stocks` where stck_valid =1";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		
		echo '
<div id="'.md5(md5(sha1($mrw['stck_id'].'hfrjeidi'))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['stck_name'].'</h4>
      </div>
      <div class="modal-body">
	 
        <form action="master_action.php" method="post">




<div class="form-group">
	<label>Company</label>
	<input type="text" name="stck_edit_fullnme" class="form-control" value="'.$mrw['stck_name'].'">
</div>

<div class="form-group">
	<label>Image Url:</label>
	<input type="text" name="stck_edit_img" class="form-control" value="'.$mrw['stck_img'].'">
</div>




<br>
<hr>
<br>
';

$getpr= "SELECT stp_pos,stp_val FROM sm_stocks_price_rel s where stp_rel_stck_id =".$mrw['stck_id']." and stp_valid =1
order by stp_pos asc ";
$getprres = $conn->query($getpr);
$dataobj = array();
if ($getprres->num_rows > 0) {
    // output data of each row
	
    while($getprrw = $getprres->fetch_assoc()) {
        $dataobj[] = $getprrw;
    }
} else {
    
}
if(count($dataobj) < 40){
		$dataobj[$rr]['stp_val'] = '';
	}
echo'
<div class="row"> 
<div class="col-xs-12">
	<input required name="stck_pr_ed_b" placeholder="Base Price" type="text" value="'.$dataobj[0]['stp_val'].'" class="form-control" />
</div>
<br>
<hr>
';
for($rr =1;$rr<46;$rr++){
	if(count($dataobj) < 40){
		$dataobj[$rr]['stp_val'] = '';
	}
	echo '
<div class="col-xs-2">
	<input required name="stck_pr_edit_up_'.$rr.'" value="'.$dataobj[$rr]['stp_val'].'" placeholder="Update no. '.$rr.' " type="text" class="form-control" />
</div>
';

if(($rr % 6) == 0){
	echo '</div><br><br><div class="row">';
}
}

echo '</div><div class="row">
	<div class="col-xs-6">
		<input name="h_com" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['stck_id'].'9irbfheierifhe3 4r3r04 j49i4u49igrhru9git')))))).'" />
		<input name="edit_stck" style="float:right" type="submit" class="btn btn-success" value="Save" />
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
	?>
    
    
    
    <?php
	
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

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
                                <h3 class="panel-title">Positions</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <!-- -->
                                         <?php

$boxsql = "SELECT * FROM `c_master_positions` c left join c_master_vote_types t on c.pos_type = t.vt_id";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		echo '
<div class="col-md-4">
	<div ';
			if($boxrw['pos_valid']==1){
				echo '
style="border:5px solid green" ';
			}else{
				echo'
style="border:4px solid red" ';
			}
			echo' class="panel panel-color panel-inverse">
		<div class="panel-heading"> 
			<h3 class="panel-title">'.$boxrw['pos_title'].'<span style="float:right">
			<a data-toggle="modal" data-target="#'.md5(md5(sha1($boxrw['pos_id']))).'" style="color:white;" class="ion-edit"></a></span></h3> 
		</div> 
		<div class="panel-body"> 
		<p>'.$boxrw['pos_desc'].'</p>
		<hr>
			<p>Type: <em style="color:blue">'.ucwords(strtolower($boxrw['vt_desc'])).'</em></p> 
			<p>Min Class: '.$boxrw['pos_class_valid'].'</p> 
			<p>
			';
			if($boxrw['pos_valid']==1){
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
			if($boxrw['pos_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="hash_inc_pos" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['pos_id'].'hbujeio03ir94urghnjefr309i4wef')))))).'" />
			<input type="submit" class="btn btn-danger" name="pos_inact" value="Make InActive" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="hash_ac_pos" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($boxrw['pos_id'].'njhifverkof2njbivjwjbfurhib2jw')))))).'" />
		<input type="submit" class="btn btn-success" name="pos_act" value="Make Active" />
		</form>';
			}
			echo'
			</p>
		</div> 
	</div>
</div>
                                        
	';
	if(($cc % 3) == 0){
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
			<h3 class="panel-title">New Position</h3> 
		</div> 
		<div class="panel-body"> 
			<p>Position Title: <input class="form-control" required name="pos_title" type="text" placeholder="House Vice Captain" /></p> 
			<p>Position Description: <input class="form-control" required name="pos_desc" type="text" placeholder="This is for the vice house captain (1st choice)" /></p> 
            <p>Position Type: <select class="form-control" required name="pos_type">
            <?php
			$getty = "select * from c_master_vote_types";
			$getty = $conn->query($getty);
			
			if($getty->num_rows > 0){
				while($gettrw = $getty->fetch_assoc()){
					echo '<option value="'.md5(sha1(md5($gettrw['vt_id'].
					'ersjfvuehr8f9j398wou4 r98f3o4uw 8oug3wourhgn'))).'">'.$gettrw['vt_desc'].'</option>';
				}
			}else{
				echo '<option>No Type Found</option>';
			}
			
			?>
            </select>
            </p>
            <p>Min Class: <input class="form-control"  required  name="pos_min_class" type="number" max="12" min="0" placeholder="6 to 12" /></p> 
			<p>Status: <input class="form-control"  required  name="pos_valid" type="number" max="1" min="0" placeholder="1 or 0" /></p> 
			<p><input class="btn btn-success" name="pos_add" type="submit" value="Add Position"/></p> 
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
            
 <?php

$msql = "SELECT * FROM `c_master_positions` ";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		echo '
<div id="'.md5(md5(sha1($mrw['pos_id']))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['pos_title'].'</h4>
      </div>
      <div class="modal-body">
        <form action="master_action.php" method="post">
		
<div class="form-group">
	<label>Position Name : </label>
	<input type="text" name="edit_pos_lngnme" class="form-control" value="'.$mrw['pos_title'].'">
</div>

<div class="form-group">
	<label>Position Description : </label>
	<input type="text" name="edit_pos_desc" class="form-control" value="'.$mrw['pos_desc'].'">
</div>

<div class="form-group">
	<label>Minimum Class : </label>
	<input type="number" min="6" max="12" name="edit_pos_minadlvl" class="form-control" value="'.$mrw['pos_class_valid'].'">
</div>



<div class="row">
	<div class="col-xs-6">
	<input type="hidden" name="hash_i_1i" value="'.md5(md5(sha1(sha1(md5(md5($mrw['pos_id'].'lkoegnuifvh bnn njenn')))))).'"></input>
		<input name="edit_pos" style="float:right" type="submit" class="btn btn-success" value="Save" />
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

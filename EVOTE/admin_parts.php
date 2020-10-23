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

$boxsql = "SELECT * FROM `c_master_positions` ";
$boxres = $conn->query($boxsql);

if ($boxres->num_rows > 0) {
    // output data of each row
	$cc =1;
    while($boxrw = $boxres->fetch_assoc()) {
		#firts loop begins
		
?>

						<div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-heading text-center">
                              <h4 class="panel-title"><?php echo ucwords($boxrw['pos_title']); ?></h4>              
                            </div>
                            <div class="panel-body">
                                <ul class="list-group list-group-lg">
                                <?php
								if($boxrw['pos_type'] == 1){
																	$all_cans = getdatafromsql_all($conn,"select * from d_participants where pa_rel_pos_id = ".$boxrw['pos_id']." and pa_valid =1  order by pa_rel_ho_id");

								}else{
																	$all_cans = getdatafromsql_all($conn,"select * from d_participants where pa_rel_pos_id = ".$boxrw['pos_id']." and pa_valid =1");

								}
								
								if(is_array($all_cans)){
									foreach($all_cans as $candid){
										
									?>
                                    
                                    
                                    <?php 
				switch(trim(($candid['pa_rel_ho_id']))){

				case 1:
				$house_color= '#000000';
				$house_name = 'onyx';

				break;

				case 2:
				$house_color=  '#C91A1A';
				$house_name = 'ruby';

				break;

				case 3:
				$house_color=  '#009933';
				$house_name = 'emerald';

				break;

				case 4:
				$house_color=  '#b3b3b3';
				$house_name = 'diamond';

				break;	
					
				}
				
?>


<?php /*

<span class="pull-right label bg-danger inline m-t-10">
<form>
<input type="hidden" value="<?php
echo md5(sha1(md5(sha1(sha1(md5($candid['pa_id'].'oijtfu5ehtgurhtdlhfgu krutdhyurhtdug o4uetogu 4eou5tgr oiu4ridt khubkjrdtfkjnv'))))));
?>"/>
<input type="submit" name="" value="Remove"/></form>
</span>

 */ ?>
                                                            
                   
                  					<li class="list-group-item b-1">
                                        <a data-toggle="modal" 
                                        data-target="#<?php echo md5(md5(sha1($candid['pa_id']))); ?>" 
                                        class="pull-left" class=" m-r-10">
                                          <img src="stu_images/<?php echo $candid['pa_adm_no'] ?>.jpg" class="thumb-sm br-radius" alt="member">
                                        </a>
                                        <a  data-toggle="modal" 
                                        data-target="#<?php echo md5(md5(sha1($candid['pa_id']))); ?>">
										<?php echo $candid['pa_name'] ?></a>
                                        
                                        <span style="background-color:<?php echo $house_color; ?>" 
                                        class="pull-right label bg-info inline m-t-10"><?php echo ucwords($house_name); ?></span>
                                    </li>
                               
                                    <?php
									unset($house_color);
									unset($house_name);
									}
								}else{
									echo '
									 <li class="list-group-item b-0">
                                        <a href="#">No Candidates</a>
                                    </li>';
								}
								?>
                                    </ul>
                                    
                            </div> <!--Panel-body -->

                        </div> <!-- Panel-->
                    </div>
<hr>
<?php                                        
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
			<h3 class="panel-title">Add Candidate </h3> 
		</div> 
		<div class="panel-body"> 
			<p>Candidate Name: <input class="form-control" required name="par_name" type="text" placeholder="Arnav Mohan Gupta" /></p> 
			<p>Candidate admission number: <input class="form-control" required name="par_admno" type="number" placeholder="1234" min="0" max="8000" /></p> 
            <p>Position Standing for: <select class="form-control" required name="par_position">
            <?php
			$getty = "select * from c_master_positions";
			$getty = $conn->query($getty);
			
			if($getty->num_rows > 0){
				while($gettrw = $getty->fetch_assoc()){
					echo '<option value="'.md5(sha1(md5($gettrw['pos_id'].
					'erihfiuekrhskuheurhs uheudrhgfud hiurehgiuehs98'))).'">'.trim($gettrw['pos_title']).'</option>';
				}
			}else{
				echo '<option>No Position Found</option>';
			}
			
			?>
            </select>
            </p>
            <p>House: <select class="form-control" required name="par_house">
            <?php
			$gettys = "select * from c_master_houses";
			$gettys = $conn->query($gettys);
			
			if($gettys->num_rows > 0){
				while($gettrws = $gettys->fetch_assoc()){
					echo '<option value="'.md5(sha1(md5($gettrws['ho_id'].
					'iufheurgurehgu wrfwuirhsf iurs'))).'">'.trim(strtoupper($gettrws['ho_name'])).'</option>';
				}
			}else{
				echo '<option>No House Found</option>';
			}
			
			?>
            </select>
            </p>
			<p><input class="btn btn-success" name="par_add" type="submit" value="Add Participant"/></p> 
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

$msql = "select * from d_participants where pa_valid =1 ";
$mres = $conn->query($msql );

if ($mres->num_rows > 0) {
    // output data of each row

    while($mrw = $mres->fetch_assoc()) {
		#firts loop begins
		echo '
<div id="'.md5(md5(sha1($mrw['pa_id']))).'" class="modal fade" role="dialog">
  <div class="modal-dialog modal-full">

    <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editing '.$mrw['pa_name'].'</h4>
      </div>

      <div class="modal-body">
	  <div class="row">
		<div class="col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-xs-4 col-xs-offset-4">
		<img style=" width:100%" align="center" class="img-responsive img-rounded" src="stu_images/'.$mrw['pa_adm_no'].'.jpg" />
		
		</div>
		</div>
		
		<div class="row">
		
		<div class="col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-xs-4 col-xs-offset-4">
		<hr>
			';
			if($mrw['pa_valid']==1){
				echo '
		<form action="master_action.php" method="post">
		<input name="hash_inc_candid" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['pa_id'].'uirhfiuerkhu h5eiur htuikeh5riu ghetbf')))))).'" />
			<input  style="width:100%"  type="submit" class="btn btn-danger" name="candid_inact" value="Remove" />
		</form>
';
			}else{
				echo'
		<form action="master_action.php" method="post">
		<input name="hash_ac_candid" type="hidden" value="'.md5(md5(sha1(sha1(md5(md5($mrw['pa_id'].'heirhiufekhsiur; yguked ugrit')))))).'" />
		<input style="width:100%" type="submit" class="btn btn-success" name="candid_act" value="Make Active" />
		</form>';
			}
			echo'
		</div>
		</div>
        <form action="master_action.php" method="post">
		
<div class="form-group">
	<label>Candidate Name : </label>
	<input type="text" name="edit_par_lngnme" class="form-control" value="'.$mrw['pa_name'].'">
</div>

<div class="form-group">
	<label>Candidate Admission Number: </label>
	<input type="text" name="edit_par_admno" class="form-control" value="'.$mrw['pa_adm_no'].'">
</div>

<div class="form-group">
	<label>House: </label>';
	?>
    <select class="form-control" required name="edit_par_house">
            <?php
			$gettys2 = "select * from c_master_houses";
			$gettys2= $conn->query($gettys2);
			
			if($gettys2->num_rows > 0){
				while($gettrwss = $gettys2->fetch_assoc()){
					if($gettrwss['ho_id'] == $mrw['pa_rel_ho_id']){
						$selc = 'selected';
					}else{
						$selc = '';
					}
					echo '<option '.$selc.' value="'.md5(sha1(md5($gettrwss['ho_id'].
					'kjrhvuerhgfehsrjhtekhs5riu gkesjtrhgu k'))).'">'.trim(strtoupper($gettrwss['ho_name'])).'</option>';
				}
			}else{
				echo '<option>No House Found</option>';
			}
			
			?>
            </select>
    <?php
	
	echo'
</div>



<div class="row">
	<div class="col-xs-6">
	<input type="hidden" name="hash_edit_par" value="'.md5(md5(sha1(sha1(md5(md5($mrw['pa_id'].'jwfuiejrsijfiejsrijnn')))))).'"></input>
		<input name="edit_par" style="float:right" type="submit" class="btn btn-success" value="Save" />
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

  Anonymous.
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



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
	
}



			$checks = "SELECT * FROM c_master_positions c where pos_class_valid <= ".$_USER['lum_class']." and pos_user_type = ".$_USER['lum_type']."  and pos_valid = 1 and pos_id not in (SELECT vb_rel_pos_id FROM d_vote_bank where vb_rel_lum_id = ".$_USER['lum_id']." and vb_valid =1 group by vb_rel_pos_id) ORDER BY pos_id LIMIT 1";

$checks = getdatafromsql($conn,$checks);


if(!is_array($checks)){
	header('Location: logout.php?thanksforvoting');
	die();
}
?>

<!DOCTYPE html>
<html lang="en">
    
<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
<head>
        <?php get_head(); ?>
    <!-- Dropzone css -->

<style>
.mini-stat{
	border:1px solid black;
}
</style>
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
            <div class="wraper container-fluid">

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default p-0">
            <div class="panel-body p-0"> 
    		<div class="row">
            	<h2 class="text-center"><em><?php echo ucwords(strtolower($checks['pos_title'])) ?></em></h2>
			</div> 
            <hr>
<?php



if($checks['pos_type'] == 1){
$getcandids = "SELECT * FROM d_participants where pa_rel_pos_id = ".$checks['pos_id']." and pa_valid =1 and pa_rel_ho_id = ".$_USER['ho_id']." order by pa_name";
$getcountcandid = "SELECT count(*) as sumtotal FROM d_participants where pa_rel_pos_id = ".$checks['pos_id']." and pa_valid =1 and pa_rel_ho_id = ".$_USER['ho_id']." order by pa_name";

}else if($checks['pos_type'] == 2){
$getcandids = "SELECT * FROM d_participants where pa_rel_pos_id = ".$checks['pos_id']." and pa_valid =1 order by pa_name";
$getcountcandid = "SELECT count(*) as sumtotal FROM d_participants where pa_rel_pos_id = ".$checks['pos_id']." and pa_valid =1 order by pa_name";

}
?>      
<?php
$getcountcandid = getdatafromsql($conn,$getcountcandid);
if(is_array($getcountcandid)){
$totalcandid = $getcountcandid['sumtotal'];
}else{
	header('Location: home.php?noparticipantsfound'.$checks['pa_name']);
	die();
}

?>    
            <div class="row">
            	<?php 

$getcandidsres = $conn->query($getcandids);

if ($getcandidsres->num_rows > 0) {
	  
  if($totalcandid == 1){
	  $div_colmn = 4 ;
	  $divider = 1;
  }else{
	  if(($totalcandid) ==2){
		  $div_colmn = 4;
		  $divider = 2;
	  }else if(($totalcandid) == 3){
		  $div_colmn = 4;
		  $divider = 3;
	  }else if(($totalcandid) == 4){
		  $div_colmn = 3;
		  $divider = 4;
	  }else{
		  $div_colmn = 4;
		  $divider = 3;
	  }
  }


    // output data of each row
	$rrt = 1;
    while($candids = $getcandidsres->fetch_assoc()) {
?>
<div class="col-xs-<?php echo $div_colmn ?>">

<div class="panel panel-default m-b-10 m-l-10 m-r-10">
    <div class="panel-heading"> 
        <h3 class="panel-title text-center"><?php echo ucwords(strtolower($candids['pa_name'])); ?></h3> 
    </div> 
    <div class="panel-body"> 
<p align="center"><img style="width:175px;height:200px;" class="img-responsive img-rounded" 
src="stu_images/<?php echo $candids['pa_adm_no'] ?>.jpg" />
</p> 
    </div> <br>

    <form action="master_action.php" method="post">
<input name="vote_candid_h" type="hidden" value="<?php echo md5(sha1(md5(sha1(md5(sha1(sha1(md5(md5($candids['pa_id'].'uiyfhiery 937854 9378y gt9835y 98y359 gyuygh ayan 873987 yhgehiusig hiuehuhgiuhegheuhrghuhuihhioait yerthiutiuetuierhtiuht iuehrtiuhuihr tiuhreiuheuih iuehgrhgghiuehgriuhaiuiurheiuhgiurehguiohaeoriugh93854t7y39 y2099 090342eioij bh97gh .;;i3 uh8935'))))))))); ?>" />
<input type="hidden" name="add_vote" value="1"/>
<button type="submit" class="btn btn-block btn-lg btn-success">Click to Vote</button>
</form>

</div>


</div>


<?php
if(($rrt % $divider) == 0){
	echo '</div><div class="row">';
}
$rrt++;

    }
} else {
    echo '<script>window.location.href = "logout.php?thanksforvoting"</script>';
	die();
}
				
				?>
            </div>
            
            </div> 
        </div>
    </div>
</div>

            

            


        </div>

        <!-- Page Content Ends -->
        <!-- ================== -->

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

 
  </body>

<!-- the manprofile.htmlby ayan ahmad 07:31:23 GMT -->
</html>

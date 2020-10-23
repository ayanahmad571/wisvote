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

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
  <link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
        
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
            
         
<?php 
$house_color = "#0066ff";
				switch(trim(strtolower($_USER['ho_name']))){

				case 'onyx':	
				$house_color= '#000000';

				break;

				case 'ruby':
				$house_color=  '#C91A1A';

				break;

				case 'emerald':
				$house_color=  '#009933';

				break;

				case 'diamond':
				$house_color=  '#b3b3b3';

				break;	
					
				}
				
if($_USER['lum_type'] == 2){
$collg= 6;
$colsm =6 ;
}
else{
$collg= 3;
$colsm =6 ;

}


?>




<div class="row">
                    <div class="col-lg-<?php echo $collg; ?> col-sm-<?php echo $colsm; ?>">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i style="color:<?php echo $house_color;?>" class="fa fa-user text-info"></i> 
                            <h3 class="m-0"><?php echo ucwords($_USER['lum_name']); ?></h3>
                            <div>Name</div>
                        </div>
                    </div>
                    
<?php
if($_USER['lum_type'] == 1){?>


                    <div class="col-lg-<?php echo $collg; ?> col-sm-<?php echo $colsm; ?>">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i style="color:<?php echo $house_color;?>" class="ion ion-tshirt text-info"></i> 
                            <h3 class="m-0"><?php echo ucwords($_USER['ho_name']); ?></h3>
                            <div>House</div>
                        </div>
                    </div>
                    <div class="col-lg-<?php echo $collg; ?> col-sm-<?php echo $colsm; ?>">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i class="fa fa-sort-numeric-asc text-info"></i> 
                            <h3 class="m-0"><?php
								if($_USER['lum_type'] == 2){
									echo 'No Class';
								}else{
							 echo ucwords($_USER['lum_class_sec']); }?></h3>
                            <div>Class</div>
                        </div>
                    </div>
                    <?php
}
?>
                    
                    <div class="col-lg-<?php echo $collg; ?> col-sm-<?php echo $colsm; ?>">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i class="fa fa-ticket text-success"></i> 
                            <h3 class="m-0"><?php echo $_USER['votes_left']; ?></h3>
                            <div>Vote(s) Left</div>
                        </div>
                    </div>
                </div> <!-- end row -->
<div class="row">
  <?php
  if($_USER['votes_left'] <= 1){
	  $div_colmn = 12 ;
	  $divider = 1;
  }else if($_USER['votes_left'] >1){
	  if(($_USER['votes_left'] % 2) ==0){
		  $div_colmn = 6;
		  $divider = 2;
	  }else if(($_USER['votes_left'] % 3) ==0){
		  $div_colmn = 4;
		  $divider = 3;
	  }else{
		  $div_colmn = 4;
		  $divider = 3;
	  }
  }
$getvoting= "SELECT * FROM c_master_positions c where pos_class_valid <= ".$_USER['lum_class']." and pos_user_type = ".$_USER['lum_type']."  and pos_valid = 1 and pos_id not in (SELECT vb_rel_pos_id FROM d_vote_bank where vb_rel_lum_id = ".$_USER['lum_id']." and vb_valid =1 group by vb_rel_pos_id)";
$getvotingres= $conn->query($getvoting);

if ($getvotingres->num_rows > 0) {
    // output data of each row
	$rrt = 1;
    while($getvtrw = $getvotingres->fetch_assoc()) {
?>
    <div class="col-lg-<?php echo $div_colmn;?>">
        <div class="panel panel-color panel-warning">
            <div class="panel-heading"> 
                <h3 class="panel-title"><?php echo ucwords(strtolower($getvtrw['pos_title']));?></h3> 
            </div> 
            <div class="panel-body"> 
                <p><?php echo $getvtrw['pos_desc']; ?></p><br>
 			<form action="acomp.php" method="get">
            	<input type="hidden" name="vote_id" value="<?php
                echo md5(sha1(md5(sha1(md5(sha1(sha1(md5(md5($getvtrw['pos_id'].'uiyfhiery 937854 9378y gt9835y 98y359 gyuygh uy 4785y 873987 yhgehiusig hiuehuhgiuhegheuhrghuhuihhioait yerthiutiuetuierhtiuht iuehrtiuhuihr tiuhreiuheuih iuehgrhgghiuehgriuhaiuiurheiuhgiurehguiohaeoriugh93854t7y39 y2099 090342eioij bh97gh .;;i3 uh8935')))))))));
				?>" />
                <button type="submit" class="btn btn-block btn-lg btn-success">Click to Vote</button>
            </form>
            </div> 
        </div>
    </div>

<?php
if(($rrt % $divider) == 0){
	echo '</div><div class="row">';
}
$rrt++;
    }
} else {
	?>
    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
        <div class="panel panel-color panel-warning">
            <div class="panel-heading"> 
                <h3 class="panel-title text-center"><?php echo ucwords(strtolower("Thank you for voting"));?></h3> 
            </div> 
            <div class="panel-body"> 
                <p class=" text-center"><?php echo "Each Vote Counts !!" ?></p><br>
            </div> 
        </div>
    </div>

    <?php
}
 ?> 
</div>


                 <!-- End row -->



                <div class="row">
                     <!-- end col -->

                     <!-- end col -->

                    
                </div> <!-- End row -->


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
      
            
         <script src="assets/fullcalendar/moment.min.js"></script>
        <script src="assets/fullcalendar/fullcalendar.min.js"></script>
        <!--dragging calendar event-->
<script>
!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        
<?php 

if(isset($_GET['mailsent'])){
	echo ' $(document).ready(function(){
        swal("Mail Sent!", "An Email regarding the issue has been sent . You will get a reply to the specified email within a few days", "success")
    });';
}
?>
    //Success Message
   


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);
</script>
<?php 

if($login == 1){
	get_timer_sc(1);
}

?>
 
        


 
 <script>
 
<?php /*
$(document).ready(function(e) {
	
	
	



setInterval(function()
{ 
    $.ajax({
      type:"post",
	  data:{'lo_ejhrsk':'news'},
      url:"master_action.php",
	  success:function(data)
      {
        $("#page_news_refr").html(data);
		  //do something with response data
      }
    });
}, 5000);//time in milliseconds 






}); */ ?>

	
 </script>   


    </body>

</html>

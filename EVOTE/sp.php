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


                 <!-- End row -->



                <div class="row">
                     <!-- end col -->
    <div class="col-md-12">
        <div class="panel panel-color panel-warning">
            <div class="panel-heading"> 
                <h3 class="panel-title text-center"></h3> 
            </div> 
            <div class="panel-body"> 
                <p class=" text-center"><iframe src="https://drive.google.com/file/d/18k9_HU1nX4Q69X6nwAvCj5Ux_oUxjT9Z/preview" style="width:1240px; height:720px"></iframe></p><br>
            </div> 
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-color panel-warning">
            <div class="panel-heading"> 
                <h3 class="panel-title text-center"></h3> 
            </div> 
            <div class="panel-body"> 
                <p class=" text-center"><iframe src="https://drive.google.com/file/d/1V770xVMOLOrB4uBW9rpyHWY7mIS31kid/preview" style="width:1240px; height:720px"></iframe></p><br>
            </div> 
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-color panel-warning">
            <div class="panel-heading"> 
                <h3 class="panel-title text-center"></h3> 
            </div> 
            <div class="panel-body"> 
                <p class=" text-center"><iframe src="https://drive.google.com/file/d/1ok8Y0KBuiM-2TZ8YmTQBdSWqETtKV4Lu/preview" style="width:1240px; height:720px"></iframe></p><br>
            </div> 
        </div>
    </div>

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

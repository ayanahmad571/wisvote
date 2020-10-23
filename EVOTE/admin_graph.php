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


/*if($admin == 0){
	die('<h1>503 </h1><br>
Access Denied');
}
*/

$sed = getdatafromsql($conn,"select * from e_sv_modules where mo_href = '".basename($_SERVER['PHP_SELF'])."'");
if(is_array($sed)){

}else{
	die('ErrorADMM(UH');
}


/*if($_USER['lum_ad_level'] >= $sed['mo_min_ad_level']){
}else{
	die('<h1>503 </h1><br>
Access Denied');
}
*/





?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
 <?php  
	  get_end_script();
	  ?>   
        
	<script src="assets/flot-chart/jquery.flot.js"></script>
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
            <?php if(!isset($_GET['vote'])){
			?>
            
          
            <div class="page-title"> 
                    <h3 class="title">Winners Circle</h3> 
                </div>



                 <!-- end row -->

<div class="row">


<div class="col-lg-12	">

<div class="panel panel-default"><!-- /primary heading -->





<div class="panel-heading">
<h3 class="text-center  panel-title">Detailed (Graphed)</h3>
</div> 

<div class="panel col-xs-12">
           <?php
			  $sql = "SELECT * FROM c_master_positions";
$result = $conn->query($sql);
$x=1;
if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {



#NESTED START

echo '

<div class="panel panel-default"> 
	<div class="panel-heading"> 
		<h4 class="panel-title"> 
		'.ucwords($row['pos_title']).'
		</h4> 
	</div> 
	<div class="panel"> 
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-body">';


if($row['pos_type'] == 1){
$detdata  = 			  
			  
			  "
select p.*,count(*) as votes,h.* from d_vote_bank v
left join d_participants p on v.vb_rel_pa_id = p.pa_id

left join c_master_houses h on p.pa_rel_ho_id = h.ho_id

 where vb_valid = 1 and vb_rel_pos_id = ".$row['pos_id']."
group by vb_rel_pa_id order by pa_rel_ho_id desc,pa_name asc";
			 }else{
$detdata  = 			  
			  
			  "
select p.*,count(*) as votes from d_vote_bank v
left join d_participants p on v.vb_rel_pa_id = p.pa_id

 where vb_valid = 1 and vb_rel_pos_id = ".$row['pos_id']."
group by vb_rel_pa_id order by votes desc,pa_name asc";
			 }
			 
			 
			 

$datadettable = $conn->query($detdata);



if ($datadettable->num_rows > 0) {
	// output data of each row
	$votecount = array();
	$voterscount = array();
	$colors = array();
	$voterscountwithname = array();
	
	while($data = $datadettable->fetch_assoc()) {
		$votecount[] = $data['votes'];
		$voterscount[] = $data['pa_name'];
		switch(trim(($data['pa_rel_ho_id']))){

				case 2:
				$house_color= '#FF851B';

				break;

				case 3:
				$house_color=  '#C91A1A';

				break;

				case 1:
				$house_color=  '#F3C912';

				break;

				case 4:
				$house_color=  '#F3E812';

				break;	
					
				}
				$colors[] = '"'.$house_color.'"';
				
	}
	$rrtr = 0;
	foreach($voterscount as $voter){
		$voterscountwithname[] = '"'.$voter.' ('.$votecount[$rrtr].')"';
		$rrtr++;
	}
	
	?>
    <canvas id="w<?php echo md5($x); ?>" style=" height:100%"></canvas>
</div>

<script>
var ctx = document.getElementById("w<?php echo md5($x); ?>");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo implode(', ',$voterscountwithname); ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo implode(', ',$votecount); ?>]	,
			backgroundColor: [<?php echo implode(', ',$colors); ?>
            ],
            borderColor: [<?php echo implode(', ',$colors); ?>],	
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
		tooltips:{
			intersect:false
		}
    }
});


</script>


    <?php
	
	
}






echo '
                      

			
					';

                                	




#END NESTED
$x++;

echo ' 	</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->                                   
		</div> 
	</div> 
</div>
';							
			
								
					}
} else {
    echo "0 results";
}



###################################################?//////


//////////////////////////////////////////////

#



                                
?>              
         
          
<!--Dead-->

</div>
</div> <!-- end col -->


</div> <!-- End row -->


</div> <!-- End row -->


            </div>
<?php  }else{
	echo '<h1>No Results Before '.((date("h")*1)+2).'</h1>';
}
?>
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
  


      
           </body>

</html>

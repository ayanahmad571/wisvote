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
if($_USER['lum_ad_level'] >= $sed['mo_min_ad_level']){
}else{
	die('<h1>503 </h1><br>
Access Denied');
}

*/

$sed = getdatafromsql($conn,"select * from e_sv_modules where mo_href = '".basename($_SERVER['PHP_SELF'])."'");
if(is_array($sed)){

}else{
	die('ErrorADMM(UH');
}








?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
        <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
 <?php  
	  get_end_script();
	  ?>   
        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>
        
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
            <?php if(isset($_GET['vote'])){
			?>
            <div class="page-title"> 
                    <h3 class="title">Winners Circle</h3> 
                </div>



                 <!-- end row -->

<div class="row">


<div class="col-lg-12	">

<div class="panel panel-default"><!-- /primary heading -->
<div class="portlet-heading">

<div class="panel-heading">
<h3 class=" text-center  panel-title">Overview</h3>
</div>


<div class="panel-body">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="row">
<div class="panel-group" id="accordion-test-2"> 

    
           <?php
			  $sql = "SELECT * FROM c_master_positions";
$result = $conn->query($sql);
$x=0;
$rrtg = 1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {



#NESTED START
?>

<div class="panel panel-default"> 
                                <div class="panel-heading"> 
                                    <h4 class="panel-title"> 
                                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-<?php echo $rrtg; ?>" aria-expanded="false" class="collapsed">
                                            <?php echo $row['pos_title'] ?>
                                        </a> 
                                    </h4> 
                                </div> 
                                <div id="collapseOne-<?php echo $rrtg; ?>" class="panel-collapse collapse"> 
                                    <div class="panel-body">
<div class="col-md-12">
<div class="panel">
    <div class="panel-body">
        <ul class="list-group list-group-lg">

<?php
			 if($row['pos_type'] == 1){
$houses  = 			  
			  
			  "
select p.*,count(*) as votes,h.* from d_vote_bank v
left join d_participants p on v.vb_rel_pa_id = p.pa_id

left join c_master_houses h on p.pa_rel_ho_id = h.ho_id

 where vb_valid = 1 and vb_rel_pos_id = ".$row['pos_id']."
group by vb_rel_pa_id order by pa_rel_ho_id desc,votes desc,pa_name asc";
			 }else{
$houses  = 			  
			  
			  "
select p.*,count(*) as votes from d_vote_bank v
left join d_participants p on v.vb_rel_pa_id = p.pa_id

 where vb_valid = 1 and vb_rel_pos_id = ".$row['pos_id']."
group by vb_rel_pa_id order by votes desc,pa_name asc";
			 }
			 
			  
$finaldatares = $conn->query($houses);


if ($finaldatares->num_rows > 0) {
    // output data of each row
	$x=0;
    while($data = $finaldatares->fetch_assoc()) {
?>
<?php 
			if($row['pos_type'] == 1){	switch(trim(strtolower($data['ho_name']))){

				case 'tejas':
				$house_color= '#FF851B';

				break;

				case 'bhanu':
				$house_color=  '#C91A1A';

				break;

				case 'surya':
				$house_color=  '#F3C912';

				break;

				case 'bhaskar':
				$house_color=  '#F3E812';

				break;	
					
				}
				
			}
				
?>

<?php 
$x= $x+ $data['votes'];
?>
<li class="list-group-item b-0">
    <a href="#" class=" m-r-10">
      <img src="stu_images/<?php echo $data['pa_adm_no'] ?>_<?php echo $sbssessid; ?>.jpg" class="thumb-sm br-radius" alt="member">
    </a>
    <span class="pull-right label bg-success inline m-t-10"><?php echo $data['votes'] ?></span>
<?php if($row['pos_type'] == 1){?><span style="background-color:<?php echo $house_color; ?>" class="pull-right label bg-success inline m-t-10"><?php echo ucwords($data['ho_name']); ?></span><?php }
?>
    <a href="#"><?php echo $data['pa_name'] ?></a>
</li>

<?php		}
	
	}






?>
        </ul>
    </div> <!--Panel-body -->

    <div class="panel-footer white-bg text-center">
        <hr class="m-b-10"/>
<p>Total: <?php echo $x;  ?></p>
    </div> <!-- panel-footer-->
</div> <!-- Panel-->   
</div>
 </div> 
                                </div> 
                            </div>

<?php
                                	




#END NESTED


								
$rrtg++;			
								
					}
} else {
    echo "0 results";
}



###################################################?//////


//////////////////////////////////////////////

#



                                
?>              
         
          
    </div>
    </div>
</div>
</div>
</div>
<hr>



<div class="panel-heading">
<h3 class=" text-center panel-title">Detailed (Table)</h3>
</div>


<div class="panel-body">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="row">
<div class="panel-group" id="accordion-test-8"> 
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
                                        <a data-toggle="collapse" data-parent="#accordion-test-8" href="#collapseTwo-'.$x.'" aria-expanded="false" class="collapsed">
                                            '.ucwords($row['pos_title']).'                                        </a> 
                                    </h4> 
                                </div> 
                                <div id="collapseTwo-'.$x.'" class="panel-collapse collapse"> 
                                    <div class="panel-body">
									
									<div class="row">
            <div class="col-xs-12">
              <!-- /.box -->

              <div class="box">
                <div class="box-body">
                  <table id="example'.$x.'" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Student Name</th>
						<th>Student Pic</th>
                        <th>Class</th>
                        <th>House</th>
                        <th>Voted For</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
          ';

			 #lumadmno is now vb_rel_lum_id 
			$detdata  =  "SELECT
d.vb_rel_lum_id as lum_admno,
pa_name,
vb_rel_pa_id,
l.lum_name,
l.lum_type,
l.lum_image,
(concat(l.lum_class,'-',l.lum_section)) as lum_class,
h.ho_name

FROM d_vote_bank d

left join b_sm_logins l on cast(d.vb_rel_lum_id as UNSIGNED) = cast(l.lum_id as UNSIGNED)

left join c_master_houses h on l.lum_house = h.ho_id

left join d_participants pa on d.vb_rel_pa_id  = pa.pa_id

where d.vb_valid =1 and d.vb_rel_pos_id =".$row['pos_id'];

$datadettable = $conn->query($detdata);


if ($datadettable->num_rows > 0) {
    // output data of each row
    while($data = $datadettable->fetch_assoc()) {
		echo
'<tr>
                        <td>'.$data['lum_name'].'</td>
                        <td><img style="width:20%;margin-left:auto;margin-right:auto;" src="';
						 if($data['lum_type'] == 2){
	echo "http://sbs-school.org/sbsweb/files/staffimages/".$data['lum_image'];
							 
						 }else{
						 echo 'stu_images/'.$data['lum_image'].'_'.$sbssessid;
							}
						 echo'.jpg" /></td>
                        <td>'.$data['lum_class'].'</td>
                        <td>'.$data['ho_name'].'</td>
                        <td>'.$data['pa_name'].'</td>
                        
                      </tr>';
		
		
		
		}
	
	}






echo '
                      
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->';

                                	




#END NESTED
echo '


        <script type="text/javascript">
            $(document).ready(function() {
                $("#example'.$x.'").dataTable();
            } );
        </script>
		
';
$x++;

	echo '                                    </div> 
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
         
          
    </div>
    </div>
</div>
</div>
</div>




<!--Dead-->

</div>
</div> <!-- end col -->


</div> <!-- End row -->


</div> <!-- End row -->


            </div>
<?php }else{
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

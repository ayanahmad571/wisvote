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
            <?php if(!isset($_GET['vote'])){
			?>



                 <!-- end row -->

<div class="row">


<div class="col-lg-12	">

<?php 

$getuniquenamesofevents = "SELECT trim(left(pos_title,13)) as names,pos_id FROM `c_master_positions` where pos_user_type =1 group by names";

$getuniquenamesofeventsres = $conn->query($getuniquenamesofevents);

if ($getuniquenamesofeventsres->num_rows > 0) {
    // output data of each row
    while($eventq = $getuniquenamesofeventsres->fetch_assoc()) {
        $events[] = $eventq;
    }
} else {
    $events[] = array('NO EVENTSS');
	die();
}
?>



<div class="panel-heading">
<h3 class=" text-center panel-title">Detailed (Table)</h3>
</div>

<?php

?>
<div class="panel-body">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="row">
<div class="panel-group" id="accordion-test-8"> 
           <?php
		   $x=1;
		   foreach($events as $even){
			   
			   

echo '
<div class="panel panel-default"> 
                                <div class="panel-heading"> 
                                    <h4 class="panel-title"> 
                                        <a data-toggle="collapse" data-parent="#accordion-test-8" href="#collapseTwo-'.$x.'" aria-expanded="false" class="collapsed">
                                            '.ucwords($even['names']).'                                        </a> 
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
                        <th>Candidate Name</th>
						<th>Candidate Pic</th>
						<th>House</th>
                        
						<th>Student Votes</th>
						<th>Staff Votes</th>
                        
                        <th>Votes</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
          ';
			   
			          

$getpartsin= 			  
			  
			  "
select *,h.ho_name from d_participants d
left join c_master_houses h on d.pa_rel_ho_id = h.ho_id

where pa_rel_pos_id =  ".$even['pos_id'].' and pa_valid = 1 ';

$getpartsinres = $conn->query($getpartsin);


if ($getpartsinres->num_rows > 0) {
    // output data of each row
    while($partis = $getpartsinres->fetch_assoc()) {

				$stu_votes  = 			  
							  
							 getdatafromsql($conn, "
				SELECT count(*) as votes FROM `d_vote_bank` d

left join d_participants p on
d.vb_rel_pa_id = p.pa_id

left join b_sm_logins b on
d.vb_rel_lum_id = b.lum_id

where b.lum_valid =1 and p.pa_valid =1 and d.vb_valid =1 and vb_rel_pos_id in (select pos_id from c_master_positions where pos_title like '%".$even['names']."%')
and cast(p.pa_adm_no as UNSIGNED) = ".trim($partis['pa_adm_no'])." and b.lum_type =1");

$votes  = 			  
							  
							 getdatafromsql($conn, "
				SELECT count(*) as votes FROM `d_vote_bank` d

left join d_participants p on
d.vb_rel_pa_id = p.pa_id

left join b_sm_logins b on
d.vb_rel_lum_id = b.lum_id

where b.lum_valid =1 and p.pa_valid =1 and d.vb_valid =1 and vb_rel_pos_id in (select pos_id from c_master_positions where pos_title like '%".$even['names']."%')
and cast(p.pa_adm_no as UNSIGNED) = ".trim($partis['pa_adm_no'])."");

$t_votes  = 			  
							  
							 getdatafromsql($conn, "
				SELECT count(*) as votes FROM `d_vote_bank` d

left join d_participants p on
d.vb_rel_pa_id = p.pa_id

left join b_sm_logins b on
d.vb_rel_lum_id = b.lum_id

where b.lum_valid =1 and p.pa_valid =1 and d.vb_valid =1 and vb_rel_pos_id in (select pos_id from c_master_positions where pos_title like '%".$even['names']."%')
and cast(p.pa_adm_no as UNSIGNED) = ".trim($partis['pa_adm_no'])." and b.lum_type =2");


		echo
'<tr>
                        <td>'.$partis['pa_name'].'</td>
                        <td><img style="width:20%;margin-left:auto;margin-right:auto;" src="';
						 echo 'stu_images/'.$partis['pa_adm_no'].'.jpg" /></td>
                        <td>'.ucwords($partis['ho_name']).'</td>
                        <td>'.$stu_votes['votes'].'</td>
                        <td>'.$t_votes['votes'].'</td>
                        <td>'.$votes['votes'].'</td>
                        
                      </tr>';
		
		
			
			

		}
	
	}

/*$votes_total  = 			  
							  
							 getdatafromsql($conn, "
				SELECT count(*) as votes FROM `d_vote_bank` d

left join d_participants p on
d.vb_rel_pa_id = p.pa_id

left join b_sm_logins b on
d.vb_rel_lum_id = b.lum_id

where b.lum_valid =1 and p.pa_valid =1 and d.vb_valid =1 and vb_rel_pos_id in (select pos_id from c_master_positions where pos_title like '%".$even['names']."%')
");


$t_votes_total  = 			  
							  
							 getdatafromsql($conn, "
				SELECT count(*) as votes FROM `d_vote_bank` d

left join d_participants p on
d.vb_rel_pa_id = p.pa_id

left join b_sm_logins b on
d.vb_rel_lum_id = b.lum_id

where b.lum_valid =1 and p.pa_valid =1 and d.vb_valid =1 and vb_rel_pos_id in (select pos_id from c_master_positions where pos_title like '%".$even['names']."%')
 and b.lum_type =2");





$stu_votes_total  = 			  
							  
							 getdatafromsql($conn, "
				SELECT count(*) as votes FROM `d_vote_bank` d

left join d_participants p on
d.vb_rel_pa_id = p.pa_id

left join b_sm_logins b on
d.vb_rel_lum_id = b.lum_id

where b.lum_valid =1 and p.pa_valid =1 and d.vb_valid =1 and vb_rel_pos_id in (select pos_id from c_master_positions where pos_title like '%".$even['names']."%') and b.lum_type =1");*/

echo '
                     
                    </tbody>
					<tfoot>
						<tr>
							<td colspan="4">1</td>
							<td>2</td>
							<td>3</td>
						</tr>
					</tfoot>
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

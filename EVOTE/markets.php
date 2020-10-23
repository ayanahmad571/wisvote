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
<?php 
									
									$getwallet = "select * from p_balance where wf_rel_lum_id = ".$_SESSION['EVT_USR_DB_ID']."
";


			$getwallet = getdatafromsql($conn,$getwallet);
			
			if(!is_array($getwallet)){
				die("Could not load your wallet amount.<br>
Please ask administrator/teacher to add funds to your account ");
			}
			
			
			
			

			
									?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
  <link href="assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
                <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

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
			if($sess_started == 1){
			?>
               <?php
				
				if($login == 1){
					?>
                                <div class="row">
                                <div class="col-sm-6">
                                	<div align="left" id="page_timer">
                                    <h3 style="color:grey">Next refresh in <strong style="color:maroon" class="countdowner">120</strong> seconds</h3>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                	<div align="right" id="page_timer">
                                    <button id="man_pg_rfrf" class="btn btn-lg btn-info">Refresh</button>
                                    </div>
                                </div>
                                
                            	
                            </div>

                    <?php
				}?>
<?php /*
<div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i>&#8377;</i> 
                            <h2 class="m-0 counter">80250.25</h2>
                            <p><em style="color:green"><h6  style="color:green" class="fa fa-caret-up"></h6> 254.56</em></p>
                            <div>Total Stock Sale</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i class="ion-wifi text-purple"></i> 
                            <h2 class="m-0 counter">8956</h2>
                            <p><em style="color:red"><h6  style="color:red" class="fa fa-caret-down"></h6> 254.56</em></p>
                            <div>Share</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i class="ion-ios7-pricetag text-info"></i> 
                            <h2 class="m-0 counter">1268</h2>
                            <div>New Orders</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget-panel widget-style-2 white-bg">
                            <i class="ion-android-contacts text-success"></i> 
                            <h2 class="m-0 counter">145</h2>
                            <div>New Users</div>
                        </div>
                    </div>
                </div> <!-- end row -->
 */ ?>



                 <!-- End row -->



                <div class="row">
                
                <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                    <h4>Outstanding Balance: <u><strong>INR <?php 
									$bal = $getwallet['wf_balance'];
								echo number_format($bal,3) ;
									?></strong></u></h4>
                                    
<hr>
                                     <?php
				
				if($login == 1){
					?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Company Name</th>
                                                    <th>Stocks Bought (This User)</th>
                                                    <th>Starting Price (&#8377;)</th>
                                                    <th>Current Price (&#8377;)</th>
                                                    <th>Change (%)</th>
                                                </tr>
                                            </thead>

                                     
                                            <tbody id="page_news_refr">
                                                
                                               <?php
$sql = "SELECT *,

ifnull((
	select sum(tr.tr_qty) 
	from sm_transactions tr left join sm_stocks_price_rel pr on tr.tr_rel_stp_id = pr.stp_id
	where tr.tr_rel_stck_id = st.stck_id 
	and tr.tr_rel_lum_id = ".$_USER['lum_id']." 
	and pr.stp_valid = 1 
	and tr.tr_valid =1
	group by tr.tr_rel_stck_id 
	
),0) as sumtotal,
(
	select pri.stp_val from sm_stocks_price_rel pri 
	where pri.stp_valid = 1 
	and pri.stp_pos = 0
	and pri.stp_rel_stck_id = st.stck_id	
	order by pri.stp_from asc
	LIMIT 1
) as origco,
(
	select prq.stp_val from sm_stocks_price_rel prq 
	where prq.stp_valid = 1 
	and prq.stp_rel_stck_id = st.stck_id
	and prq.stp_from <= '".trim(time())."' 
	and prq.stp_till >= '".trim(time())."'	
	order by prq.stp_from asc
	LIMIT 1
) as latco
from sm_stocks st where st.stck_valid = 1 order by stck_name asc  ";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if(is_null($row['latco'])){
			echo '<tr>
			<td colspan="5">Session Ended, please ask the teacher to start a new session</td>
			</tr>';
			exit;
		}
		
		$getsold = "select sum(ts_qty) as sellab from sm_transactions_sell 
			where ts_valid =1 and
			ts_rel_stck_id = ".$row['stck_id']."
			and 
			ts_rel_lum_id = ".$_SESSION['EVT_USR_DB_ID']."
			group by ts_rel_stck_id
";


			$getsold = getdatafromsql($conn,$getsold);
			
			if(!is_array($getsold)){
				$getisold = 0;
			}else{
				$getisold = $getsold['sellab'];
			}
			if($row['latco']<= $bal){
				$strf = 'style ="background-color: gold"';
			}else{
				$strf = '';
			}
		?>
        
        <tr <?php echo $strf?>>
                                                    <td><a style="color:blue" href="acomp.php?stock_id=<?php
													echo md5(sha1($row['stck_id'].'HGYURBVFRBRGWIOGRU92UWHFGOIWHTOGIUEO8HG384IWGOIRHWGIUHREJFGKN'));
													 ?>"><?php echo $row['stck_name'] ; ?></a></td>
                                                    <td><?php echo $row['sumtotal']- $getisold ; ?></td>
                                                    <td><?php echo $row['origco'] ; ?></td>
                                                    <td><?php echo $row['latco'] ; ?></td>
                                                    <?php
													
													if($row['origco'] > $row['latco']){
													$dif = ((($row['origco']- $row['latco'])/$row['origco'])*100) ;
														$colorr = 'red';
														$ic = 'fa fa-caret-down';
													}else if($row['origco'] < $row['latco']){
													$dif = ((($row['latco'] - $row['origco'])/$row['origco'])*100) ;
														$colorr = 'green';
														$ic = 'fa fa-caret-up';
													}else if($row['origco'] == $row['latco']){
														$dif = 0;
														$colorr = 'grey';
														$ic = '';
													}
													?>
                                                    <td>
                                                    	<em style="color:<?php echo $colorr ; ?>;">
                                                        	<i class="<?php echo $ic ; ?>" style="color:<?php echo $colorr ; ?>;">
                                                            	 
                                                            </i>
                                                            <?php echo round($dif,3) ; ?> 
                                                        </em>
                                                        
                                                    </td>
		</tr>
                                                
        <?php
    }
} else {
    echo "0 results";
}
 ?> 
                                            </tbody>
                                        </table>
                                         <?php
				}else{
					?>
                                <div align="center">
                            	<a href="login.php">
                                <button class="btn btn-lg btn-info">Login to participate</button></a>
                            </div>

                    <?php
				}
				
				?>
                                

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End row -->


            </div><?php }else{
				echo 'Please ask Administrator/Teacher to start a session';
			}?>
            <!-- Page Content Ends -->
            <!-- ================== -->

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

 
        
        

        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>
        
        <?php 

if($login == 1){
	get_timer_sc(2);
}

?>
 
 <script>
 
$(document).ready(function(e) {
	
	
	



setInterval(function()
{ 
    $.ajax({
      type:"post",
	  data:{'lo2_ejhrsk':'news'},
      url:"master_action.php",
	  success:function(data)
      {
        $("#page_news_refr").html(data);
		  //do something with response data
      }
    });
}, 5000);//time in milliseconds 






});
	
 </script>   


    </body>

</html>

<?php 

include('db_auth.php');
?>



<?php
if(isset($_SESSION['SBSEVOTE_SESS_ID'])){
$login=1;
header('Location: home.php');
}else{
	$login=0;
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php get_head(); ?>
                 </head>


    <body>

       
        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Request for a new account at Stock Market Simulation</h3>
                </div> 

                <form class="form-horizontal m-t-40" action="master_action.php" method="post">
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input name="usr_eml" class="form-control" type="number" required placeholder="Admission Number">
                        </div>
                    </div>
                
                  
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input name="usr_pass" class="form-control " type="text" required 
                            placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <label class="cr-styled">
                                <input type="checkbox" required name="ok">
                                <i class="fa"></i> 
                                 I accept <strong><a href="#">Terms and Conditions</a></strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-purple w-md" type="submit">Request an account</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30">
                        <div class="col-sm-12 text-center">
                            <a href="login.php" style="color:maroon">Already have account?</a>
                        </div>
                    </div>
                </form>                                  
                
            </div>
        </div>

        
      <?php  
	  get_end_script();
	  ?>
           <!--form validation-->
        <script type="text/javascript" src="assets/jquery.validate/jquery.validate.min.js"></script>

        <!--form validation init-->
        <script src="assets/jquery.validate/form-validation-init.js"></script>
      
    </body>

</html>

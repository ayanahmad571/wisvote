<ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
                        <!-- mesages -->  
                       
                        <!-- Notification -->
                        <li class="dropdown">
                        </li>
                       
                        <!-- /Notification -->

                        <!-- user login dropdown start-->
                        <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="<?php echo $_USER['lum_name'].' prof_pic' ?>" src="<?php 
if($_USER['lum_type'] == 1){
	echo "stu_pics/".$_USER['lum_image'].'_'.$sbssessid;
}else{
	echo "http://sbs-school.org/sbsweb/files/staffimages/".$_USER['lum_image'];
} ?>.jpg" class="img-circle profile-img thumb-sm">
                                <span class="username"><?php echo ucwords($_USER['lum_name']) ?> </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                                <li><a href="myca.php"><i class="fa fa-briefcase"></i>Profile</a></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                                <hr>
                                 <li style="color:red">
<p>                                                   Logged In ip: <?php echo $_SERVER['REMOTE_ADDR'] ?>
<br>
Logged in user: <?php echo $_USER['lum_name'] ?><br>

Admin : <?php 
if($admin == 1){
	echo 'Yes';
}else{
	echo 'No';
}

?></p>
                        </li>
                        
                        
                        
                            </ul>
                        </li>
                        <!-- user login dropdown end -->       
                    </ul>
<?php 
/**
*PARAMETERS FETCH FOR FORM
**/
$m_mode="CHANGE PASSWORD (CP)";
?>


    <div class="container-fluid">
            <div class="block-header">
                <h2>MY PROFILE (P) / <?php echo $m_mode;?></h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CHANGE PASSWORD
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="./?act=home">Back to Home</a></li>
                                        <li><a href="#" onclick='location.reload(true); return false;'>Reset/Reload</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="" method="POST" >
                                <label for="password">Current Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="opassword" name="opassword" class="form-control" placeholder="Enter your current password" required>
                                    </div>
                                </div>
                                <label for="npassword">New Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="npassword" name="npassword" class="form-control" placeholder="Enter your new password" required>
                                    </div>
                                </div>
                                <label for="npasswordc">Confirm New Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="npasswordc" name="npasswordc" class="form-control" placeholder="Enter your new password again" required>
                                    </div>
                                </div>
                                <input type="hidden" name="cp_email" value="<?php echo $email;?>"/>
                                <button type="button" name="change_password" value="change_password" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect" onclick="cpformhash(this.form, this.form.opassword, this.form.npassword, this.form.npasswordc)">CHANGE MY PASSWORD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
    </div>
    
<?php
/********************************************************************************************
                    FORM POST CHANGE PASSWORD
********************************************************************************************/
/*if(isset($_POST['change_password']))
{*/
if (isset($_POST['cp_pn'], $_POST['cp_po'], $_POST['cp_email'])) {
    $npassword = $_POST['cp_pn']; // The hashed password.
    $opassword = $_POST['cp_po']; // The hashed password.
    $pemail = $_POST['cp_email'];
    //$npass = password_hash($password, PASSWORD_BCRYPT);
    //echo password_verify($password, PASSWORD_BCRYPT);
    if (change_password($email,$npassword, $opassword, $mysqli) == true) {
        // Change success 
        $_SESSION['passchange']=md5("1");
        alert_sweet_success_wr("Password Changed Successfully!!! Please Login Again!!!","./?act=login&pchange=1");
        //header("Location: ?act=login&pchange=1");
    } else {
        // Change failed 
        alert_sweet_failed("Unable to Change Password, Please Check Your Current Password!!!");
    }
} else {
    // The correct POST variables were not sent to this page. 
    //alert_sweet_failed("Something went wrong, Contact Support!!!");
}
//}
/********************************************************************************************
                    END OF CHANGE PASSWORD
********************************************************************************************/
?>
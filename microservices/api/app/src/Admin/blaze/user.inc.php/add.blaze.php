<?php 
/**
*PARAMETERS FETCH FOR FORM
**/

$myRequestArray=$_SESSION[$user_request];
//alert($myRequestArray[0]." ".$myRequestArray[1]);
if($myRequestArray[0]=="Edit_User")
{
    $m_mode="EDIT USER (E)";
    $uid=$myRequestArray[1];
    $query = "SELECT user_name,user_group,email,user_dept,user_active,user_mobile FROM members WHERE uid = ? ORDER BY uid";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        alert("No Data Available or Data Fetch Error, Contact Admin!!!");
    }
    else
    {
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $stmt->bind_result($user_name,$user_group,$email,$user_dept,$user_active,$user_mobile);
        //$result = $stmt->get_result();
        //$row = $result->fetch_array(MYSQLI_NUM);
        $stmt->fetch();
       /* $user_name=$row[0];
        $user_group=$row[1];
        $email=$row[2];
        $user_dept=$row[3];
        $user_active=$row[4];
        $user_mobile=$row[5];*/
    }
    $stmt->close();
}
else
{
    $user_name="";
    $user_group="";
    $email="";
    $user_dept="";
    $user_active="";
    $user_mobile="";
    $m_mode="ADD USER (A)";
}
?>


    <div class="container-fluid">
            <div class="block-header">
                <h2>USER MANAGER (UM) / <?php echo $m_mode;?></h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                USER PROFILE
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
                            <form action="" method="POST" name="user_profile">
                                <label for="user_name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter the Name of the User" value="<?php echo $user_name;?>" required>
                                    </div>
                                </div>
                                <label for="user_mobile">Mobile Number</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="user_mobile" name="user_mobile" class="form-control" placeholder="Enter the Mobile Number of the User" value="<?php echo $user_mobile;?>" required>
                                    </div>
                                </div>
                                <label for="user_dept">Select Department</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="user_dept" name="user_dept" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Department</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT name FROM department") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $user_dept==$row['name'] ? '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>' : '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                               <label for="user_group">Select User Group</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="user_group" id="user_group" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select User Group</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT uid,name FROM user_group") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $user_group==$row['uid'] ? '<option value="'.$row['uid'].'" selected>'.$row['name'].'</option>' : '<option value="'.$row['uid'].'">'.$row['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <label for="email_address">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" name="email_address" class="form-control" placeholder="Enter the User Email Address" value="<?php echo $email;?>" required>
                                    </div>
                                </div>
                                <?php
                                   /* if($m_mode=="ADD USER (A)")
                                    {
                                ?>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <?php
                                }*/
                                ?>
                                <label for="user_active">Active</label>
                                        <div class="switch">
                                            <label><input name="user_active" id="user_active" type="checkbox" <?php echo $m_mode=="EDIT USER (E)"&&$user_active=="off" ? '' : 'checked' ; ?>  ><span class="lever switch-col-<?php echo $rm_theme; ?>" ></span></label>
                                        </div>
                                <input type="hidden" name="request_id" value="<?php echo UUID::v4();?>">
                                <?php
                                    if($m_mode=="ADD USER (A)")
                                    {
                                ?>
                                <button type="submit" name="add_user" value="add_user" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">ADD USER</button>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <input type="hidden" name="uid" value="<?php echo $uid;?>">
                                <button type="submit" name="update_user" value="update_user" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">UPDATE USER DETAILS</button>
                                <?php 
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
    </div>
    
<?php
/**
*INSERT POST CODE
**/
if(isset($_POST['add_user']))
{
    $p_user_name=$_POST['user_name'];
    $p_user_mobile=$_POST['user_mobile'];
    $p_user_dept=$_POST['user_dept'];
    $p_user_group=$_POST['user_group'];
    $p_email_address=$_POST['email_address'];
    $p_password=$_POST['password'];
    $p_user_active=$_POST['user_active'];
    $p_user_name=mysqli_real_escape_string($mysqli,$p_user_name);
    $p_user_name=htmlentities($p_user_name);
    $p_user_name=htmlspecialchars($p_user_name);
    $p_user_mobile=mysqli_real_escape_string($mysqli,$p_user_mobile);
    $p_user_mobile=htmlentities($p_user_mobile);
    $p_user_mobile=htmlspecialchars($p_user_mobile);
    $p_user_dept=mysqli_real_escape_string($mysqli,$p_user_dept);
    $p_user_dept=htmlentities($p_user_dept);
    $p_user_dept=htmlspecialchars($p_user_dept);
    $p_user_group=mysqli_real_escape_string($mysqli,$p_user_group);
    $p_user_group=htmlentities($p_user_group);
    $p_user_group=htmlspecialchars($p_user_group);
    $p_email_address=mysqli_real_escape_string($mysqli,$p_email_address);
    $p_email_address=htmlentities($p_email_address);
    $p_email_address=htmlspecialchars($p_email_address);
    $p_password=mysqli_real_escape_string($mysqli,$p_password);
    $p_password=htmlentities($p_password);
    $p_password=htmlspecialchars($p_password);
    $p_user_active=mysqli_real_escape_string($mysqli,$p_user_active);
    $p_user_active=htmlentities($p_user_active);
    $p_user_active=htmlspecialchars($p_user_active);
    if($p_user_active=="")
        $p_user_active="off";
    //alert($p_user_active);
    /**
    *INSERT CODE ADDED BY RIZWAN ON 24/06/2017
    **/
    $stmt = $mysqli->prepare("INSERT INTO members(user_name,user_mobile,user_dept,email,password,user_active,user_group) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $p_user_name, $p_user_mobile, $p_user_dept, $p_email_address, $p_password, $p_user_active, $p_user_group);
    if($stmt->execute())
        alert_sweet_success("User Added Successfully!!!");
    else
        alert_sweet_failed("Unable to Add User!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}

/**
*UPDATE POST CODE
**/
if(isset($_POST['update_user']))
{
    $p_uid=$_POST['uid'];
    $p_user_name=$_POST['user_name'];
    $p_user_mobile=$_POST['user_mobile'];
    $p_user_dept=$_POST['user_dept'];
    $p_user_group=$_POST['user_group'];
    $p_email_address=$_POST['email_address'];
    $p_password=$_POST['password'];
    $p_user_active=$_POST['user_active'];
    $p_user_name=mysqli_real_escape_string($mysqli,$p_user_name);
    $p_user_name=htmlentities($p_user_name);
    $p_user_name=htmlspecialchars($p_user_name);
    $p_user_mobile=mysqli_real_escape_string($mysqli,$p_user_mobile);
    $p_user_mobile=htmlentities($p_user_mobile);
    $p_user_mobile=htmlspecialchars($p_user_mobile);
    $p_user_dept=mysqli_real_escape_string($mysqli,$p_user_dept);
    $p_user_dept=htmlentities($p_user_dept);
    $p_user_dept=htmlspecialchars($p_user_dept);
    $p_user_group=mysqli_real_escape_string($mysqli,$p_user_group);
    $p_user_group=htmlentities($p_user_group);
    $p_user_group=htmlspecialchars($p_user_group);
    $p_email_address=mysqli_real_escape_string($mysqli,$p_email_address);
    $p_email_address=htmlentities($p_email_address);
    $p_email_address=htmlspecialchars($p_email_address);
    $p_password=mysqli_real_escape_string($mysqli,$p_password);
    $p_password=htmlentities($p_password);
    $p_password=htmlspecialchars($p_password);
    $p_user_active=mysqli_real_escape_string($mysqli,$p_user_active);
    $p_user_active=htmlentities($p_user_active);
    $p_user_active=htmlspecialchars($p_user_active);
    //alert_sweet_success($user_active);
    if($p_user_active=="")
        $p_user_active="off";
    //alert($p_user_active);
    /**
    *UPDATE CODE ADDED BY RIZWAN ON 26/06/2017
    **/
    $stmt = $mysqli->prepare("UPDATE members SET user_name = ?,user_mobile = ?,user_dept = ?,email = ?,user_active = ?,user_group = ? WHERE uid = ?");
    $stmt->bind_param('sssssss', $p_user_name, $p_user_mobile, $p_user_dept, $p_email_address, $p_user_active, $p_user_group, $uid);
    if($stmt->execute())
    {
        alert_sweet_success_wr("User Details Updated Successfully!!!","./?act=user/modify");
        unset($_SESSION[$user_request]);
    }
    else
        alert_sweet_failed("Unable to Update User Details!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}
?>
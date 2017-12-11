<?php 
/**
*PARAMETERS FETCH FOR FORM
**/
$myRequestArray=$_SESSION[$user_request];
//dalert($myRequestArray[0]." ".$myRequestArray[1]);
if($myRequestArray[0]=="Edit_Group_Rights")
{
    $m_mode="EDIT RIGHTS (E)";
    $uid=$myRequestArray[1];
    $query = "SELECT group_id,access_list FROM rights_group WHERE uid = ? ORDER BY uid";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        alert("No Data Available or Data Fetch Error, Contact Admin!!!");
    }
    else
    {
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $stmt->bind_result($group_id,$pageid);
        $stmt->fetch();
        /*$result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        $group_id=$row[0];
        $pageid=$row[1];*/
    }
    $stmt->close();
}
else
{
    $m_mode="ADD RIGHTS (A)";
}
?>


    <div class="container-fluid">
            <div class="block-header">
                <h2>RIGHTS MANAGER (RM) / GROUP RIGHTS (GR) / <?php echo $m_mode;?></h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                RIGHTS DETAILS
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
                                <label for="group_id">Select User Group</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="group_id" name="group_id" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Page</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT uid,name FROM user_group") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $group_id==$row['uid'] ? '<option value="'.$row['uid'].'" selected>'.$row['name'].'</option>' : '<option value="'.$row['uid'].'">'.$row['name'].'</option>';
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                               <label for="pageid">Select Module</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="pageid" id="pageid" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Module</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT name,token FROM access_list") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $pageid==$row['token'] ? '<option value="'.$row['token'].'" selected>'.$row['name'].'</option>' : '<option value="'.$row['token'].'">'.$row['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <input type="hidden" name="request_id" value="<?php echo UUID::v4();?>">
                                <?php
                                    if($m_mode=="ADD RIGHTS (A)")
                                    {
                                ?>
                                <button type="submit" name="add_rights" value="add_rights" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">ADD NEW RIGHT</button>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <input type="hidden" name="uid" value="<?php echo $uid;?>">
                                <button type="submit" name="update_rights" value="update_rights" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">UPDATE RIGHTS DETAILS</button>
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
if(isset($_POST['add_rights']))
{
    $p_group_id=$_POST['group_id'];
    $p_pageid=$_POST['pageid'];
    $p_group_id=mysqli_real_escape_string($mysqli,$p_group_id);
    $p_group_id=htmlentities($p_group_id);
    $p_group_id=htmlspecialchars($p_group_id);
    $p_pageid=mysqli_real_escape_string($mysqli,$p_pageid);
    $p_pageid=htmlentities($p_pageid);
    $p_pageid=htmlspecialchars($p_pageid);
    /**
    *INSERT CODE ADDED BY RIZWAN ON 24/06/2017
    **/
    $stmt = $mysqli->prepare("INSERT INTO rights_group(group_id,access_list) VALUES (?, ?)");
    $stmt->bind_param('ss', $p_group_id, $p_pageid);
    if($stmt->execute())
        alert_sweet_success("Rights Added Successfully!!!");
    else
        alert_sweet_failed("Unable to Add Rights!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}

/**
*UPDATE POST CODE
**/
if(isset($_POST['update_rights']))
{
    $p_uid=$_POST['uid'];
    $p_group_id=$_POST['group_id'];
    $p_pageid=$_POST['pageid'];
    $p_group_id=mysqli_real_escape_string($mysqli,$p_group_id);
    $p_group_id=htmlentities($p_group_id);
    $p_group_id=htmlspecialchars($p_group_id);
    $p_pageid=mysqli_real_escape_string($mysqli,$p_pageid);
    $p_pageid=htmlentities($p_pageid);
    $p_pageid=htmlspecialchars($p_pageid);
    /**
    *UPDATE CODE ADDED BY RIZWAN ON 26/06/2017
    **/
    $stmt = $mysqli->prepare("UPDATE rights_group SET group_id = ?, access_list= ? WHERE uid = ?");
    $stmt->bind_param('sss', $p_group_id, $p_pageid, $uid);
    if($stmt->execute())
    {
        alert_sweet_success_wr("Rights Details Updated Successfully!!!","./?act=rights/group/modify");
        unset($_SESSION[$user_request]);
    }
    else
        alert_sweet_failed("Unable to Update Rights Details!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}
?>
<?php 
/**
*PARAMETERS FETCH FOR FORM
**/

$myRequestArray=$_SESSION[$user_request];
//alert($myRequestArray[0]." ".$myRequestArray[1]);
if($myRequestArray[0]=="Edit_Session")
{
    $m_mode="EDIT SESSION (E)";
    $uid=$myRequestArray[1];
    $query = "SELECT year,dos,doe,gos,goe,category,status,public FROM session WHERE uid = ? ORDER BY uid";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        alert("No Data Available or Data Fetch Error, Contact Admin!!!");
    }
    else
    {
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $stmt->bind_result($year,$dos,$doe,$gos,$goe,$category,$sactive,$public);
        $stmt->fetch();
        //$result = $stmt->get_result();
        //$row = $result->fetch_array(MYSQLI_NUM);
        /*$year=$row[0];
        $dos=$row[1];
        $doe=$row[2];
        $gos=$row[3];
        $goe=$row[4];
        $category=$row[5];
        $sactive=$row[6];
        $public=$row[7];*/
    }
    $stmt->close();
}
else
{
    $year="";
    $dos="";
    $doe="";
    $gos="";
    $goe="";
    $category="";
    $sactive="";
    $public="";
    $m_mode="ADD SESSION (A)";
}
?>


    <div class="container-fluid">
            <div class="block-header">
                <h2>SESSION MANAGER (SM) / <?php echo $m_mode;?></h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SESSION DETAILS
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
                            <form action="" method="POST" name="session_details">
                                <label for="user_name">Academic Year (In YYYY-YY Format Only Eg. 2017-18)</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="ayear" name="ayear" class="form-control" placeholder="Enter the Academic Year for Session" value="<?php echo $year;?>" required <?php  echo $year ? "readonly":"";?>>
                                    </div>
                                </div>
                                <label for="user_dept">Category</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="category" name="category" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Form Category</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT cat,descrip FROM ses_cat") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $category==$row['cat'] ? '<option value="'.$row['cat'].'" selected>'.$row['descrip'].'</option>' : '<option value="'.$row['cat'].'">'.$row['descrip'].'</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                                
                                <label for="email_address">Date of Activation</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="dos" name="dos" class="form-control" value="<?php echo $dos;?>" required>
                                    </div>
                                </div>
                                <label for="email_address">Date of Closing</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="doe" name="doe" class="form-control"  value="<?php echo $doe;?>" required>
                                    </div>
                                </div>
                                <label for="email_address">Start of Grievance :</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="gos" name="gos" class="form-control"  value="<?php echo $gos;?>" required>
                                    </div>
                                </div>
                                <label for="email_address">End of Grievance :</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="goe" name="goe" class="form-control" value="<?php echo $goe;?>" required>
                                    </div>
                                </div>
                                
                                <label for="user_active">Active (Keep Session Activities On)</label>
                                        <div class="switch">
                                            <label><input name="sactive" id="sactive" type="checkbox" <?php echo $m_mode=="EDIT SESSION (E)"&&$sactive=="off" ? '' : 'checked' ; ?>  ><span class="lever switch-col-<?php echo $rm_theme; ?>" ></span></label>
                                        </div>
                                <label for="user_active">Public Link (Open to Students for Filling)</label>
                                        <div class="switch">
                                            <label><input name="public" id="public" type="checkbox" <?php echo $m_mode=="EDIT SESSION (E)"&&$public=="off" ? '' : 'checked' ; ?>  ><span class="lever switch-col-<?php echo $rm_theme; ?>" ></span></label>
                                        </div>
                                <input type="hidden" name="request_id" value="<?php echo UUID::v4();?>">
                                <?php
                                    if($m_mode=="ADD SESSION (A)")
                                    {
                                ?>
                                <button type="submit" name="add_session" value="add_session" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">ADD/START NEW SESSION</button>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <input type="hidden" name="uid" value="<?php echo $uid;?>">
                                <button type="submit" name="update_session" value="update_session" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">UPDATE SESSION DETAILS</button>
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
if(isset($_POST['add_session']))
{
    $p_year=$_POST['ayear'];
    $p_dos=$_POST['dos'];
    $p_doe=$_POST['doe'];
    $p_gos=$_POST['gos'];
    $p_goe=$_POST['goe'];
    $p_category=$_POST['category'];
    $p_sactive=$_POST['sactive'];
    $p_public=$_POST['public'];
    if($p_sactive=="")
        $p_sactive="off";
    if($p_public=="")
        $p_public="off";
    //alert($p_user_active);
    
    //echo $_POST=;
    /**
    *DEACTIVATE ALL PREVIOUS SESSION ADDED BY RIZWAN ON 18/08/2017
    **/
    mysqli_query($mysqli,"UPDATE session SET status='off' WHERE category='$p_category' ") or die(mysqli_error());
    /**
    *END OF DEACTIVATE ALL PREVIOUS SESSION ADDED BY RIZWAN ON 18/08/2017
    **/

    /**
    *UPDATE & CREATE RESERVED SEATS WITH DEFAULT VALUES ADDED BY RIZWAN ON 15/08/2017
    **/
    $query3=mysqli_query($mysqli,"SELECT DISTINCT name FROM gender ORDER BY uid") or die(mysqli_error());
        
        while($row3=mysqli_fetch_array($query3))
        {
            $g=$row3['name'];

            $query4=mysqli_query($mysqli,"SELECT DISTINCT name FROM department WHERE hasres=1 ORDER BY uid") or die(mysqli_error());
            while($row4=mysqli_fetch_array($query4))
            {
                $d=$row4['name'];
                //alert($d);
                $query5=mysqli_query($mysqli,"SELECT DISTINCT name FROM cls WHERE stud_cat='$p_category' ORDER BY uid") or die(mysqli_error());
                while($row5=mysqli_fetch_array($query5))
                {
                    $c=$row5['name'];
                    $query50=mysqli_query($mysqli,"SELECT DISTINCT cat FROM category ORDER BY uid") or die(mysqli_error());
                    while($row50=mysqli_fetch_array($query50))
                    {
                        $cls=$c." ".$d;
                        //alert($cls);
                        $ct=$row50['cat'];
                        $query6="INSERT INTO reserve (pgender,pclass,category,session,seats,seat_cat) VALUES ('$g','$cls','$ct','$p_year',0,'$p_category')";
                        mysqli_query($mysqli,$query6) or die(mysqli_error($mysqli));                
                    }
                }
            }
        }
        /**
        *END OF UPDATE & CREATE RESERVED SEATS WITH DEFAULT VALUES ADDED BY RIZWAN ON 15/08/2017
        **/
    /**
    *INSERT CODE ADDED BY RIZWAN ON 24/06/2017
    **/
    $stmt = $mysqli->prepare("INSERT INTO session(year,dos,doe,gos,goe,category,status,public) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $p_year, $p_dos, $p_doe, $p_gos, $p_goe, $p_category, $p_sactive, $p_public);
    if($stmt->execute())
        alert_sweet_success("Session Added & Started Successfully!!!");
    else
        alert_sweet_failed("Unable to Add Session!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}

/**
*UPDATE POST CODE
**/
if(isset($_POST['update_session']))
{
    $p_uid=$_POST['uid'];
    $p_year=$_POST['year'];
    $p_dos=$_POST['dos'];
    $p_doe=$_POST['doe'];
    $p_gos=$_POST['gos'];
    $p_goe=$_POST['goe'];
    $p_category=$_POST['category'];
    $p_sactive=$_POST['sactive'];
    $p_public=$_POST['public'];
    $p_year=mysqli_real_escape_string($mysqli,$p_year);
    $p_year=htmlentities($p_year);
    $p_year=htmlspecialchars($p_year);
    $p_dos=mysqli_real_escape_string($mysqli,$p_dos);
    $p_dos=htmlentities($p_dos);
    $p_dos=htmlspecialchars($p_dos);
    $p_doe=mysqli_real_escape_string($mysqli,$p_doe);
    $p_doe=htmlentities($p_doe);
    $p_doe=htmlspecialchars($p_doe);
    $p_gos=mysqli_real_escape_string($mysqli,$p_gos);
    $p_gos=htmlentities($p_gos);
    $p_gos=htmlspecialchars($p_gos);
    $p_goe=mysqli_real_escape_string($mysqli,$p_goe);
    $p_goe=htmlentities($p_goe);
    $p_goe=htmlspecialchars($p_goe);
    $p_category=mysqli_real_escape_string($mysqli,$p_category);
    $p_category=htmlentities($p_category);
    $p_category=htmlspecialchars($p_category);
    $p_sactive=mysqli_real_escape_string($mysqli,$p_sactive);
    $p_sactive=htmlentities($p_sactive);
    $p_sactive=htmlspecialchars($p_sactive);
    $p_public=mysqli_real_escape_string($mysqli,$p_public);
    $p_public=htmlentities($p_public);
    $p_public=htmlspecialchars($p_public);
    if($p_sactive=="")
        $p_sactive="off";
    if($p_public=="")
        $p_public="off";
        //alert($p_user_active);
    /**
    *UPDATE CODE ADDED BY RIZWAN ON 26/06/2017
    **/
    $stmt = $mysqli->prepare("UPDATE session SET dos = ?,doe = ?,gos = ?,goe = ?,category = ?,status = ?,public = ? WHERE uid = ?");
    $stmt->bind_param('ssssssss', $p_dos, $p_doe, $p_gos, $p_goe, $p_category, $p_sactive, $p_public, $uid);
    if($stmt->execute())
    {
        alert_sweet_success_wr("Session Details Updated Successfully!!!","./?act=session/modify");
        unset($_SESSION[$user_request]);
    }
    else
        alert_sweet_failed("Unable to Update Session Details!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}
?>
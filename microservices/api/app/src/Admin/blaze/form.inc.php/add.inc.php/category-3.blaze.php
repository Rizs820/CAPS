<?php 
/**
*PARAMETERS FETCH FOR FORM
**/
$query100=mysqli_query($mysqli,"SELECT * FROM session WHERE status='on' AND category='Category-3'") or die(mysqli_error());
$row100=mysqli_fetch_array($query100);
$session_year=$row100['year'];
//alert($session_year);
if(!$session_year)
{
    alert_sweet_failed_wr("Sorry No Session is Active!!! Please Start New Session!!! ERR-CODE : RM0301CS","./?act=home");
}
$myRequestArray=$_SESSION[$user_request];
//dalert($myRequestArray[0]." ".$myRequestArray[1]);
if($myRequestArray[0]=="Edit_Form_C3")
{
    //alert($myRequestArray[1]);
    $m_mode="EDIT FORM (E)";
    $uid=$myRequestArray[1];
    $query = "SELECT * FROM form_data WHERE sysid = '$uid'";
    $result=mysqli_query($mysqli,$query);
   /* $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        alert("No Data Available or Data Fetch Error, Contact Admin!!!");
    }
    else
    {
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();*/
        $row = mysqli_fetch_array($result);
        //alert($row['pname']);
        $prn=$row['prn'];
        $pname=$row['pname'];
        $padd=$row['padd'];
        $ladd=$row['ladd'];
        $pc_number=$row['pc_no'];
        $psc_number=$row['psc_no'];
        $pemail=$row['pemail'];
        $pgender=$row['pgender'];
        $pcategory=$row['category'];
        $ph=$row['ph'];
        $defence=$row['def'];
        $jk=$row['jk'];
        $pbranch=$row['pclass'];
        $sgpa=$row['sgpa'];
        $f_version=$row['f_version'];
        //alert($row['sgpa']);
        $i=1;
        //$sm=0;
        while($i<6)
        {
            $res="s".$i."_result";
            $back="s".$i."_back";
            $sgpat="s".$i."_sgpa";
            ${"result".$i}=$row[$res];
            ${"back".$i}=$row[$back];
            ${"sgpa".$i}=$row[$sgpat];
            //alert($row[$sgpa1]);
            $i=$i+1;
        }
        $p_form_cat=$row['form_cat'];
        //$p_session="2018-19";
        //$p_date=date("j-m-Y");
    //}
    //$stmt->close();
}
else
{
    $m_mode="ADD FORM (A)";
}
?>



    <div class="container-fluid">
            <div class="block-header">
                <h2>FROM MANAGER (FM) / <?php echo $m_mode;?> / DSE STUDENTS (DSE) / <?php echo $session_year;?></h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FROM DETAILS
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
                                <label for="page_name">Application ID</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="prn" name="prn" class="form-control" placeholder="Enter the Student Application Kit ID" value="<?php echo $prn;?>" required>
                                    </div>
                                </div>
                                <label for="page_name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="pname" name="pname" class="form-control" placeholder="Enter the Student Name" value="<?php echo $pname;?>" required>
                                    </div>
                                </div>
                                <label for="page_name">Permanent Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="padd" name="padd" class="form-control" placeholder="Enter the Student Permanent Address" value="<?php echo $padd;?>" required>
                                    </div>
                                </div>
                                <label for="page_name">Local Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="ladd" name="ladd" class="form-control" placeholder="Enter the Student Local Address" value="<?php echo $ladd;?>" required>
                                    </div>
                                </div>
                                <label for="page_name">Personal Contact Number</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="pc_number" name="pc_number" class="form-control" placeholder="Enter the Personal Contact Number" value="<?php echo $pc_number;?>" required>
                                    </div>
                                </div>
                                <label for="page_name">Parents Contact Number</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="psc_number" name="psc_number" class="form-control" placeholder="Enter the Parents Contact Number" value="<?php echo $psc_number;?>" required>
                                    </div>
                                </div>
                                <label for="page_name">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="pemail" name="pemail" class="form-control" placeholder="Enter the Email Address" value="<?php echo $pemail;?>" required>
                                    </div>
                                </div>
                                <label for="page_type">Gender</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="pgender" name="pgender" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Gender</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT name FROM gender") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $pgender==$row['name'] ? '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>' : '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                                <label for="page_type">Category</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="pcategory" name="pcategory" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Category</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT cat FROM category WHERE shw=1") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo $pcategory==$row['cat'] ? '<option value="'.$row['cat'].'" selected>'.$row['cat'].'</option>' : '<option value="'.$row['cat'].'">'.$row['cat'].'</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                                <label for="page_type">Physically Handicapped</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="ph" name="ph" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select</option>
                                        <?php
                                            echo $ph=="No" ? "<option selected='yes'>No</option>" :'<option>No</option>';
                                            echo $ph=="Yes" ? "<option selected='yes'>Yes</option>" :'<option>Yes</option>';
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <label for="page_type">Defence</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="defence" name="defence" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select</option>
                                        <?php
                                            echo $defence=="No" ? "<option selected='yes'>No</option>" :'<option>No</option>';
                                            echo $defence=="Yes" ? "<option selected='yes'>Yes</option>" :'<option>Yes</option>';
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                                <label for="jk">J & K/ North Eastern Candidate</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="jk" name="jk" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select</option>
                                        <?php
                                            echo $jk=="No" ? "<option selected='yes'>No</option>" :'<option>No</option>';
                                            echo $jk=="Yes" ? "<option selected='yes'>Yes</option>" :'<option>Yes</option>';
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                                <label for="pbranch">Current Year & Branch</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="pbranch" name="pbranch" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Class</option>
                                        <?php
                                        $query=mysqli_query($mysqli,"select * from department where hasres=1")or die(mysqli_error());
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                $d=$row['name'];
                                                $query1=mysqli_query($mysqli,"select * from cls WHERE stud_cat='Category-3'")or die(mysqli_error());
                                                while($row1=mysqli_fetch_array($query1))
                                                {
                                                    $v=$row1['name']." ".$d;
                                                    echo $pbranch==$v ? "<option selected='yes'>".$v."</option>" :'<option>'.$v.'</option>';
                                                }
                                            }
                                        ?>
                                        
                                    </select>
                                    </div>
                                </div>
                                <label for="sgpa">MH Merit No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="sgpa" name="sgpa" class="form-control" placeholder="Enter the MH Merit No." value="<?php echo $sgpa;?>" required>
                                    </div>
                                </div>
                                <label for="sgpa">AI Merit No.</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="ai_mn" name="ai_mn" class="form-control" placeholder="Enter the AI Merit No." value="<?php echo $ai_mn;?>" >
                                    </div>
                                </div>
                                <b>
                                <div class="row">
                                    <div class="col-md-4" align="center">
                                        Previous Academic Details
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2" align="center">
                                        Class
                                    </div>
                                    <div class="col-md-2" align="center">
                                        Percentage
                                    </div>
                                </div>
                                </b>
                                <?php
                                    $i=1;
                                    while($i<3)
                                    {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-2" align="center">
                                                <?php
                                                    if($i==1)
                                                        echo "10th";
                                                    else
                                                        echo "Diploma %";
                                                 ?>
                                            </div>
                                            <div class="col-md-2" align="center">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Percentage" name="<?php echo "sgpa".$i;?>" value="<?php echo ${"sgpa".$i};?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?
                                        $i++;
                                    }
                                    ?>
                                
                                <input type="hidden" name="request_id" value="<?php echo UUID::v4();?>">
                                <?php
                                    if($m_mode=="ADD FORM (A)")
                                    {
                                ?>
                                <button type="submit" name="add_form_c2" value="add_from_c2" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">ADD NEW FORM</button>
                                <?php 
                                    }
                                    else
                                    {
                                ?>
                                <input type="hidden" name="uid" value="<?php echo $uid;?>">
                                <button type="submit" name="update_form_c2" value="update_form_c2" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">UPDATE FORM DETAILS</button>
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
if(isset($_POST['add_form_c2']))
{
    $p_prn=$_POST['prn'];
    $p_pname=$_POST['pname'];
    $p_padd=$_POST['padd'];
    $p_ladd=$_POST['ladd'];
    $p_pc_number=$_POST['pc_number'];
    $p_psc_number=$_POST['psc_number'];
    $p_pemail=$_POST['pemail'];
    $p_pgender=$_POST['pgender'];
    $p_pcategory=$_POST['pcategory'];
    $p_ph=$_POST['ph'];
    $p_defence=$_POST['defence'];
    $p_jk=$_POST['jk'];
    $p_pbranch=$_POST['pbranch'];
    $p_sgpa=$_POST['sgpa'];
    $p_ai_mn=$_POST['ai_mn'];
    $i=1;
    $sm=0;
    $p_fversion=1;
    while($i<6)
    {
        ${"result".$i}=$_POST["result".$i];
        ${"back".$i}=$_POST["back".$i];
        ${"sgpa".$i}=$_POST["sgpa".$i];
        $stati="paf".$i;
        $subsfi="back".$i;
        $sm=${$subsfi}+$sm;
        $semp="s".$i;
        $i=$i+1;
    }
    $p_form_cat="Category-3";
    $p_session=$session_year;
    $p_date=date("j-m-Y");
    $p_suid=uniqid().rand();
    //alert($p_user_active);
    /**
    *INSERT CODE ADDED BY RIZWAN ON 15/08/2017
    **/
    $stmt = $mysqli->prepare("INSERT INTO form_data(prn,pname,pemail,pc_no,psc_no,pgender,sgpa,pclass,category,date,uid,ladd,padd,ph,def,jk,session,form_cat,s1_sgpa,s2_sgpa,ai_mn,f_version) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssssssssssssssss', $p_prn, $p_pname, $p_pemail, $p_pc_number, $p_psc_number, $p_pgender, $p_sgpa, $p_pbranch, $p_pcategory, $p_date, $p_suid, $p_ladd, $p_padd, $p_ph, $p_defence, $p_jk, $p_session, $p_form_cat, $sgpa1, $sgpa2, $p_ai_mn, $p_fversion);
    if($stmt->execute())
        alert_sweet_success("Form Added Successfully!!!");
    else
        alert_sweet_failed("Unable to Add Form!!! Try Again!!!".mysqli_error($mysqli));
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}

/**
*UPDATE POST CODE
**/
if(isset($_POST['update_form_c2']))
{
    $p_uid=$_POST['uid'];
    $p_prn=$_POST['prn'];
    $p_pname=$_POST['pname'];
    $p_padd=$_POST['padd'];
    $p_ladd=$_POST['ladd'];
    $p_pc_number=$_POST['pc_number'];
    $p_psc_number=$_POST['psc_number'];
    $p_pemail=$_POST['pemail'];
    $p_pgender=$_POST['pgender'];
    $p_pcategory=$_POST['pcategory'];
    $p_ph=$_POST['ph'];
    $p_defence=$_POST['defence'];
    $p_jk=$_POST['jk'];
    $p_pbranch=$_POST['pbranch'];
    $p_sgpa=$_POST['sgpa'];
    $p_ai_mn=$_POST['ai_mn'];
    $p_fversion=$f_version+1;
    $i=1;
    $sm=0;
    while($i<6)
    {
        ${"result".$i}=$_POST["result".$i];
        ${"back".$i}=$_POST["back".$i];
        ${"sgpa".$i}=$_POST["sgpa".$i];
        $stati="paf".$i;
        $subsfi="back".$i;
        $sm=${$subsfi}+$sm;
        $semp="s".$i;
        $i=$i+1;
    }
    $p_date=date("j-m-Y");
    //alert($p_user_active);
    /**
    *UPDATE CODE ADDED BY RIZWAN ON 26/06/2017
    **/
    $stmt = $mysqli->prepare("UPDATE form_data SET prn = ?,pname = ?,pemail = ?,pc_no = ?,psc_no = ?,pgender = ?,sgpa = ?,pclass = ?,category = ?,date = ?,ladd = ?,padd = ?,ph = ?,def = ?,jk = ?,s1_result = ?,s1_back = ?,s1_sgpa = ?,s2_result = ?,s2_back = ?,s2_sgpa = ?,s3_result = ?,s3_back = ?,s3_sgpa = ?,s4_result = ?,s4_back = ?,s4_sgpa = ?,s5_result = ?,s5_back = ?,s5_sgpa = ?,ai_mn = ?,f_version = ? WHERE sysid = ?");
    $stmt->bind_param('sssssssssssssssssssssssssssssssss', $p_prn, $p_pname, $p_pemail, $p_pc_number, $p_psc_number, $p_pgender, $p_sgpa, $p_pbranch, $p_pcategory, $p_date, $p_ladd, $p_padd, $p_ph, $p_defence, $p_jk, $result1, $back1, $sgpa1, $result2, $back2, $sgpa2, $result3, $back3, $sgpa3, $result4, $back4, $sgpa4, $result5, $back5, $sgpa5, $p_ai_mn, $p_fversion, $uid);
    if($stmt->execute())
    {
        alert_sweet_success_wr("Form Details Updated Successfully!!!","./?act=form/modify/category-3");
        unset($_SESSION[$user_request]);
    }
    else
        alert_sweet_failed("Unable to Update Form Details!!! Try Again!!!");
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}
?>
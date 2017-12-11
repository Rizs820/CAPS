    <div class="container-fluid">
            <div class="block-header">
                <h2>REPORTS MANAGER (RPM) / DATA REPORTS (D)</h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA REPORTS GENERATION
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
                            <form action="./?act=common/reports/generate" target="_blank" method="POST">
                                <label for="ayear">Select Academic Year</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select id="ayear" name="ayear" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Academic Year</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT DISTINCT year FROM session") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo '<option value="'.$row['year'].'">'.$row['year'].'</option>';
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                               <label for="ses_cat">Select Form Category</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="ses_cat" id="ses_cat" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Form Category</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT cat,descrip FROM ses_cat") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo  '<option value="'.$row['cat'].'">'.$row['descrip'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <label for="gender">Select Gender</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="gender" id="gender" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Form Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    </div>
                                </div>
                                <label for="report_format">Select Data Report Format/Type</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="report_format" id="report_format" class="form-control show-tick" data-live-search="true" required>
                                        <option value="">Please Select Data Report Format/Type</option>
                                        <?php
                                            $query=mysqli_query($mysqli,"SELECT rcode,name FROM reports ORDER BY rcode") or die(mysqli_query($mysqli));
                                            while($row=mysqli_fetch_array($query))
                                            {
                                                echo  '<option value="'.$row['rcode'].'">'.$row['rcode'].' - '.$row['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <input type="hidden" name="request_id" value="<?php echo UUID::v4();?>">
                                <button type="submit" name="generate_reports" value="generate_reports" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">Generate Report</button>
                                
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
    </div>
    
<?php
if(isset($_POST['generate_reports']))
{
    $p_ayear=$_POST['ayear'];
    $p_ses_cat=$_POST['ses_cat'];
    $p_gender=$_POST['gender'];
    $p_report_format=$_POST['report_format'];
    include("reports.format.inc.php/".$p_ses_cat."/".$p_report_format.".php");
}

?>
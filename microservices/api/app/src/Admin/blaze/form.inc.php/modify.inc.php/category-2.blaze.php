<?php
/**
*Session Fecth
**/
$query100=mysqli_query($mysqli,"SELECT * FROM session WHERE status='on' AND category='Category-2'") or die(mysqli_error());
$row100=mysqli_fetch_array($query100);
$session_year=$row100['year'];
if(!$session_year)
{
    alert_sweet_failed_wr("Sorry No Session is Active!!! Please Start New Session!!! ERR-CODE : RM0301CS","./?act=home");
}
?>
    <div class="container-fluid">
            <div class="block-header">
                <h2>FROM MANAGER (FM) /  MODIFY PAGE (M) / FY STUDENTS (FY) / <?php echo $session_year;?></h2>
            </div>    
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW / MODIFY FORM DETAILS
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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>MH Merit No.</th>
                                        <th>Mobile</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>MH Merit No.</th>
                                        <th>Mobile</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $query = "SELECT prn,pname,pclass,sgpa,sysid,pc_no FROM form_data WHERE form_cat='Category-2' AND session='$session_year' ORDER BY sysid";
                                        $stmt = $mysqli->stmt_init();
                                        if(!$stmt->prepare($query))
                                        {
                                            print "No Data Available or Data Fetch Error, Contact Admin!!!\n";
                                        }
                                        else
                                        {
                                            //$stmt->bind_param("s", $continent);
                                            $stmt->execute();
                                           $stmt->bind_result($prn,$pname,$pclass,$sgpa,$sysid,$pc_no);
                                            //$stmt->fetch();
                                            //$result = $stmt->get_result();
                                            while ($stmt->fetch())
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$prn.'</td>';
                                                echo '<td>'.$pname.'</td>';
                                                echo '<td>'.$pclass.'</td>';
                                                echo '<td>'.$sgpa.'</td>';
                                                echo '<td>'.$pc_no.'</td>';
                                                echo '<td><form method="POST"><input type="hidden" id="request_opr'.$sysid.'" value="Edit_Form_C2"><input type="hidden" id="request_id'.$sysid.'" name="request_id" value="'.UUID::v4().'"><input type="hidden" id="uid_val'.$sysid.'" name="uid_val" value="'.$sysid.'"><button type="submit" class="btn bg-light-green waves-effect" id="Edit_Action" name="Edit_Action" value="'.$sysid.'"><i class="material-icons ">mode_edit</i></button></form></td>';
                                                echo '<td><form method="POST"><input type="hidden" id="drequest_opr'.$sysid.'" value="Delete_Form"><input type="hidden" id="drequest_id'.$sysid.'" name="request_id" value="'.UUID::v4().'"><input type="hidden" id="duid_val'.$sysid.'" name="uid_val" value="'.$sysid.'"><button type="submit" class="btn bg-red waves-effect" id="Delete_Action" name="Delete_Action" value="'.$sysid.'"><i class="material-icons ">delete_forever</i></button></form></td>';
                                                echo '</tr>';
            
                                            }
                                        }
                                        $stmt->close();
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
    </div>
    

<?php
/**
*Session Fecth
**/
$query100=mysqli_query($mysqli,"SELECT * FROM session WHERE status='on' AND category='Category-1'") or die(mysqli_error());
$row100=mysqli_fetch_array($query100);
$session_year=$row100['year'];
if(!$session_year)
{
    alert_sweet_failed_wr("Sorry No Session is Active!!! Please Start New Session!!! ERR-CODE : RM0301CS","./?act=home");
}
?>
    <div class="container-fluid">
            <div class="block-header">
                <h2>FROM MANAGER (FM) /  CANCEL/REJECT (CR) / DSE STUDENTS (DSE) / <?php echo $session_year;?></h2>
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
                                        <th>Cancelled</th>
                                        <th>Rejected</th>
                                        <th>Cancel</th>
                                        <th>Reject</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>MH Merit. No</th>
                                        <th>Mobile</th>
                                        <th>Cancelled</th>
                                        <th>Rejected</th>
                                        <th>Cancel</th>
                                        <th>Reject</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $query = "SELECT prn,pname,pclass,sgpa,sysid,pc_no,canc,ver FROM form_data WHERE form_cat='Category-3' AND session='$session_year' ORDER BY sysid";
                                        $stmt = $mysqli->stmt_init();
                                        if(!$stmt->prepare($query))
                                        {
                                            print "No Data Available or Data Fetch Error, Contact Admin!!!\n";
                                        }
                                        else
                                        {
                                            //$stmt->bind_param("s", $continent);
                                            $stmt->execute();
                                            $stmt->bind_result($prn,$pname,$pclass,$sgpa,$sysid,$pc_no,$canc,$ver);
                                            //$stmt->fetch();
                                           // $result = $stmt->get_result();
                                            while ($stmt->fetch())
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$prn.'</td>';
                                                echo '<td>'.$pname.'</td>';
                                                echo '<td>'.$pclass.'</td>';
                                                echo '<td>'.$sgpa.'</td>';
                                                echo '<td>'.$pc_no.'</td>';
                                                echo $canc==1 ? '<td>Yes</td>' : '<td>No</td>';
                                                echo $ver==0 ? '<td>Yes</td>' : '<td>No</td>';

                                                echo '<td><form method="POST"><input type="hidden" id="crequest_opr'.$sysid.'" value="Cancel_Form"><input type="hidden" id="crequest_id'.$sysid.'" name="crequest_id" value="'.UUID::v4().'"><input type="hidden" id="cuid_val'.$sysid.'" name="cuid_val" value="'.$sysid.'"><button type="submit" class="btn bg-orange waves-effect" id="Cancel_Action" name="Cancel_Action" value="'.$sysid.'"><i class="material-icons ">cancel</i></button></form></td>';
                                                echo '<td><form method="POST"><input type="hidden" id="rrequest_opr'.$sysid.'" value="Reject_Form"><input type="hidden" id="rrequest_id'.$sysid.'" name="rrequest_id" value="'.UUID::v4().'"><input type="hidden" id="ruid_val'.$sysid.'" name="ruid_val" value="'.$sysid.'"><button type="submit" class="btn bg-red waves-effect" id="Reject_Action" name="Reject_Action" value="'.$sysid.'"><i class="material-icons ">delete_forever</i></button></form></td>';
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
    

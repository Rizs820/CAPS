    <div class="container-fluid">
            <div class="block-header">
                <h2>RIGHTS MANAGER (RM) / GROUP RIGHTS (GR) / MODIFY RIGHTS (M)</h2>
            </div>    
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW / MODIFY RIGHTS
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
                                        <th>Module</th>
                                        <th>User Group</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Module</th>
                                        <th>User Group</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $query = "SELECT rights_group.uid,access_list.name,user_group.name FROM rights_group,access_list,user_group WHERE access_list.token=rights_group.access_list AND user_group.uid=rights_group.group_id ORDER BY rights_group.uid";
                                        $stmt = $mysqli->stmt_init();
                                        if(!$stmt->prepare($query))
                                        {
                                            print "No Data Available or Data Fetch Error, Contact Admin!!!\n";
                                        }
                                        else
                                        {
                                            //$stmt->bind_param("s", $continent);
                                            $stmt->execute();
                                            $stmt->bind_result($uid, $access_list_name,$user_group_name);
                                            //$stmt->fetch();
                                            //$result = $stmt->get_result();
                                            while ($stmt->fetch())
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$uid.'</td>';
                                                echo '<td>'.$access_list_name.'</td>';
                                                echo '<td>'.$user_group_name.'</td>';
                                                echo '<td><form method="POST"><input type="hidden" id="request_opr'.$uid.'" value="Edit_Group_Rights"><input type="hidden" id="request_id'.$uid.'" name="request_id" value="'.UUID::v4().'"><input type="hidden" id="uid_val'.$uid.'" name="uid_val" value="'.$uid.'"><button type="submit" class="btn bg-light-green waves-effect" id="Edit_Action" name="Edit_Action" value="'.$uid.'"><i class="material-icons ">mode_edit</i></button></form></td>';
                                                echo '<td><form method="POST"><input type="hidden" id="drequest_opr'.$uid.'" value="Delete_Group_Rights"><input type="hidden" id="drequest_id'.$uid.'" name="request_id" value="'.UUID::v4().'"><input type="hidden" id="duid_val'.$uid.'" name="uid_val" value="'.$uid.'"><button type="submit" class="btn bg-red waves-effect" id="Delete_Action" name="Delete_Action" value="'.$uid.'"><i class="material-icons ">delete_forever</i></button></form></td>';
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
    

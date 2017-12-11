    <div class="container-fluid">
            <div class="block-header">
                <h2>USER MANAGER (UM) / MODIFY USER (M)</h2>
            </div>    
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW / MODIFY USERS
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
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $query = "SELECT user_name,user_group.name,email,user_dept,user_active,members.uid FROM members,user_group WHERE user_group.uid=members.user_group AND members.uid<> ? ORDER BY uid";
                                        $stmt = $mysqli->stmt_init();
                                        if(!$stmt->prepare($query))
                                        {
                                            print "No Data Available or Data Fetch Error, Contact Admin!!!\n";
                                        }
                                        else
                                        {
                                            $stmt->bind_param("s", $uid);
                                            $stmt->execute();
                                            $stmt->bind_result($user_name,$user_group_name,$email,$user_dept,$user_active,$uid);
                                            //$stmt->fetch();
                                            //$result = $stmt->get_result();
                                            while ($stmt->fetch())
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$user_name.'</td>';
                                                echo '<td>'.$user_group_name.'</td>';
                                                echo '<td>'.$email.'</td>';
                                                echo '<td>'.$user_dept.'</td>';
                                                echo '<td>'.$user_active.'</td>';
                                                echo '<td><form method="POST"><input type="hidden" id="request_opr'.$uid.'" value="Edit_User"><input type="hidden" id="request_id'.$uid.'" name="request_id" value="'.UUID::v4().'"><input type="hidden" id="uid_val'.$uid.'" name="uid_val" value="'.$uid.'"><button type="submit" class="btn bg-light-green waves-effect" id="Edit_Action" name="Edit_Action" value="'.$uid.'"><i class="material-icons ">mode_edit</i></button></form></td>';
                                                echo '<td><form method="POST"><input type="hidden" id="drequest_opr'.$uid.'" value="Delete_User"><input type="hidden" id="drequest_id'.$uid.'" name="request_id" value="'.UUID::v4().'"><input type="hidden" id="duid_val'.$uid.'" name="uid_val" value="'.$uid.'"><button type="submit" class="btn bg-red waves-effect" id="Delete_Action" name="Delete_Action" value="'.$uid.'"><i class="material-icons ">delete_forever</i></button></form></td>';
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
    

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user_name;?></div>
                    <div class="email"><?php echo $email;?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <!--li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li-->
                            <li role="seperator" class="divider"></li>
                            <li><a href="includes/logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li>
                        <a href="includes/logout.php">
                            <i class="material-icons">power_settings_new</i>
                            <span>Logout</span>
                        </a>
                    </li>
                    <li class="header">MAIN NAVIGATION</li>
                    
                    <li <?php echo in_array("home", $path) ? 'class="active"' : ""; ?>>
                        <a href="./?act=home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php
                    if($user_group==1||user_accessp($mysqli,$uid,"profile")==1||group_accessp($mysqli,$user_group,"profile")==1)
                    {
                    ?>
                    <li <?php echo in_array("profile", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>My Profile (P)</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo in_array("password", $path)&&in_array("profile", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=profile/password">Change Password (CP)</a>
                            </li>
                            <li <?php echo in_array("update", $path)&&in_array("profile", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=profile/update">Update Profile (UP)</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    if($user_group==1||user_accessp($mysqli,$uid,"user")==1||group_accessp($mysqli,$user_group,"user")==1)
                    {
                    ?>
                    <li <?php echo in_array("user", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>User Manager (UM)</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo in_array("add", $path)&&in_array("user", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=user/add">Add (A)</a>
                            </li>
                            <li <?php echo in_array("modify", $path)&&in_array("user", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=user/modify">Modify (M)</a>
                            </li>
                            <li <?php echo in_array("password", $path)&&in_array("user", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=user/password">Reset Password (RP)</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    if($user_group==1||user_accessp($mysqli,$uid,"session")==1||group_accessp($mysqli,$user_group,"session")==1)
                    {
                    ?>
                    <li <?php echo in_array("session", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">layers</i>
                            <span>Session Manager (SM)</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo in_array("add", $path)&&in_array("session", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=session/add">Add (A)</a>
                            </li>
                            <li <?php echo in_array("modify", $path)&&in_array("session", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=session/modify">Modify (M)</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    if($user_group==1||user_accessp($mysqli,$uid,"form")==1||group_accessp($mysqli,$user_group,"form")==1)
                    {
                    ?>
                    <li <?php echo in_array("form", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Form Manager (FM)</span>
                        </a>
                        <ul class="ml-menu">
                            <li  <?php echo in_array("add", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Add (A)</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo in_array("add", $path)&&in_array("category-1", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/add/category-1">SY-LY Students (STL)</a>
                                    </li>
                                    <li <?php echo in_array("add", $path)&&in_array("category-2", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/add/category-2">FY Students (FY)</a>
                                    </li>
                                    <li <?php echo in_array("add", $path)&&in_array("category-3", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/add/category-3">DSE Students (DSE)</a>
                                    </li>
                                </ul>
                            </li>
                            <li  <?php echo in_array("modify", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Modify (M)</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo in_array("modify", $path)&&in_array("category-1", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/modify/category-1">SY-LY Students (STL)</a>
                                    </li>
                                    <li <?php echo in_array("modify", $path)&&in_array("category-2", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/modify/category-2">FY Students (FY)</a>
                                    </li>
                                    <li <?php echo in_array("modify", $path)&&in_array("category-3", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/modify/category-3">DSE Students (DSE)</a>
                                    </li>
                                </ul>
                            </li>
                            <li  <?php echo in_array("reject", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cancel/Reject (CR)</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo in_array("reject", $path)&&in_array("category-1", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/reject/category-1">SY-LY Students (STL)</a>
                                    </li>
                                    <li <?php echo in_array("reject", $path)&&in_array("category-2", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/reject/category-2">FY Students (FY)</a>
                                    </li>
                                    <li <?php echo in_array("reject", $path)&&in_array("category-3", $path)&&in_array("form", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=form/reject/category-3">DSE Students (DSE)</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    if($user_group==1||user_accessp($mysqli,$uid,"seats")==1||group_accessp($mysqli,$user_group,"seats")==1)
                    {
                    ?>
                    <li <?php echo in_array("seats", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Seats Manager (STM)</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo in_array("category-1", $path)&&in_array("seats", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=seats/category-1">SY-LY Students (STL)</a>
                            </li>
                            <li <?php echo in_array("category-2", $path)&&in_array("seats", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=seats/category-2">FY Students (FY)</a>
                            </li>
                            <li <?php echo in_array("category-3", $path)&&in_array("seats", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=seats/category-3">DSE Students (DSE)</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    if($user_group==1||user_accessp($mysqli,$uid,"reports")==1||group_accessp($mysqli,$user_group,"reports")==1)
                    {
                    ?>
                    <li <?php echo in_array("reports", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Reports Manager (RPM)</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php echo in_array("data", $path)&&in_array("reports", $path)  ? 'class="active"' : ""; ?>>
                                <a href="./?act=reports/data">Data Reports (D)</a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php
                    }
                    if($user_group==1||user_accessp($mysqli,$uid,"rights")==1||group_accessp($mysqli,$user_group,"rights")==1)
                    {
                    ?>
                    <li <?php echo in_array("rights", $path) ? 'class="active"' : ""; ?> >
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Rights Manager (RM)</span>
                        </a>
                        <ul class="ml-menu">
                            <li  <?php echo in_array("users", $path)&&in_array("rights", $path)  ? 'class="active"' : ""; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>User Rights (UR)</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo in_array("add", $path)&&in_array("users", $path)&&in_array("rights", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=rights/users/add">Add (A)</a>
                                    </li>
                                    <li <?php echo in_array("modify", $path)&&in_array("users", $path)&&in_array("rights", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=rights/users/modify">Modify (M)</a>
                                    </li>
                                </ul>
                            </li>
                            <li  <?php echo in_array("group", $path)&&in_array("rights", $path)  ? 'class="active"' : ""; ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Group Rights (GR)</span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php echo in_array("add", $path)&&in_array("group", $path)&&in_array("rights", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=rights/group/add">Add (A)</a>
                                    </li>
                                    <li <?php echo in_array("modify", $path)&&in_array("group", $path)&&in_array("rights", $path)  ? 'class="active"' : ""; ?>>
                                        <a href="./?act=rights/group/modify">Modify (M)</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">CAPS - By Rizwan Syed</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 4.4
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        
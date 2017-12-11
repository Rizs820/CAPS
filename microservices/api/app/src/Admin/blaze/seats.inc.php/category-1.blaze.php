<?php 
/**
*PARAMETERS FETCH FOR FORM
**/
$cat="Category-1";
$query100=mysqli_query($mysqli,"SELECT * FROM session WHERE status='on' AND category='$cat'") or die(mysqli_error());
$row100=mysqli_fetch_array($query100);
$session_year=$row100['year'];
if(!$session_year)
{
    alert_sweet_failed_wr("Sorry No Session is Active!!! Please Start New Session!!! ERR-CODE : RM0301CS","./?act=home");
}

//alert($session_year);
?>



    <div class="container-fluid">
            <div class="block-header">
                <h2>SEATS MANAGER (STM) / SY-LY STUDENTS (STL)</h2>
            </div>    
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SEATS MANAGER
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
                            <form action="" method="POST" name="seat_manager">
                                <b>
                                <div class="row">
                                    <div class="col-md-3">Class</div>
                                    <div class="col-md-2">Gender</div>
                                    <?php
                                        $query20=mysqli_query($mysqli,"SELECT DISTINCT cat FROM category ORDER BY uid") or die(mysqli_error());
                                        while($row20=mysqli_fetch_array($query20))
                                        {
                                        ?>
                                            <div class="col-md-1"><?php echo $row20['cat'];?></div>
                                        <?php
                                        }
                                    ?>
                                </div>
                                <div class="row clearfix"></div>
                                </b>
                                <?php
                                    $query3=mysqli_query($mysqli,"SELECT DISTINCT name FROM gender ORDER BY uid") or die(mysqli_error());
                                            while($row3=mysqli_fetch_array($query3))
                                            {
                                                $g=$row3['name'];
                                                $query4=mysqli_query($mysqli,"SELECT DISTINCT name FROM department WHERE hasres=1 ORDER BY uid") or die(mysqli_error());
                                                while($row4=mysqli_fetch_array($query4))
                                                {
                                                    $d=$row4['name'];
                                                    $query5=mysqli_query($mysqli,"SELECT DISTINCT name FROM cls WHERE stud_cat='$cat'  ORDER BY uid") or die(mysqli_error());
                                                    while($row5=mysqli_fetch_array($query5))
                                                    {
                                                        $c=$row5['name'];
                                ?>
                                                    <div class="row">
                                                        <div class="col-md-3"><?php echo $c." ".$d;?></div>
                                                        <div class="col-md-2"><?php echo $g;?></div>
                                <?php
                                                            $query50=mysqli_query($mysqli,"SELECT DISTINCT cat FROM category ORDER BY uid") or die(mysqli_error());
                                                            while($row50=mysqli_fetch_array($query50))
                                                            {
                                                                $ct=$row50['cat'];
                                                                $cls=$c." ".$d;
                                                                $query6=mysqli_query($mysqli,"SELECT seats FROM reserve WHERE pgender='$g' AND seat_cat='$cat' AND category='$ct' AND pclass='$cls' AND session='$session_year'") or die(mysqli_error($mysqli));
                                                                $row6=mysqli_fetch_array($query6);

                                                                if($ct=="PH")
                                                                {
                                                                    $query7=mysqli_query($mysqli,"SELECT * FROM form_data WHERE pgender='$g' AND form_cat='$cat' AND ph='Yes' AND pclass='$cls' AND session='$session_year' AND ver=1") or die(mysqli_error($mysqli));
                                                                    $mycnt=mysqli_num_rows($query7);
                                                                }
                                                                else
                                                                {
                                                                    $query7=mysqli_query($mysqli,"SELECT * FROM form_data WHERE pgender='$g' AND form_cat='$cat' AND category='$ct' AND pclass='$cls' AND session='$session_year' AND ver=1") or die(mysqli_error($mysqli));
                                                                    $mycnt=mysqli_num_rows($query7);
                                                                }
                                                        ?>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input  name="<?echo $g.$d.$c.$ct;?>" type="text" value="<?php echo $row6['seats'];?>" class="form-control" required>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    
                                                                    <input  type="text" value="<?php echo $mycnt;?>" class="form-control" readonly disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="row clearfix"></div>
                                <?php
                                                    }
                                                }
                                            }
                                ?>

                                <input type="hidden" name="request_id" value="<?php echo UUID::v4();?>">
                                <input type="hidden" name="cat" value="<?php echo $cat;?>">
                                <input type="hidden" name="p_year" value="<?php echo $session_year;?>">
                               
                                <button type="submit" name="update_seats_c1" value="update_seats_c1" class="btn btn-block btn-lg btn-primary m-t-20 waves-effect">UPDATE SEATS</button>
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
if(isset($_POST['update_seats_c1']))
{
    $result=0;
    if (isset($_POST['cat'])) 
    {
        $p_cat=$_POST['cat'];
        $p_year=$_POST['p_year'];
        //alert($session_year);
        $query3=mysqli_query($mysqli,"SELECT DISTINCT name FROM gender ORDER BY uid") or die(mysqli_error());
        $result=0;
        while($row3=mysqli_fetch_array($query3))
        {
            $g=$row3['name'];

            $query4=mysqli_query($mysqli,"SELECT DISTINCT name FROM department WHERE hasres=1 ORDER BY uid") or die(mysqli_error());
            while($row4=mysqli_fetch_array($query4))
            {
                $d=$row4['name'];
                //alert($d);
                $query5=mysqli_query($mysqli,"SELECT DISTINCT name FROM cls WHERE stud_cat='$p_cat' ORDER BY uid") or die(mysqli_error());
                while($row5=mysqli_fetch_array($query5))
                {
                    $c=$row5['name'];
                    $query50=mysqli_query($mysqli,"SELECT DISTINCT cat FROM category ORDER BY uid") or die(mysqli_error());
                    while($row50=mysqli_fetch_array($query50))
                    {
                        $cls=$c." ".$d;
                        //alert($cls);
                        $ct=$row50['cat'];
                        ${$g.$d.$c.$ct}=$_POST{$g.$d.$c.$ct};
                        //alert(${$g.$d.$c.$ct});
                        $query7="UPDATE reserve SET seats='${$g.$d.$c.$ct}' WHERE pgender='$g' AND pclass='$cls' AND category='$ct' AND session='$p_year' AND seat_cat='$p_cat'";
                        mysqli_query($mysqli,$query7) or die(mysqli_error($mysqli));    
                        $result=1;          
                    }
                }
            }
        }
        if($result)
        {
            /*$res1=mysqli_query($mysqli,"SELECT * FROM session WHERE email='$p_email' AND pmob='$p_pmob' AND pcollege='$p_pcollege' AND pname='$p_pname'") or die(mysqli_error());
            $row1=mysqli_fetch_array($res1);*/
            alert_sweet_success("Seats Updated Successfully!!!");
            //mysqli_free_result($mysqli,$result);
        }
        else
        {
            alert_sweet_failed("Unable to Update Seats, Please Tyr Again or Contact Support!!!".mysqli_error($mysqli));
                        //mysqli_free_result($mysqli,$result);
        }   
    }
    else
    {
        alert_sweet_failed("Wrong Post Variable, Please Contact Support!!!");
    }
    
    $_REQUEST = $_POST = $_GET = NULL;
}

?>
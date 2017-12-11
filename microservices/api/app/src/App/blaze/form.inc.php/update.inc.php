<?php
if(isset($_POST['submit_stud_form']))
{
	$p_prn=$_POST['prn'];
    $p_pname=$_POST['pname'];
    $p_padd=$_POST['padd'];
    $p_ladd=$_POST['ladd'];
    $p_pc_number=$_POST['pc_no'];
    $p_psc_number=$_POST['psc_no'];
    $p_pemail=$_POST['pemail'];
    $p_pgender=$_POST['pgender'];
    $p_pcategory=$_POST['pcategory'];
    $p_ph=$_POST['ph'];
    $p_defence=$_POST['defence'];
    $p_jk=$_POST['jk'];
    $p_pbranch=$_POST['pclass'];
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
    $p_form_cat=$m_form_cat;
    $p_session=$ses;
    $p_date=date("j-m-Y");
    $p_suid=uniqid().rand();
    $blank_var="";
    //alert($p_user_active);
    /**
    *UPDATE CODE ADDED BY RIZWAN ON 26/06/2017
    **/
    $stmt = $mysqli->prepare("UPDATE form_data SET prn = ?,pname = ?,pc_no = ?,psc_no = ?,pgender = ?,sgpa = ?,pclass = ?,category = ?,date = ?,ladd = ?,padd = ?,ph = ?,def = ?,jk = ?,s1_result = ?,s1_back = ?,s1_sgpa = ?,s2_result = ?,s2_back = ?,s2_sgpa = ?,s3_result = ?,s3_back = ?,s3_sgpa = ?,s4_result = ?,s4_back = ?,s4_sgpa = ?,s5_result = ?,s5_back = ?,s5_sgpa = ?,ai_mn = ?,access_token = ?,token_time = ? , f_version = ? WHERE access_token = ? AND form_cat = ? AND session = ? AND pemail = ?");
    $stmt->bind_param('sssssssssssssssssssssssssssssssssssss', $p_prn, $p_pname, $p_pc_number, $p_psc_number, $p_pgender, $p_sgpa, $p_pbranch, $p_pcategory, $p_date, $p_ladd, $p_padd, $p_ph, $p_defence, $p_jk, $result1, $back1, $sgpa1, $result2, $back2, $sgpa2, $result3, $back3, $sgpa3, $result4, $back4, $sgpa4, $result5, $back5, $sgpa5, $p_ai_mn, $blank_var, $blank_var, $p_fversion, $access_tokenf, $p_form_cat, $p_session, $m_pemail);
    if($stmt->execute())
    {
    ?>
        <div class="content-w3ls">
            <h1 class="agile-head text-center"><b><u><i>CAPS</i></u></b></h1>
            <div class="form-w3layouts">                    
                <center>
                <font style="color: white; text-shadow: -1px 0 black, 0 5px purple, 5px 0 purple, 0 -1px purple;" size="5">
                    <?php echo $p_pname;?> - Form Has been Successfully Submittted!!!
                </font>
                <form action="./?act=common/report/generate" target="_blank" method="post">
                    <input type="hidden" id="email" name="email"  required="" value="<?php echo $m_pemail;?>">
                    <input type="hidden" id="ayear" name="ayear"  value="<?php echo $p_session;?>" >
                    <input type="hidden" id="ses_cat" name="ses_cat"  value="<?php echo $p_form_cat;?>" >
                    <div class="form-control w3ls-end">
                        <input type="submit" class="register1" name="submit" value="Click Here to Download Form"><br>
                        <a href="../" style="color: #ff00ff;" size="5">Click here to go back</a>
                        <div class="clear"></div>
                    </div>
                </form>
                </center>
            </div>
        </div>
    <?php
    }
    else
    {
    ?>
        <div class="content-w3ls">
            <h1 class="agile-head text-center"><b><u><i>CAPS</i></u></b></h1>
            <div class="form-w3layouts">                    
                <center>
                <font style="color: white;" size="5">
                     Unable to Process!!!
                </font>    
                <div class="form-control w3ls-end">
                    <a href="<?php echo 'http://gcoej.ac.in/caps/App?access_token='.$access_tokenf; ?>" class="register">Click Here to Try Again</a>
                    <div class="clear"></div>
                </div>
                </center>
            </div>
        </div>
    <?php
    }
    $stmt->close();
    $_REQUEST = $_POST = $_GET = NULL;
}
?>
<?php
if(isset($_POST['generate_reports']))
{
    $p_ayear=$_POST['ayear'];
    $p_ses_cat=$_POST['ses_cat'];
    $p_gender=$_POST['gender'];
    $p_report_format=$_POST['report_format'];
    include("blaze/reports.inc.php/reports.format.inc.php/".$p_ses_cat."/".$p_report_format.".php");
}
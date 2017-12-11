<?php
//alert("Hi");
if(isset($_POST['generate_reports']))
{
    $p_ayear=$_POST['ayear'];
    $p_ses_cat=$_POST['ses_cat'];
    $p_gender=$_POST['gender'];
    $p_report_format=$_POST['report_format'];
    $query=mysqli_query($mysqli,"SELECT uid FROM session WHERE year='$p_ayear' AND category='$p_ses_cat' LIMIT 1");
    if (mysqli_num_rows($query)==1) 
    	include("reports.format.inc.php/".$p_ses_cat."/".$p_report_format.".php");
    else
    {
    	alert("Invalid Selection, Please Select Again!!!");
    	echo '<h1>Error Occurred</h1><h3>Invalid Selection - ERRCODE - RM0301IN</h3><h3>Reason</h3><ul><li>Invalid Category & Session Selection</li><li>You may selected Session for which no Form Category exists.</li></ul>';
    }
}
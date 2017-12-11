<?php
include_once '../Admin/includes/db_connect.php';
include_once '../Admin/includes/functions.php';
include_once '../Admin/includes/fetch.php';


session_start();            // Start the PHP session 
date_default_timezone_set('Asia/Kolkata');


$user_request=$_GET["act_request"];
$my_secrete_code="RizMah0301+";
$my_page=$_GET["act"];
$access_tokenf=$_GET["access_token"];
$access_tokenf=mysqli_real_escape_string($mysqli,$access_tokenf);
$ses_cat=$_POST['form_cat'];
//alert($ses_cat);
if($my_page=="common/report/generate")
{
    include("blaze/reports.inc.php/generate.blaze.php");   
}
elseif($my_page=="user/register")
{
	include("blaze/newtoken.inc.php");	
	include("home.inc.php");
}
elseif($my_page=="user/edit")
{
	include("blaze/edittoken.inc.php");	
	include("home.inc.php");
}
else
{
    include("home.inc.php");
}
?>
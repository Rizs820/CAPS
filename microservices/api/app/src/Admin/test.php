<?php

//include("includes/functions.php");

//alert($_POST['request_id']." ".$_POST['uid_val']." ".$_POST['request_opr']);

//echo $_POST['request_id']." ".$_POST['uid_val']." ".$_POST['request_opr'];
/*$result=0;
$myrequest=array();
$url="";
$message="";
$redirect=0;
$request_id=$_POST['request_id'];
$uid_val=$_POST['uid_val'];
$request_opr=$_POST['request_opr'];

if($request_opr=="Edit_User")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=user/add&act_request=".$request_id;
	$redirect=1;

}
elseif($request_opr=="Delete_User") 
{
	$redirect=0;
	$result=1;
	$message="User Deleted Successfully!!!";
}

echo json_encode(array("redirect" => $redirect, "url" => $url, "message" => $message, "result" => $result));
*/

$uploaddir = 'upload/';
$uploadfile = $uploaddir . basename($_FILES['upfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

?>
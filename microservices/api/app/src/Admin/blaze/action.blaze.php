<?php
session_start();            // Start the PHP session 
date_default_timezone_set('Asia/Kolkata');
include_once '../includes/db_connect.php';

//include("includes/functions.php");

//alert($_POST['request_id']." ".$_POST['uid_val']." ".$_POST['request_opr']);

//echo $_POST['request_id']." ".$_POST['uid_val']." ".$_POST['request_opr'];
$result=0;
$myrequest=array();
$url="";
$message="";
$redirect=0;
$request_id=$_POST['request_id'];
$uid_val=$_POST['uid_val'];
$request_opr=$_POST['request_opr'];
$rreason=$_POST['rreason'];

if($request_opr=="Edit_User")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=user/add&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_User") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM members WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete User!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="User Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Cancel_Form") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "UPDATE form_data SET canc = CASE canc WHEN 1 THEN 0 WHEN 0 THEN 1 END WHERE sysid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Perform Action!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Action Completed Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}

elseif($request_opr=="Reject_Form") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**///reject_reason='$rreason',
	$query = "UPDATE form_data SET reject_reason='$rreason', ver = CASE ver WHEN 1 THEN 0 WHEN 0 THEN 1 END WHERE sysid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Perform Action!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Action Completed Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}

elseif($request_opr=="Edit_Session")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=session/add&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_Session") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM session WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete Session!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Session Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Edit_Form_C1")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=form/add/category-1&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Edit_Form_C2")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=form/add/category-2&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Edit_Form_C3")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=form/add/category-3&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_Form") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM form_data WHERE sysid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete Session!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Session Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Edit_Page")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=page/add&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_Page") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM pages WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete Page!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Page Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Edit_Gallery")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=gallery/add&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_Gallery") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM gallery WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete Page!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Gallery Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Update_Content")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=content/update&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Modify_File")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=file/upload&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Copy_File")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=file/upload&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_File") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM files WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete File!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="File Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Modify_Image")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=gallery/upload&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Copy_Image")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=gallery/upload&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_Image") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM gallery_images WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete Image!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Image Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Edit_Group_Rights")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=rights/group/add&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_Group_Rights") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM rights_group WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete Group Rights!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="Group Rights Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
elseif($request_opr=="Edit_User_Rights")
{
	$myrequest[]=$request_opr;
	$myrequest[]=$uid_val;
	$_SESSION[$request_id]=$myrequest;
	$url="./?act=rights/users/add&act_request=".$request_id;
	$redirect=1;
	$message=$uid_val;
}
elseif($request_opr=="Delete_User_Rights") 
{
	$redirect=0;
	/**
	*DELETE OPERATION ADDED BY RIZWAN ON 26/06/2017
	**/
	$query = "DELETE FROM rights_user WHERE uid = ?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        $result=0;
		$message="Unable to Delete User Rights!!! UID - ".$uid_val;
    }
    else
    {
		$stmt->bind_param('s', $uid_val);
		$stmt->execute(); 
		$stmt->close();
		$result=1;
		$message="User Rights Deleted Successfully!!! UID - ".$uid_val;
		$url=$uid_val;
	}
}
echo json_encode(array("redirect" => $redirect, "url" => $url, "message" => $message, "result" => $result));

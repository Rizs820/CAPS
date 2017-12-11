<?php

if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$category=$_POST['ses_cat'];
	$session=$_POST['ayear'];
	//alert($email);
	//$email="rizwansyed820@gmail.com";
	$access_token = UUID::v4();
	$time_n=date('Y-m-d H:i:s', strtotime('1 hour'));
	
	$query2="SELECT * FROM form_data WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
	$result2=mysqli_query($mysqli,$query2) or die(mysqli_error($mysqli));
	$count=mysqli_num_rows($result2);
	$row2=mysqli_fetch_array($result2);
	$date = new DateTime(date("Y-m-j H:i:s") );
	$date2 = new DateTime($row2['token_time']);
	$diffInSeconds = $date2->getTimestamp() - $date->getTimestamp();
	$pname=$row2['pname'];
	/*if($diffInSeconds<0)
	{
		$opr_msg_flag=1;
		$opr_msg="Access Token Expired!!! Please Generate Access Token Again!!!";
		include("blaze/result.inc.php");
	}*/
	//alert($pname);
	if($count)
	{
		if($pname!="")
		{
			$opr_msg_flag=1;
			$opr_msg=$pname." - You have already filled form!!! Try in Griveance Period!!!";
			//include("blaze/result.inc.php");
		}
		else
		{	
			$query="UPDATE form_data SET access_token='$access_token',token_time='$time_n' WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
			$result=mysqli_query($mysqli,$query);
			if($result)
			{
				$query1="SELECT * FROM form_data WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
				$result1=mysqli_query($mysqli,$query1) or die(mysqli_error($mysqli));
				$row=mysqli_fetch_array($result1);
				if($row['f_version']<4)
				{
					mail_send($email,"CAPS : Link For Form Filling (GCOEJ Hostel Admission ".$session.")","otp.php","https://gcoej.ac.in/caps/App?access_token=".$access_token);
					//alert("Link For Form Filling Sent to Your Mail, Please Check Your Mail!!!");
					$opr_msg='Link For Form Filling Sent to Your Mail, Please Check Your Mail!!!';
				}
				else
				{
					$query="UPDATE form_data SET access_token='', token_time='' WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
					$result=mysqli_query($mysqli,$query);
					$opr_msg='Sorry!!! Edit Attempts are not Available!!!';
				}
			}
			else
			{
				$opr_msg="Something Went Wrong!!! Contact Admin!!!";	
			}
		}
	}
	else
	{
		$query="INSERT INTO form_data (pemail,access_token,token_time,form_cat,session) VALUES('$email','$access_token','$time_n','$category','$session')";
		$result=mysqli_query($mysqli,$query);
		if($result)
		{
			$query1="SELECT * FROM form_data WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
			$result1=mysqli_query($mysqli,$query1) or die(mysqli_error($mysqli));
			$row=mysqli_fetch_array($result1);
			if($row['f_version']<4)
			{
				mail_send($email,"CAPS : Link For Form Filling (GCOEJ Hostel Admission ".$session.")","otp.php","https://gcoej.ac.in/caps/App?access_token=".$access_token);
				//alert("Link For Form Filling Sent to Your Mail, Please Check Your Mail!!!");
				$opr_msg='Link For Form Filling Sent to Your Mail, Please Check Your Mail!!!';
			}
			else
			{
				$query="UPDATE form_data SET access_token='', token_time='' WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
				$result=mysqli_query($mysqli,$query);
				$opr_msg='Sorry!!! Edit Attempts are not Available!!!';
			}
		}
		else
		{
			$opr_msg="Something Went Wrong!!! Contact Admin!!!";	
		}
	}
	
}
else
{
	$opr_msg="Something Went Wrong!!! Proceed Again!!!";	
}
$opr_msg_flag=1;
?>
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

	$query2="SELECT uid FROM form_data WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
	$result2=mysqli_num_rows(mysqli_query($mysqli,$query2));
	//alert($email." ".$category." ".$session);
	if($result2)
	{
		$query="UPDATE form_data SET access_token='$access_token', token_time='$time_n' WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
		$result=mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
		$query1="SELECT * FROM form_data WHERE pemail='$email' AND form_cat='$category' AND session='$session'";
		$result1=mysqli_query($mysqli,$query1) or die(mysqli_error($mysqli));
		$row=mysqli_fetch_array($result1);
		if($row['f_version']<4)
		{
			mail_send($email,"CAPS : Link for For Form Editing (GCOEJ Hostel Admission ".$session.")","otp.php","https://gcoej.ac.in/caps/App?access_token=".$access_token);
			//alert("Edit Link is Sent to Your Email, Please Check Your Mail!!!");
			$opr_msg='Edit Link is Sent to Your Email!!!';
			//$opr_msg=$result;
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
		//alert("Wrong Email");
		$opr_msg="Sorry Wrong EMail Provided!!!";	
	}
}
else
{
	$opr_msg="Something Went Wrong!!! Proceed Again!!!";	
}
$opr_msg_flag=1;
?>
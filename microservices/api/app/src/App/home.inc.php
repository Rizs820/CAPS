
<!DOCTYPE html>
<html>
<head>
<title>Central Application Processing System (CAPS)</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=News+Cycle:400,700" rel="stylesheet">
</head>
<body>
		<?php
			if(isset($_POST['form_cat']))
			{
				$query=mysqli_query($mysqli,"SELECT * FROM session WHERE category='$ses_cat' AND status='on' LIMIT 1");
				if (mysqli_num_rows($query)==0) 
				{
					include("blaze/noactive.inc.php");
				}
				else
				{
					$row=mysqli_fetch_array($query);
					$ayear=$row['year'];
					$dos=$row['dos'];
					$doe=$row['doe'];
					$gos=$row['gos'];
					$goe=$row['goe'];
					$fpublic=$row['public'];
					$query1=mysqli_query($mysqli,"SELECT descrip FROM ses_cat WHERE cat='$ses_cat' LIMIT 1");
					$row1=mysqli_fetch_array($query1);
					$classd=$row1['descrip'];
					include("blaze/stud_home.inc.php");	
				}
			}
			else
			{
				//alert($access_token);
				if($access_tokenf)
				{
					$query2=mysqli_query($mysqli,"SELECT * FROM form_data WHERE access_token='$access_tokenf'");
					$result2=mysqli_num_rows($query2);
					//alert($result2);
					if ($result2==0) 
					{
						$opr_msg_flag=1;
						$opr_msg="Invalid Access Token!!! Please Generate Access Token Again!!!";
						include("blaze/result.inc.php");
					}
					else
					{

						$row2=mysqli_fetch_array($query2);
						$date = new DateTime(date("Y-m-j H:i:s") );
						$date2 = new DateTime($row2['token_time']);
						$diffInSeconds = $date2->getTimestamp() - $date->getTimestamp();
						if($diffInSeconds<0)
						{
							$opr_msg_flag=1;
							$opr_msg="Access Token Expired!!! Please Generate Access Token Again!!!";
							include("blaze/result.inc.php");
						}
						else
						{
							$m_pemail=$row2['pemail'];
							$m_pname=$row2['pname'];
							$m_pc_no=$row2['pc_no'];
							$m_psc_no=$row2['psc_no'];
							$m_pgender=$row2['pgender'];
							$m_sgpa=$row2['sgpa'];
							$m_pclass=$row2['pclass'];
							$m_pcategory=$row2['category'];
							//$m_membs=$row2['membs'];
							$m_accd=$row2['accd'];
							$m_padd=$row2['padd'];
							$m_ladd=$row2['ladd'];
							$m_ph=$row2['ph'];
							$m_def=$row2['def'];
							$m_jk=$row2['jk'];
							$cuid=$row2['uid'];
							$pdate=$row2['date'];
							$ses=$row2['session'];
							$m_prn=$row2['prn'];
							$m_ai_mn=$row2['ai_mn'];
							$m_form_cat=$row2['form_cat'];
							$f_version=$row2['f_version'];
							if($m_pgender=="Male")
								$gh="Boy's";
							else if($m_pgender=="Female")
								$gh="Girl's";
							
							$i=1;
							while($i<6)
							{
								$res="s".$i."_result";
								$back="s".$i."_back";
								$sgpa="s".$i."_sgpa";
								${"result".$i}=$row2[$res];
								${"back".$i}=$row2[$back];
								${"sgpa".$i}=$row2[$sgpa];
								
								
								$i=$i+1;
							}
							if(isset($_POST['submit_stud_form']))
								include("blaze/form.inc.php/update.inc.php");
							else
								include("blaze/form.inc.php/".$m_form_cat.".inc.php");	
						}
					}		
				}
				else
				{
					if($opr_msg_flag==1)
						include("blaze/result.inc.php");
					else
						include("blaze/error.inc.php");
				}
			}
		?>		
		<div class="clear"></div>
		<div class="agileits-w3layouts-copyright text-center">
			<p class="w3ls-copyright"><?php echo "©".date('Y');  ?>&nbsp;CAPS. All rights reserved | Developed by Prof.Harish Gadade , Rizwan R Syed & Akshay Ghodake</p>
		</div>	
</body>
</html>


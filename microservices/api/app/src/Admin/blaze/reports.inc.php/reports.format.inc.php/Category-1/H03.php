<?php
require ('includes/fpdf/fpdf.php');
	$gender=$_POST['gender'];
	$session=$_POST['ayear'];
	if($gender=="Male")
		$gh="Boys";
	else
		$gh="Girls";
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

// Page header
function Header()
{


	$gender=$_POST['gender'];
	$session=$_POST['ayear'];
	if($gender=="Male")
		$gh="Boys";
	else
		$gh="Girls";
	// Logo
	$this->Image('logo.png',40,6,200);
	
	$this->Ln(25);
	// Arial 12
$this->SetFont('Arial','B',14);
// Background color
$this->SetTextColor(255);
$this->SetFillColor(0,0,0);
// Title
$this->Cell(280,6,$gh." Hostel Seat Allotment (".$session.")",0,1,'C',true);
// Line break
$this->SetTextColor(0);
$this->Ln(1);
$this->SetFont('Times','B',12);
//$this->Cell(200,7,"*Note : Those Who have 'Unverified Remark' Please Visit at 102",0,1,'C');
//$this->Ln();
$this->SetFont('courier','B',11);
$this->Cell(9,6,"MN",1);
        $this->Cell(72,6,"Name of Student",1);
		$this->Cell(44,6,"Class",1);
		$this->Cell(23,6,"Category",1);
		//$this->Cell(25,7,"Category",1);
		$this->Cell(20,6,"Percent",1);
		$this->Cell(15,6,"Back",1);
		$this->Cell(20,6,"Prev. %",1);
		$this->Cell(12,6,"PH",1);
		$this->Cell(65,6,"Seat Status",1);
    $this->Ln();
	// Arial bold 15
	/*$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(30);
	// Title
	$this->Cell(150,10,'Government College of Engineering, Jalgaon',1,0,'C');*/
	// Line break
	
}
// Page footer
function Footer()
{
	
}





}
// Instanciation of inherited class
$pdf = new PDF('L','mm','A4');
$header = array('Name', 'Branch & Year', 'Category', 'Remarks');

$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('courier','',10);
//$pdf->BasicTable($header,$data);
$cnt=1;
$cat_s=$_POST['ses_cat'];
	mysqli_query($mysqli,"UPDATE form_data SET stype='',sagn='' WHERE form_cat='$cat_s'")or die(mysqli_error($mysqli));
	$query1=mysqli_query($mysqli,"select * from department where hasres=1")or die(mysqli_error($mysqli));
	while($row1=mysqli_fetch_array($query1))
	{
		$d=$row1['name'];
		
		$query2=mysqli_query($mysqli,"select * from cls  WHERE stud_cat='$cat_s' and session='$session'")or die(mysqli_error($mysqli));
		while($row2=mysqli_fetch_array($query2))
		{
			//CLASS
			$myr=$row2['name'];
			$cls=$row2['name']." ".$d;
			
			
			//SET FLAG 0
			//mysqli_query("UPDATE form_data SET stype=''")or die(mysqli_error());
			mysqli_query($mysqli,"UPDATE form_data SET accd=0")or die(mysqli_error($mysqli));
			$query3=mysqli_query($mysqli,"select * from category ORDER BY rprt ")or die(mysqli_error($mysqli));
			while($row3=mysqli_fetch_array($query3))
			{
				$cat=$row3['cat'];
				
				$query4=mysqli_query($mysqli,"select * from reserve where category='$cat' and pclass='$cls' and pgender='$gender' and session='$session' and seat_cat='$cat_s'")or die(mysqli_error($mysqli));
				$row4=mysqli_fetch_array($query4);
				$lmt=$row4['seats'];
				//alert($cat." ".$gender." ".$session." ".$lmt." ".$cls);
			$p=0;
			$tcnt=0;
			$vs="s".$row2['lsem']."_back";
			$vss="s".$row2['lsem']."_back ASC";
			if($row2['lsem']==1)
			{
				$psems="s1_sgpa";
				$psem="s1_sgpa DESC";
			}
			else
			{
				$psems="s".($row2['lsem']-1)."_sgpa";
				$psem="s".($row2['lsem']-1)."_sgpa DESC";
			}
				if($cat=="Open")
				{
					$query5=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 AND pclass='$cls'  AND pgender='$gender' AND session='$session' AND form_cat='$cat_s' ORDER BY $vss,sgpa DESC,$psem LIMIT $lmt")or die(mysqli_error($mysqli));
				}
				else if($cat=="PH")
				{
					$query5=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 and ph='yes' AND pclass='$cls'  AND pgender='$gender' AND session='$session' AND form_cat='$cat_s' ORDER BY $vss,sgpa DESC,$psem LIMIT $lmt")or die(mysqli_error($mysqli));
				}
				else
				{
					//$query4=mysqli_query("select * from reserve where category='$cat' and pclass='$cls' and pgender='$gender' and session='$session'")or die(mysqli_error());
					//$row2=mysqli_fetch_array($query2);
					//$lmt=$row2['seats'];
					$query5=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 and category='$cat' AND pclass='$cls'  AND pgender='$gender' AND session='$session' AND form_cat='$cat_s' ORDER BY $vss,sgpa DESC,$psem LIMIT $lmt")or die(mysqli_error($mysqli));
				}
				
				
				while($row5=mysqli_fetch_array($query5))
				{	
					$id=$row5['sysid'];
					mysqli_query($mysqli,"UPDATE form_data SET accd=1, stype='$cat', sagn='$cat'where sysid='$id'")or die(mysqli_error($mysqli));
					$i=1;
					//if($category==$row5['category']&&$perc==$row5['sgpa'])
					//	alert($cnt);
					if($row5['ver']==1)
						$vers="Verified";
					else
						$vers="Unverified";
					$cnt=$cnt+1;
					$tcnt++;
					$category=$row5['category'];
					$perc=$row5['sgpa'];
				}
				
				//***************************************Remain*************************************************************
				
				$nrw=mysqli_num_rows($query5);
				
				//alert($cls." ".$cat." ".$nrw." ".$lmt);
				/*while($nrw<$lmt)
				{
					//alert($cls." ".$cat." ".$nrw." ".$lmt);
					$lmt=$lmt-$nrw;
					//alert($cls." ".$cat." ".$nrw." ".$lmt);
					$query33=mysqli_query($mysqli,"select * from category WHERE cat<>'PH' ORDER BY prt ASC")or die(mysqli_error($mysqli));
					while(($row33=mysqli_fetch_array($query33))&&$lmt)
					{
						
						$cat1=$row33['cat'];
						
						$query55=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 and category='$cat1' AND pclass='$cls'  AND pgender='$gender' AND session='$session' ORDER BY $vss,sgpa DESC,$psem LIMIT $lmt")or die(mysqli_error($mysqli));
						while($row55=mysqli_fetch_array($query55))
						{
							//alert($cls." ".$cat." ".$cat1." ".$lmt);
							$id=$row55['sysid'];
							mysqli_query($mysqli,"UPDATE form_data SET accd=1, stype='$cat', sagn='$cat1' where sysid='$id'")or die(mysqli_error($mysqli));
							$i=1;
					
							$cnt=$cnt+1;
							$tcnt++;
							$category=$row55['category'];
							$perc=$row55['sgpa'];
						}
						$lmt=$lmt-mysqli_num_rows($query55);
					}
					
					
				}*/
			}
		}
	}
	
	/***************************Remain New **************************************************/



	$query1=mysqli_query($mysqli,"select * from department where hasres=1")or die(mysqli_error($mysqli));
	while($row1=mysqli_fetch_array($query1))
	{
		$d=$row1['name'];
		$cat_s="Category-1";
		$query2=mysqli_query($mysqli,"select * from cls  WHERE stud_cat='$cat_s' and session='$session'")or die(mysqli_error($mysqli));
		while($row2=mysqli_fetch_array($query2))
		{
			//CLASS
			$myr=$row2['name'];
			$cls=$row2['name']." ".$d;
			
			
			//SET FLAG 0
			//mysqli_query("UPDATE form_data SET stype=''")or die(mysqli_error());
			//mysqli_query($mysqli,"UPDATE form_data SET accd=0")or die(mysqli_error($mysqli));
			$query3=mysqli_query($mysqli,"select * from category WHERE cat<>'PH' AND cat<>'Open' ORDER BY rprt ")or die(mysqli_error($mysqli));
			while($row3=mysqli_fetch_array($query3))
			{
				$cat=$row3['cat'];
				
				$query4=mysqli_query($mysqli,"select * from reserve where category='$cat' and pclass='$cls' and pgender='$gender' and session='$session' and seat_cat='$cat_s'")or die(mysqli_error($mysqli));
				$row4=mysqli_fetch_array($query4);
				$lmt=$row4['seats'];
				$vs="s".$row2['lsem']."_back";
			$vss="s".$row2['lsem']."_back ASC";
			if($row2['lsem']==1)
			{
				$psems="s1_sgpa";
				$psem="s1_sgpa DESC";
			}
			else
			{
				$psems="s".($row2['lsem']-1)."_sgpa";
				$psem="s".($row2['lsem']-1)."_sgpa DESC";
			}
				//alert($cat." ".$gender." ".$session." ".$lmt." ".$cls);
					$query5=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 and sagn='$cat' AND pclass='$cls'  AND pgender='$gender' AND session='$session' AND form_cat='$cat_s' ORDER BY $vss,sgpa DESC,$psem LIMIT $lmt")or die(mysqli_error($mysqli));
				
				
				
				//***************************************Remain*************************************************************
				
				$nrw=mysqli_num_rows($query5);
				
				//alert($cls." ".$cat." A-".$nrw." R-".$lmt);
				while($nrw<$lmt&&($cls!="LY Instrumentation"))
				{
					//alert("1- ".$cls." ".$cat." ".$nrw." ".$lmt);
					$lmt=$lmt-$nrw;
					//alert("2- ".$cls." ".$cat." ".$nrw." ".$lmt);
					$query33=mysqli_query($mysqli,"select * from category WHERE cat<>'PH'  ORDER BY prt ASC")or die(mysqli_error($mysqli));
					$cstc=1;
					$fz=0;
					while(($row33=mysqli_fetch_array($query33))&&$lmt)
					{
						
						$cat1=$row33['cat'];
						
						$query55=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 AND sagn='' and category='$cat1' AND pclass='$cls'  AND pgender='$gender' AND session='$session' AND  form_cat='$cat_s' ORDER BY $vss,sgpa DESC,$psem LIMIT $lmt")or die(mysqli_error($mysqli));
						while($row55=mysqli_fetch_array($query55))
						{
							//alert("3- ".$cls." ".$cat." ".$cat1." ".$lmt);
							$id=$row55['sysid'];
							mysqli_query($mysqli,"UPDATE form_data SET accd=1, stype='$cat', sagn='$cat1' where sysid='$id'")or die(mysqli_error($mysqli));
							$i=1;
					
							
						}
						$cstc++;
						//alert(mysqli_num_rows($query55)." ".$cat1." ".$cstc);
						
						$lmt=$lmt-mysqli_num_rows($query55);
					}
					$lmt=0;
					
					
				}
			}
		}
	}



	
	/***********************************List Generation***********************************/
	mysqli_query($mysqli,"UPDATE form_data SET stype='Waiting' WHERE stype=''")or die(mysqli_error($mysqli));
					
	$query1=mysqli_query($mysqli,"select * from department where hasres=1")or die(mysqli_error($mysqli));
	while($row1=mysqli_fetch_array($query1))
	{
		$d=$row1['name'];
		$query2=mysqli_query($mysqli,"select * from cls WHERE stud_cat='$cat_s' and session='$session' ")or die(mysqli_error($mysqli));
		while($row2=mysqli_fetch_array($query2))
		{
			//CLASS
			$myr=$row2['name'];
			$cls=$row2['name']." ".$d;
			//alert($cls);
			//SET FLAG 0
			$cnt=1;
			mysqli_query($mysqli,"UPDATE form_data SET accd=0")or die(mysqli_error($mysqli));
			$query3=mysqli_query($mysqli,"select * from category")or die(mysqli_error($mysqli));
			while($row3=mysqli_fetch_array($query3))
			{
				$cat=$row3['cat'];
				
				$query4=mysqli_query($mysqli,"select * from reserve where category='$cat' and pclass='$cls' and pgender='$gender' and session='$session'")or die(mysqli_error($mysqli));
				$row4=mysqli_fetch_array($query4);
				$lmt=$row4['seats'];
				//alert($cat." ".$gender." ".$session." ".$lmt." ".$cls);
			$p=0;
			$tcnt=0;
			$vs="s".$row2['lsem']."_back";
			$vss="s".$row2['lsem']."_back ASC";
			if($row2['lsem']==1)
			{
				$psems="s1_sgpa";
				$psem="s1_sgpa DESC";
			}
			else
			{
				$psems="s".($row2['lsem']-1)."_sgpa";
				$psem="s".($row2['lsem']-1)."_sgpa DESC";
			}
				$query5=mysqli_query($mysqli,"SELECT * FROM form_data WHERE ver=1 AND accd<>1 AND pclass='$cls'  AND pgender='$gender' AND session='$session' AND form_cat='$cat_s' ORDER BY $vss,sgpa DESC,$psem")or die(mysqli_error($mysqli));
				while($row5=mysqli_fetch_array($query5))
				{	
					$id=$row5['sysid'];
					mysqli_query($mysqli,"UPDATE form_data SET accd=1 where sysid='$id'")or die(mysqli_error($mysqli));
					$i=1;
					//if($category==$row5['category']&&$perc==$row5['sgpa'])
					//	alert($cnt);
					if($row5['ver']==1)
						$vers="Verified";
					else
						$vers="Unverified";
					$pdf->Cell(9,5,$cnt,1);
					$pdf->Cell(72,5,$row5['pname'],1);
					$pdf->Cell(44,5,$row5['pclass'],1);
					$pdf->Cell(23,5,$row5['category'],1);
					$pdf->Cell(20,5,$row5['sgpa'],1);
					$pdf->Cell(15,5,$row5[$vs],1);
					$pdf->Cell(20,5,$row5[$psems],1);
					$pdf->Cell(12,5,$row5['ph'],1);
					if($row5['sagn'])
						$pdf->Cell(65,5,"Selected Against - ".$row5['stype'],1);
					else
						$pdf->Cell(65,5,"Waiting",1);
					$pdf->Ln();
					$cnt=$cnt+1;
					$tcnt++;
					$category=$row5['category'];
					$perc=$row5['sgpa'];
				}
			}
		}
	}
//}
//$pdf->Output();
	$p_ayear=$_POST['ayear'];
    $p_ses_cat=$_POST['ses_cat'];
    $p_gender=$_POST['gender'];
    $p_report_format=$_POST['report_format'];
	$pdf->Output($p_report_format." - Seat Allotment - ".$p_ayear." - ".$p_ses_cat." - ".$p_gender.".pdf", 'D');
	
	
	?>

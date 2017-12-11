		<div class="content-w3ls">
			<h1 class="agile-head text-center"><b><u><i>CAPS (<?php echo $ayear;?>)</i></u></b></h1>
			<div class="form-w3layouts">					
				<hr>
				<center>
					<font style="color: white; text-shadow: -1px 0 black, 0 5px purple, 5px 0 purple, 0 -1px purple;" size="5">For : <?php echo $classd;?></font>
				</center>
				<hr>
				<br>
				<table>
					<tr>
						<td width="20%"></td>
						<td>
							<font style="color: white;" size="5">Last Date : <u><?php echo date_format(date_create($doe),'j-m-Y');?></u></font><br>
							<font style="color: white;" size="5">Grievance Start : <u><?php echo date_format(date_create($gos),'j-m-Y');?></u></font><br>
							<font style="color: white;" size="5">Grievance Last Date : <u><?php echo date_format(date_create($goe),'j-m-Y');?></u></font><br>
						</td>
					</tr>
				</table>
				<br>
				<?php
					if(date_diff(date_create(date("Y-m-j")),date_create(date_format(date_create($dos),'Y-m-j')))->format("%R%a")<=0&&date_diff(date_create(date("Y-m-j")),date_create(date_format(date_create($doe),'Y-m-j')))->format("%R%a")>=0)
					{
						if($fpublic=="on")
							include("apply.inc.php");
						else 
						{
							$msg="You Cannot Apply Online Contact Hostel Staff to Fill Form";
							include("noform.inc.php");	
						}
					}
					if(date_diff(date_create(date("Y-m-j")),date_create(date_format(date_create($gos),'Y-m-j')))->format("%R%a")<=0&&date_diff(date_create(date("Y-m-j")),date_create(date_format(date_create($goe),'Y-m-j')))->format("%R%a")>=0)
					{
						if($fpublic=="on")
						{
							include("edit.inc.php");
						}
						else 
						{
							$msg="You Cannot Edit Online Contact Hostel Staff to Edit/Update Form";
							include("noform.inc.php");
						}
					}
					include("download.inc.php");
				?>
			</div>
		</div>
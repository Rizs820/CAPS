		<div class="content-w3ls">
			<h1 class="agile-head text-center"><b><u><i>CAPS : Hostel Form</i></u></b></h1>
			<div class="form-w3layouts">
				<form action="" method="post">
					<div class="form-control"> 
						<label class="header">Application ID <span>:</span></label>
						<input type="text" id="prn" name="prn"  required="" value="<?php echo $m_prn;?>" >
						<div class="clear"></div>
					</div>
				
					<div class="form-control">	
						<label class="header">Name <span>:</span></label>
						<input type="text" id="pname" name="pname"  required="" value="<?php echo $m_pname;?>">
						<div class="clear"></div>
					</div>

					<div class="form-control">	
						<label class="header">Email <span>:</span></label>
						<input type="text" id="pemail" name="pemail"  required="" value="<?php echo $m_pemail;?>" <?php echo $m_pemail ? "readonly" : ""; ?> >
						<div class="clear"></div>
					</div>
				
					<div class="form-control">	
						<label class="header">Permanent Address <span>:</span></label>	
						<input type="text" id="padd" name="padd" required="" value="<?php echo $m_padd;?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">	
						<label class="header">Local Address <span>:</span></label>	
						<input type="text" id="ladd" name="ladd" required="" value="<?php echo $m_ladd;?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">	
						<label class="header">Personal Contact Number <span>:</span></label>	
						<input type="text" id="pc_no" name="pc_no" required="" value="<?php echo $m_pc_no;?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">	
						<label class="header">Parents Contact Number <span>:</span></label>	
						<input type="text" id="psc_no" name="psc_no" required="" value="<?php echo $m_psc_no;?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">
							<label class="header">Gender <span>:</span></label>
							<select id="pgender" name="pgender" required>
	                            <option value="">Please Select Gender</option>
	                            <?php
	                                $query=mysqli_query($mysqli,"SELECT name FROM gender") or die(mysqli_query($mysqli));
	                                while($row=mysqli_fetch_array($query))
	                                {
	                                    echo $m_pgender==$row['name'] ? '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>' : '<option value="'.$row['name'].'">'.$row['name'].'</option>';
	                                }
	                            ?>
	                            
	                        </select>
							<div class="clear"></div>
					</div>
					<div class="form-control">
							<label class="header">Category <span>:</span></label>
							<select id="pcategory" name="pcategory" required>
	                            <option value="">Please Select Category</option>
	                            <?php
	                                $query=mysqli_query($mysqli,"SELECT cat FROM category WHERE shw=1") or die(mysqli_query($mysqli));
	                                while($row=mysqli_fetch_array($query))
	                                {
	                                    echo $m_pcategory==$row['cat'] ? '<option value="'.$row['cat'].'" selected>'.$row['cat'].'</option>' : '<option value="'.$row['cat'].'">'.$row['cat'].'</option>';
	                                }
	                            ?>
	                            
	                        </select>
							<div class="clear"></div>
					</div>
					<div class="form-control">
							<label class="header">Physically Hadicapped <span>:</span></label>
							<select id="ph" name="ph" required>
	                            <option value="">Please Select</option>
	                            <?php
	                                echo $m_ph=="No" ? "<option selected='yes'>No</option>" :'<option>No</option>';
	                                echo $m_ph=="Yes" ? "<option selected='yes'>Yes</option>" :'<option>Yes</option>';
	                            ?>
	                        </select>
							<div class="clear"></div>
					</div>
					<div class="form-control">
							<label class="header">Defence <span>:</span></label>
							<select id="defence" name="defence" required>
                                <option value="">Please Select</option>
                                <?php
                                    echo $m_def=="No" ? "<option selected='yes'>No</option>" :'<option>No</option>';
                                    echo $m_def=="Yes" ? "<option selected='yes'>Yes</option>" :'<option>Yes</option>';
                                ?>
                                
                            </select>
							<div class="clear"></div>
					</div>

					<div class="form-control">
							<label class="header">J & K/ North Eastern Candidate <span>:</span></label>
							<select id="jk" name="jk"  required>
                                <option value="">Please Select</option>
                                <?php
                                    echo $m_jk=="No" ? "<option selected='yes'>No</option>" :'<option>No</option>';
                                    echo $m_jk=="Yes" ? "<option selected='yes'>Yes</option>" :'<option>Yes</option>';
                                ?>
                                
                            </select>
							<div class="clear"></div>
					</div>
					<div class="form-control">
							<label class="header">Current Year & Branch <span>:</span></label>
							<select id="pclass" name="pclass" class="form-control show-tick" data-live-search="true" required>
                                <option value="">Please Select Class</option>
                                <?php
                                $query=mysqli_query($mysqli,"select * from department where hasres=1")or die(mysqli_error());
                                    while($row=mysqli_fetch_array($query))
                                    {
                                        $d=$row['name'];
                                        $query1=mysqli_query($mysqli,"select * from cls WHERE stud_cat='$m_form_cat'")or die(mysqli_error());
                                        while($row1=mysqli_fetch_array($query1))
                                        {
                                            $v=$row1['name']." ".$d;
                                            echo $m_pclass==$v ? "<option selected='yes'>".$v."</option>" :'<option>'.$v.'</option>';
                                        }
                                    }
                                ?>
                                
                            </select>
							<div class="clear"></div>
					</div>

					<div class="form-control">	
						<label class="header">MH Merit No. <span>:</span></label>	
						<input type="text" id="sgpa" name="sgpa" required="" value="<?php echo $m_sgpa; ?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">	
						<label class="header">AI Merit No. <span>:</span></label>	
						<input type="text" id="ai_mn" name="ai_mn" required="" value="<?php echo $m_ai_mn; ?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">	
						<label class="header">10th Class Percentage <span>:</span></label>	
						<input type="text" id="sgpa1" name="sgpa1" required="" value="<?php echo $sgpa1; ?>">
						<div class="clear"></div>
					</div>
					<div class="form-control">	
						<label class="header">Diploma Percentage <span>:</span></label>	
						<input type="text" id="sgpa2" name="sgpa2" required="" value="<?php echo $sgpa2; ?>">
						<div class="clear"></div>
					</div>
					<div class="form-control w3ls-end">
						<input type="reset" class="reset" value="Reset">
						<input type="submit" class="register" name="submit_stud_form" value="Submit">
						<div class="clear"></div>
					</div>	
				</form>
			</div>
		</div>

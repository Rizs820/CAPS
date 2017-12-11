				<hr>
				<center>
					<font style="color: white; text-shadow: -1px 0 black, 0 5px purple, 5px 0 purple, 0 -1px purple;" size="5">Edit/Update Form</font><br>
					<font style="color: white; text-shadow: -1px 0 black, 0 3px green, 3px 0 green, 0 -1px green;" size="4">Please enter your Email we will send you link to edit your form</font>
				</center>
				<hr>
				<form action="./?act=user/edit" method="post">
					<div class="form-control">	
						<label class="header">Email Address <span>:</span></label>
						<input type="email" id="email" name="email"  required="">
						<input type="hidden" id="ayear" name="ayear"  value="<?php echo $ayear;?>">
						<input type="hidden" id="ses_cat" name="ses_cat"  value="<?php echo $ses_cat;?>">
						<div class="clear"></div>
					</div>	
					<div class="form-control w3ls-end">
						<input type="reset" class="reset" value="Reset">
						<input type="submit" class="register" name="submit" value="Submit">
						<div class="clear"></div>
					</div>	
				</form>
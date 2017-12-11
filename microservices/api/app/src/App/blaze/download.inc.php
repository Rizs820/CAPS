				<hr>
				<center>
					<font style="color: white; text-shadow: -1px 0 black, 0 5px purple, 5px 0 purple, 0 -1px purple;" size="5">Download Form</font>
				</center>
				<hr>
				<form action="./?act=common/report/generate" target="_blank" method="post">
					<div class="form-control">	
						<label class="header">Email Address <span>:</span></label>
						<input type="email" id="email" name="email"  required="" >
						<input type="hidden" id="ayear" name="ayear"  value="<?php echo $ayear;?>" >
						<input type="hidden" id="ses_cat" name="ses_cat"  value="<?php echo $ses_cat;?>" >
						<div class="clear"></div>
					</div>	
					<div class="form-control w3ls-end">
						<input type="reset" class="reset" value="Reset">
						<input type="submit" class="register" value="Submit">
						<div class="clear"></div>
					</div>	
				</form>
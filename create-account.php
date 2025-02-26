<?php
include('master/header.php');
include('php/pages/create-account.php');
?>
	<h3> Registration</h3>	
<div class="well registration-well">
	<form action="create-account.php" method="POST" class="form-horizontal">
        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
        <input type="hidden" name="event" value="<?php echo $event; ?>" />
		<h4>Your personal information</h4>
		<div class="col-xs-12" style="font-size:16px;font-weight:bold;">
				<?php if(isset($error)){ echo $error; } ?>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputFname1">First name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="firstname" id="inputFname1" placeholder="First Name" class="required" required="required">
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="lastname" class="required" id="inputLnam" placeholder="Last Name" required="required">
			</div>
		 </div>
		 		<div class="control-group">
			<label class="control-label" for="phone">Phone Number <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="phone" id="phone" placeholder="phone" class="required" required="required"/>
			</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="email">Email <sup>*</sup></label>
		<div class="controls">
			<input type="text" name="email" id="email" placeholder="email" class="required" required="required"/>
		</div>
	  </div>	  
	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" name="password" class="required" id="inputPassword1" placeholder="Password" required="required" pattern=".{6,}"  title="6 characters minimum">
		</div>
	  </div>	
				<div class="control-group">
			<label class="control-label" for="company">Company</label>
			<div class="controls">
			  <input type="text" name="company" id="company" placeholder="company"/>
			</div>
		</div>  
	<p><sup>*</sup> Required field	</p>
	
	<div class="control-group">
			<div class="controls">
				<button class="btn btn-large" type="submit">Register</button>
			</div>
		</div>		
	</form>
</div>

<?php include('master/footer.php'); ?>

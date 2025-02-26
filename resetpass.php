<?php include('master/header.php');
include('php/pages/resetpass.php');
?>
<h3> RESET YOUR PASSWORD</h3>   
<hr class="soft"/>
<?php echo $error; ?>
<div class="row">
	<div class="span9" style="min-height:900px">
		<div class="well">
		<h5>Reset your password</h5><br/>
		Please enter the new password for your account:
		<form method="POST" action="resetpass.php">
		  <div class="control-group">
			<label class="control-label" for="pass">Password</label>
			<div class="controls">
			  <input class="span3"  type="password" id="pass" name="pass" placeholder="Password">
			</div>
		  </div>
			<input type="hidden" name="hdnUID" value="<?php echo $UserID; ?>" />
		  <div class="controls">
		  <button type="submit" class="btn block">Submit</button>
		  </div>
		</form>
	</div>
	</div>
</div>  
<?php include('master/footer.php'); ?>

<?php include('master/header.php');
include('php/pages/forgot-password.php');
?>
<h3> FORGET YOUR PASSWORD?</h3>
<hr class="soft"/>
<?php echo $error; ?>
<div class="row">
	<div class="span9" style="min-height:900px">
		<div class="well">
			<h5>Reset your password</h5><br/>
			Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.<br/><br/><br/>
			<form method="POST" action="forgot-password.php">
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="text" id="inputEmail1" name="Email" placeholder="Email">
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Submit</button>
			  </div>
			</form>
		</div>
	</div>
</div>  
<?php include('master/footer.php'); ?>

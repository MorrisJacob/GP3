<?php
include('master/header.php');
include('php/pages/my-account.php');
?>
<form action="my-account.php" method="POST" class="form-horizontal">
	<div class="container" style="border:1px solid gray;padding:25px;">
	    <div class="row row-marg">
		<div class="span12" style="text-align:center;">
		    <h2>My Account</h2>
		</div>
	    </div>
	    <div class="span5">
	    </div>
	    <div class="span6 col-xs-12 col-sm-6">
		<div class="row row-marg">
			<div class="span12">
			    <h3>Personal Info</h3>
			</div>
		        <div class="row row-marg">
				<div class="span12">
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="FirstName" value="<?php echo $firstName; ?>" />
				</div>
		        </div>
		        <div class="row row-marg">
				<div class="span12">
				    Last Name:
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="LastName" value="<?php echo $lastName; ?>" />
				</div>
		        </div>
		        <div class="row row-marg">
				<div class="span12">
				    Company:
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="Company" value="<?php echo $company; ?>" />
				</div>
		        </div>
			<div class="row row-marg">
				<div class="span12">
				    Phone Number:
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="PhoneNumber" value="<?php echo $phone; ?>" />
				</div>
		        </div>
			<div class="row row-marg">
				<div class="span12">
				    <input type="submit" class="btn btn-success" />
				</div>
		        </div>
		</div>
	    </div>
	</div>
</form>
<style>
.row-marg{
    margin-bottom:10px;
}
</style>
<?php include('master/footer.php'); ?>

<?php
include('master/header.php');
include('php/pages/contact.php');
?>
	<div class="row">
		<div class="span5">

			<div class="fh5co-contact-info">
				<h3>Contact Information</h3>
				<ul>
					<li class="address">Indiana</li>
					<li class="phone"><a href="tel://1111111111">(111) 111-1111</a></li>
					<li class="email"><a href="mailto:grandpark2025@gmail.com">grandpark2025@gmail.com</a></li>
				</ul>
			</div>

		</div>
		<div class="span6">
			<h3>Get In Touch</h3>
			<form id="frmContact" action="contact.php" method="POST">
				<div class="row form-group">
					<div class="col-md-6">
						<label for="fname">First Name</label>
						<input type="text" id="fname" name="fname" class="form-control" placeholder="Your firstname">
					</div>
					<div class="col-md-6">
						<label for="lname">Last Name</label>
						<input type="text" id="lname" name="lname" class="form-control" placeholder="Your lastname">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<label for="email">Email *</label>
						<input type="text" id="email" name="email" class="form-control required" placeholder="Your email address">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<label for="subject">Subject *</label>
						<input type="text" id="subject" name="subject" class="form-control required" placeholder="Your subject of this message">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<label for="message">Message</label>
						<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Send Message" class="btn btn-primary">
				</div>

			</form>         
		</div>
	</div>
<?php include('master/footer.php'); ?>

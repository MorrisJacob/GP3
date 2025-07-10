<footer>
  <div class="container">
             <div class="row" style="text-align:center;">
            <article class="span6 fright">
             <ul class="menu-footer">
               <li><a href="index.php">Home</a></li>
               <li><a href="cart.php">My Carts</a></li>
               <li><a href="city-info.php">City Info</a></li>
               <li><a href="my-account.php">My Account</a></li>
               <li><a href="contact.php">Contact Us</a></li>
             </ul>
           </article>
                 <article class="span6 fleft">
                 <span>Site Built By MorrisProgramming, LLC.
           </article>
           
       </div>
  </div>
</footer>
</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type='text/javascript' src='js/site.js'></script>
<!--Login Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<form action="login.php" method="POST">
	Please Login:
	<br/>
	Email:<br/>
	<input type="text" class="form-control" name="email" /><br/>
	Password:<br/>
	<input type="password" class="form-control" name="password" /><br/><br/>
	<a href="forgot-password.php">Forgot password?</a>
	<br/>
	Don't have a login? <a href="create-account.php">Create an account.</a>
	<br/>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
	</form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

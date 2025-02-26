<?php include('master/header.php');
include('php/pages/login.php'); ?>
<h3> Login</h3>
        <hr class="soft"/>
        <div class="row">
                <div class="span12" style="color:red;font-size:15px;font-weight:bold;">
                  <?php echo $error; ?>
                </div>
        </div>
        <div class="row">
                <div class="span4">
                        <div class="well">
                        <h5>CREATE YOUR ACCOUNT</h5><br/>
                        Click here to create an account.<br/><br/><br/>
                        <a href="create-account.php" class="btn btn-default">Create an Account</a>
                </div>
                </div>
                <div class="span1"> &nbsp;</div>
                <div class="span4">
                        <div class="well">
                        <h5>ALREADY REGISTERED?</h5>
                        <form method="POST" action="login.php">
                          <div class="control-group">
                                <label class="control-label" for="inputEmail1">Email</label>
                                <div class="controls">
                                  <input class="span3"  type="text" id="inputEmail1" name="email" placeholder="Email">
                                </div>
                          </div>
                          <div class="control-group">
                                <label class="control-label" for="inputPassword1">Password</label>
                                <div class="controls">
                                  <input type="password" class="span3"  id="inputPassword1" name="password" placeholder="Password">
                                </div>
                          </div>
                          <div class="control-group">
                                <div class="controls">
                                  <button type="submit" class="btn">Sign in</button> <a href="forgot-password.php">Forget password?</a>
                                </div>
                          </div>
                        </form>
                </div>
                </div>
        </div>

<?php include('master/footer.php'); ?>

<?php
session_start();
include('php/plumbing/sqlconn.php');
include('php/plumbing/generalfunctions.php');
include ('php/master/header.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen">
                <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/jquery.mobilemenu.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.equalheights.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
     prevText: '',
           nextText: ''
      });
        jQuery(".maxheight").equalHeights();

	$('#icnLogin').on('click', function(e){
		//If the user clicks login, but is already logged in, take to my account screen
		if(<?php echo $userid; ?> != 0){
			e.preventDefault();
			window.location.href = "my-account.php";
		}
	});
    });
    </script>



        <!--[if lt IE 8]>
                <div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/img/upgrade.jpg"border="0"alt=""/></a></div>
        <![endif]-->
    <!--[if lt IE 9]>
      <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<div class="container">
<!--==============================header=================================-->
<!---Navbar start -->
  <nav class="navbar navbar-dark fixed-top">
        <div class="container container-fluid">
	<div class="row">
    <?php if($admin == 1){ ?>
    <div class="span2" style="margin-top:20px;">
        <a href="short-term-rentals.php"><input id="manageRentals" type='button' class="btn btn-info" value='Manage Short-Term Rentals' /></a>
    </div>
    <?php } ?>
	<div class="span2">
	    <span id="helloText"><?php if($userid != 0) { echo "Hello, " . $_SESSION['email']; } ?></span>
	    <img src='img/user-icon.png' class="user-img" data-toggle="modal" id="icnLogin" data-target="#loginModal" />
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
 
            <div class="collapse navbar-collapse" id="navbarNav">
		<div class="navbar-item">
                        <a class="nav-link scroll-link" href="index.php">Home</a>
		</div>
		<div class="navbar-item">
                        <a class="nav-link scroll-link" href="cart.php">My Carts</a>
		</div>
		<div class="navbar-item">
                        <a class="nav-link scroll-link" href="cart-history.php">Cart History</a>
		</div>
		<div class="navbar-item">
                        <a class="nav-link scroll-link" href="city-info.php">City Info</a>
		</div>
		<div class="navbar-item">
                        <a class="nav-link scroll-link" href="my-account.php">My Account</a>
		</div>
		<div class="navbar-item">
                        <a class="nav-link scroll-link" href="contact.php">Contact Us</a>
		</div>
            </div>
	</div>
	</div>
        </div>
    </nav>
 
    <!-- continues the page content ... -->
<!- navbar end -->
<header>
    <div class="container">
         <div class="navbar navbar_ clearfix">
            <div class="navbar-inner">
                  <div class="clearfix" style="display:flex;">
                        <h1 class="brand"><a href="index.php"><img src="img/logo.png" alt=""></a><span>Grand Park Rentals</span></h1>
			<br/>
                  </div>
             </div>
         </div>
    </div>
</header>

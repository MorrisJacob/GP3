<?php include('master/header.php'); ?>
<div class="row text-center">
<h2 style="margin:0;">City Information</h2>
</div>
<br/>
<div class="row">
    <div class="span4">
	<h3>Select A City</h3>
	<br/>
	<div class="city-select city-westfield city-selected">Westfield</div>
	<div class="city-select city-carmel ">Carmel</div>
	<div class="city-select city-noblesville">Noblesville</div>
	<div class="city-select city-fishers">Fishers</div>
	<div class="city-select city-sheridan">Sheridan</div>
    </div>
    <div class="span4">
	<h3>City Distances</h3>
	<br/>
	<div class="row city-distance westfield">
	    <div class="span2">
		<h4 class="column-header">To</h4>
		<br/>
		<div>Carmel</div>
		<div>Noblesville</div>
		<div>Fishers</div>
		<div>Sheridan</div>
	    </div>
	    <div class="span2">
		<h4 class="column-header">Miles Away</h4>
		<br/>
		<div>4.59</div>
		<div>5.56</div>
		<div>8.75</div>
		<div>7.91</div>
	    </div>
	</div>
	<div class="row city-distance carmel">
	    <div class="span2">
		<h4 class="column-header">To</h4>
		<br/>
		<div>Westfield</div>
		<div>Noblesville</div>
		<div>Fishers</div>
		<div>Sheridan</div>
	    </div>
	    <div class="span2">
		<h4 class="column-header">Miles Away</h4>
		<br/>
		<div>4.59</div>
		<div>7.58</div>
		<div>5.24</div>
		<div>12.21</div>
	    </div>
	</div>
    </div>
    <div class="span4">
	<h3>Fun Facts</h3>
	<br/>
	<ul class="city-facts westfield">
	    <li>Home to annual Indianapolis Colts Training Camp</li>
	    <li>Grand Park opened in 2014</li>
	    <li>Fastest growing city in Hamilton County</li>
	    <li>One of the fastest growing cities in the country</li>
	    <li>One of the best July 4th Fireworks and Laser Show</li>
	</ul>
	<ul class="city-facts carmel">
	    <li>More roundabouts than any other city in USA</li>
	    <li>One of USA's 1st traffic signals installed in 1924</li>
	    <li>The Center for the Performing Arts opened in 2011</li>
	    <li>Has an Arts & Design District</li>
	</ul>
    </div>
</div>
<script src="js/city-info.js"></script>
<?php include('master/footer.php'); ?>

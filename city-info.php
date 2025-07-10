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
            <div class="city-carmel">Carmel</div>
            <div class="city-noblesville">Noblesville</div>
            <div class="city-fishers">Fishers</div>
            <div class="city-sheridan">Sheridan</div>
	    </div>
	    <div class="span2">
            <h4 class="column-header">Miles Away</h4>
            <br/>
            <div class="city-carmel">4.59</div>
            <div class="city-noblesville">5.56</div>
            <div class="city-fishers">8.75</div>
            <div class="city-sheridan">7.91</div>
	    </div>
	</div>
	<div class="row city-distance carmel">
	    <div class="span2">
            <h4 class="column-header">To</h4>
            <br/>
            <div class="city-westfield">Westfield</div>
            <div class="city-noblesville">Noblesville</div>
            <div class="city-fishers">Fishers</div>
            <div class="city-sheridan">Sheridan</div>
	    </div>
	    <div class="span2">
            <h4 class="column-header">Miles Away</h4>
            <br/>
            <div class="city-westfield">4.59</div>
            <div class="city-noblesville">7.58</div>
            <div class="city-fishers">5.24</div>
            <div class="city-sheridan">12.21</div>
	    </div>
	</div>
	<div class="row city-distance noblesville">
	    <div class="span2">
            <h4 class="column-header">To</h4>
            <br/>
            <div class="city-westfield">Westfield</div>
            <div class="city-carmel">Carmel</div>
            <div class="city-fishers">Fishers</div>
            <div class="city-sheridan">Sheridan</div>
	    </div>
	    <div class="span2">
            <h4 class="column-header">Miles Away</h4>
            <br/>
            <div class="city-westfield">6.4</div>
            <div class="city-carmel">9.8</div>
            <div class="city-fishers">7.4</div>
            <div class="city-sheridan">13.1</div>
	    </div>
	</div>
	<div class="row city-distance fishers">
	    <div class="span2">
            <h4 class="column-header">To</h4>
            <br/>
            <div class="city-westfield">Westfield</div>
            <div class="city-carmel">Carmel</div>
            <div class="city-noblesville">Noblesville</div>
            <div class="city-sheridan">Sheridan</div>
	    </div>
	    <div class="span2">
            <h4 class="column-header">Miles Away</h4>
            <br/>
            <div class="city-westfield">11.7</div>
            <div class="city-carmel">7.1</div>
            <div class="city-noblesville">7.9</div>
            <div class="city-sheridan">20.6</div>
	    </div>
	</div>
	<div class="row city-distance sheridan">
	    <div class="span2">
            <h4 class="column-header">To</h4>
            <br/>
            <div class="city-westfield">Westfield</div>
            <div class="city-carmel">Carmel</div>
            <div class="city-noblesville">Noblesville</div>
            <div class="city-fishers">Fishers</div>
	    </div>
	    <div class="span2">
            <h4 class="column-header">Miles Away</h4>
            <br/>
            <div class="city-westfield">9.9</div>
            <div class="city-carmel">14.6</div>
            <div class="city-noblesville">13.1</div>
            <div class="city-fishers">20.9</div>
	    </div>
	</div>
    </div>
    <div class="span4">
        <h3>Fun Facts</h3>
        <br/>
        <ul class="city-facts westfield city-westfield">
            <li>Home to annual Indianapolis Colts Training Camp</li>
            <li>Grand Park opened in 2014</li>
            <li>Fastest growing city in Hamilton County</li>
            <li>One of the fastest growing cities in the country</li>
            <li>One of the best July 4th Fireworks and Laser Show</li>
        </ul>
        <ul class="city-facts carmel city-carmel">
            <li>More roundabouts than any other city in USA</li>
            <li>One of USA's 1st traffic signals installed in 1924</li>
            <li>The Center for the Performing Arts opened in 2011</li>
            <li>Has an Arts & Design District</li>
        </ul>
        <ul class="city-facts noblesville city-noblesville">
            <li>1st City platted in Hamilton County in 1823</li>
            <li>Ruoff Music Center is the largest outdoor music venue in Indiana</li>
            <li>Features Forest Park, known for its biking trails</li>
            <li>Known for its proximity to water, including Morse Park and Beach</li>
        </ul>
        <ul class="city-facts fishers city-fishers">
            <li>Best place to live in the US in 2017</li>
            <li>Has 24 parks and 104 miles of trails</li>
            <li>In 1963, Fishers had 350 people in the community</li>
            <li>Home to Conner Prairie, well known for interactive living history museums in US</li>
        </ul>
        <ul class="city-facts sheridan city-sheridan">
            <li>Believed to be 1st City to have held a High School Football Homecoming in Indiana</li>
            <li>Larry "Bud" Wright is an Indiana Hall of Fame Football Coach</li>
            <li>Monon Railroad in 1882 is now the Monon Trail</li>
            <li>Was once the 2nd largest town in Hamilton County</li>
        </ul>
    </div>
</div>
<script src="js/city-info.js"></script>
<?php include('master/footer.php'); ?>

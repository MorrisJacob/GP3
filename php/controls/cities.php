<header style='padding-top:0;'>
    <div class="container">
         <div class="navbar navbar_ clearfix">
            <div class="navbar-inner">
                  <div class="clearfix">
			<?php if(!isset($_GET['city'])) { ?>
                            <h2 class="text-center hidden-phone" style="margin:0;">Pick a City To Get Started!</h2>
			<?php } ?>
                        <div class="nav-collapse nav-collapse_ collapse">
                            <ul class="nav sf-menu clearfix city-menu">
                              <li class="city-westfield"><a href="city.php?city=westfield">WestField <span>Grand Park Sport Complex</span></a></li>
                              <li class="city-carmel"><a href="city.php?city=carmel">Carmel <span>The Center for the Performing Arts</span></a></li>
                              <li class="city-noblesville"><a href="city.php?city=noblesville">Noblesville <span>Mojo Up Sports Complex</span></a></li>
                              <li class="city-fishers"><a href="city.php?city=fishers">Fishers <span>Pro Net Sports</span></a></li>
                              <li class="city-sheridan"><a href="city.php?city=sheridan">Sheridan <span>Biddle Memorial Park</span></a></li>
                            </ul>
                        </div>
                  </div>
             </div>
         </div>
    </div>
</header>

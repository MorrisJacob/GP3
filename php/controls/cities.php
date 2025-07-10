<header style='padding-top:0;'>
    <div class="container">
         <div class="navbar navbar_ clearfix">
            <div class="navbar-inner">
                  <div class="clearfix">
			<?php if(!isset($_GET['city'])) { ?>
                            <h2 class="text-center hidden-phone fade-it" style="margin:0 20%; color:black; border: 3px solid white;">Pick an Event To Get Started!</h2>
			<?php } ?>
                        <div class="nav-collapse nav-collapse_ collapse">
                            <ul class="nav sf-menu clearfix city-menu">
                            <li class="header-name city-westfield"><a href="city.php?event=1&day=<?php echo $_GET['day']; ?>">WestField <span>Grand Park Sport Complex</span></a></li>
                              <li class="header-name city-carmel"><a href="city.php?event=2&day=<?php echo $_GET['day']; ?>">Carmel <span>The Center for the Performing Arts</span></a></li>
                              <li class="header-name city-noblesville"><a href="city.php?event=4&day=<?php echo $_GET['day']; ?>">Noblesville <span>Ruoff Music Center</span></a></li>
                              <li class="header-name city-sheridan"><a href="city.php?event=7&day=<?php echo $_GET['day']; ?>">Sheridan <span>Biddle Memorial Park</span></a></li>
                              <li class="header-name city-fishers"><a href="city.php?event=5&day=<?php echo $_GET['day']; ?>">Fishers <span>Pro Net Sports</span></a></li>
                              <li class="header-name city-westfield"><a href="city.php?event=3&day=<?php echo $_GET['day']; ?>">WestField <span>Pacers Athletic Center</span></a></li>
                              <li class="header-name city-indianapolis" style="width:60%;text-align:center;"><a href="city.php?event=8&day=<?php echo $_GET['day']; ?>" style="font-size:40pt;">Downtown Indy</a></li>
                              <li class="header-name city-fishers"><a href="city.php?event=6&day=<?php echo $_GET['day']; ?>">Fishers <span>Fishers Event Center</span></a></li>
                            </ul>
                        </div>
                  </div>
             </div>
         </div>
    </div>
</header>

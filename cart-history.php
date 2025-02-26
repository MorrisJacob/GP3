<?php include('master/header.php'); ?>
<?php include('php/controls/cities.php'); ?>
<?php include('php/pages/cart-history.php'); ?>

<?php if($event != "" && $trip != "") { ?>
    <div class="row text-center">
        <div class="span12">
        <h2>Trip Itinerary</h2>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="span12 text-center">
            <h3>Main Event</h3>
        </div>
    </div>
    <br/>
    <div class="row text-center" style="font-weight: bold;font-size:14pt;"> 
         <div class="span4">
            Date/Time
         </div>
         <div class="span4">
            Gate
         </div>
         <div class="span4">
            Field
         </div>
    </div>
    <?php echo $gametime_rows; ?>
    <br/>
    <div class="row">
        <div class="span12 text-center">
            <h3>Trip Activities/Lodging</h3>
        </div>
    </div>
    <br/>
    <div class="row text-center" style="font-weight: bold;font-size:14pt;"> 
         <div class="span4">
            Date/Time
         </div>
         <div class="span4">
            Title
         </div>
         <div class="span4">
            Address
         </div>
    </div>
    <?php echo $itinerary_rows; ?>
    <br/>
    <div class="row text-center">
        <div class="span5">
        </div>
        <div class="span3">
            <a href="cart-history.php?city=<?php echo $event; ?>"><input type="button" value="<< View Other Past Carts" class="btn" /></a>
        </div>
    </div>

<?php } elseif ($event != "") { ?>
    <div class="row text-center">
        <div class="span12">
            <h2>Select a Past Trip</h2>
        </div>
    </div>
    <br/>
    <?php echo $trip_rows; ?>
    <br/>
<?php } else { ?>
    <div class="row">
        <div class="span12 text-center">
            Pick a City
        </div>
    </div>
    <br/>
    <div class="row" style="font-size:16pt;">
        <div class="span1">
        </div>
        <div class="span2 text-center">
            <a href="cart-history.php?city=westfield">Westfield</a>
        </div>
        <div class="span2 text-center">
            <a href="cart-history.php?city=carmel">Carmel</a>
        </div>
        <div class="span2 text-center">
            <a href="cart-history.php?city=noblesville">Noblesville</a>
        </div>
        <div class="span2 text-center">
            <a href="cart-history.php?city=fishers">Fishers</a>
        </div>
        <div class="span2 text-center">
            <a href="cart-history.php?city=sheridan">Sheridan</a>
        </div>
    </div>
<?php } ?>
<?php include('master/footer.php'); ?>


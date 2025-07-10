<?php include('master/header.php'); ?>
<?php include('php/pages/cart-history.php'); ?>

<div class="city-<?php echo $event; ?>">
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
         <div class="span3">
            Day
         </div>
         <div class="span3">
            Be There
         </div>
         <?php if($showGate) { ?>
         <div class="span3">
            Gate
         </div>
         <?php } ?>
         <?php if($showField) { ?>
         <div class="span3">
            <?php echo $fieldTitle; ?>
         </div>
         <?php } ?>
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
         <div class="span3">
            Day
         </div>
         <div class="span3">
            Be There
         </div>
         <div class="span3">
            Title
         </div>
         <div class="span3">
            Address
         </div>
    </div>
    <?php echo $itinerary_rows; ?>

<?php } ?>

</div>
<?php include('master/footer.php'); ?>


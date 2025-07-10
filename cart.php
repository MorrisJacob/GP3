<?php include('master/header.php'); ?>
<?php include('php/pages/cart.php'); ?>

<br/><br/><br/>
<div class="row">
    <div class="span12">
      <div class="step-wizard">
        <div class="step completed">
          <div class="pill select-event">Select Your Event</div>
        </div>
        <div class="step completed">
          <div class="pill select-lodging">Overnight Stay</div>
        </div>
        <div class="step completed">
          <div class="pill select-itinerary">Build Your Itinerary</div>
        </div>
        <div class="step active">
          <div class="pill">Review Cart & Publish</div>
        </div>
      </div>
    </div>
</div>
<br/><br/>
<?php if($event != "") { ?>
<form action="cart.php?event=<?php echo $event ; ?>" method="POST" id="emailForm">
    <input type="hidden" name="event" value="<?php echo $event; ?>" />
    <div class="row cart-title">
        <div class="span2">
        </div>
        <div class="span1 day day-selected all-days">All</div>
        <div class="span1 day">Monday</div>
        <div class="span1 day">Tuesday</div>
        <div class="span1 day">Wednesday</div>
        <div class="span1 day">Thursday</div>
        <div class="span1 day">Friday</div>
        <div class="span1 day">Saturday</div>
        <div class="span1 day">Sunday</div>
    </div>
    <div class="row text-center">
        <div class="span12">
        <h2 class="cart-title">Trip Itinerary</h2>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="span12 text-center">
            <h3><span class="cart-title">Event - </span><span class=" city-<?php echo $city; ?>"><?php echo $eventName; ?></span></h3>
        </div>
    </div>
    <br/>
    <div class="row text-center cart-title hidden-xs" style="font-weight: bold;font-size:14pt;"> 
         <div class="span3">
            Day
         </div>
         <div class="span2">
            Be There
         </div>
         <?php if($showGate) { ?>
         <div class="span2">
            Gate
         </div>
         <?php } ?>
         <?php if($showField) { ?>
         <div class="span2">
            <?php echo $fieldTitle; ?>
         </div>
         <?php } ?>
         <div class="span2">
         </div>
    </div>
    <div id="gametimes" class="city-<?php echo $city; ?>" style="font-weight: bold;font-size:14pt;">
        <?php echo $gametime_rows; ?>
    </div>
    <br/>
    <div class="row">
        <div class="span4">
        </div>
        <div class="span3" style="text-align:center;">
            <input type="button" value="+ Add To Event" class="btn btn-danger add-row" />
        </div>
    </div>
    <br/><br/><br/>
    <div class="row">
        <div class="span12 text-center">
            <h3 class="cart-title">OVERNIGHT STAY / ACTIVITIES</h3>
        </div>
    </div>
    <br/>
    <div class="row text-center cart-title hidden-xs" style="font-weight: bold;font-size:14pt;"> 
         <div class="span3">
            Day
         </div>
         <div class="span2">
            Be There
         </div>
         <div class="span3">
            Title
         </div>
         <div class="span2">
            To Lodge
         </div>
         <div class="span2">
            To Event
         </div>
    </div>
    <?php echo $itinerary_rows; ?>
    <br/>
    <div class="row text-center">
        <div class="span4">
            <a href="activities.php?event=<?php echo $event; ?>"><input type="button" value="<< Adjust Activities" class="btn" /></a>
        </div>
        <div class="span4">
            <input type="submit" value="Save & Go To Next Day" class="btn btn-success" id="savenextday"/>
        </div>
        <div class="span4">
            <input id="savesend" type="button" value="Save & Send All" class="btn btn-success"/>
        </div>
    </div>


<div class="modal fade" id="PublishModal" tabindex="-1" role="dialog" aria-labelledby="PublishTripTitle" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PublishTripTitle">Share Your Trip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Share your trip! Please enter the email addresses for this trip:
        <div>
          <input
            type="text"
            id="emailInput"
            class="form-control"
            placeholder="Enter email and press Enter"
          />
        </div>
          <div class="pill-container" id="pillContainer"></div>
        <div>
            Notes:
            <textarea class="form-control" name="notes" rows="3"></textarea>
        </div>
        <div>
            <input type="checkbox" id="chkText" name="chkText" value="Yes">
            <label for="chkText"> I consent to send and receiving texts. I understand that using this platform to send texts outside of it's intended use may result in legal action taken against me.</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" id="btnPublish">Share This Trip</button>
      </div>
    </div>
  </div>
</div>

<script>
    var showGate = <?php echo $showGate ? 'true' : 'false'; ?>;
    var showField = <?php echo $showField ? 'true' : 'false'; ?>;
</script>
<script src="js/cart.js"></script>
</form>

<?php } ?>
<?php include('master/footer.php'); ?>


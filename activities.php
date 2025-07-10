<?php include('master/header.php'); ?>
<?php include('php/pages/activities.php'); ?>
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
        <div class="step active">
          <div class="pill">Build Your Itinerary</div>
        </div>
        <div class="step future">
          <div class="pill">Review Cart & Publish</div>
        </div>
      </div>
    </div>
</div>
<br/><br/>
<div class="row text-center">
    <div class="span3 text-center">
        <div style="text-align:left;margin-left:30%;">
            <h3>Plan Each Day</h3>
            <input type="radio" name="days" value="monday" id="monday" <?php echo $dayDisabled; ?>/><label for="monday" class="inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Monday</label><br/>
            <input type="radio" name="days" value="tuesday" id="tuesday" <?php echo $dayDisabled; ?>/><label for="tuesday" class=" inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Tuesday</label><br/> 
            <input type="radio" name="days" value="wednesday" id="wednesday" <?php echo $dayDisabled; ?>/><label for="wednesday" class=" inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Wednesday</label><br/>
            <input type="radio" name="days" value="thursday" id="thursday" <?php echo $dayDisabled; ?>/><label for="thursday" class=" inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Thursday</label><br/>
            <input type="radio" name="days" value="friday" id="friday" <?php echo $dayDisabled; ?>/><label for="friday" class=" inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Friday</label><br/>
            <input type="radio" name="days" value="saturday" id="saturday" <?php echo $dayDisabled; ?>/><label for="saturday" class=" inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Saturday</label><br/>
            <input type="radio" name="days" value="sunday" id="sunday" <?php echo $dayDisabled; ?>/><label for="sunday" class=" inline-label <?php echo $dayDisabled; echo $itineraryActive; ?>">Sunday</label><br/>
        </div>
        <br/><br/>
        <!--<div class="trip-item <?php echo $eventActive; ?>">Events</div>-->
        <div class="trip-item <?php echo $itineraryActive; ?>" data-types='restaurant,fast_food'>Fast Food</div>
        <div class="trip-item <?php echo $itineraryActive; ?>" data-types='restaurant'>Restaurants</div>
        <div class="trip-item <?php echo $itineraryActive; ?>" data-types='restaurant,team'>Team Restaurants</div>
        <div class="trip-item <?php echo $itineraryActive; ?>" data-types='restaurant,pizza'>Pizza</div>
        <div class="trip-item <?php echo $itineraryActive; ?>" data-types='bar,bowling_alley,library,movie_theater,museum,park,shopping_mall,tourist_attraction'>Entertainment</div>
        <div class="trip-item <?php echo $itineraryActive; ?>" data-types='park'>Parks</div>
        <div class="trip-item <?php echo $itineraryActive; ?>">Golf Courses</div>
    </div>
	<div class="span8">
		<img src="img/city-map.png" class="img img-responsive" />
	</div>
</div>
<div class="row text-center">
    <div class="span4">
    </div>
    <div class="span3">
        <div class="trip-item much-button <?php echo $activeButton; ?> <?php echo $itineraryActive; ?>" data-types='bank,book_store,car_repair,car_wash,church,convenience_store,electronics_store,gym,hospital,lawyer,library,liquor_store,pet_store,pharmacy,post_office,shopping_mall,spa,supermarket'>Much More!</div>
        <h3 class="city-<?php echo $city; ?>">Everything You Need or Want To Know!</h3>
    </div>
</div>
<br/>
<div class="row text-center">
    <div class="span4 mobile-margin">
        <a onclick="history.go(-1)" class="btn">Back</a>
    </div>
    <div class="span4 mobile-margin">
        <input id="btnTripCancel" type="button" class="btn btn-danger" value="Clear Your Trip" <?php echo $finDisabled; ?> data-toggle="modal" data-target="#ClearConfirmationModal" />
    </div>
    <div class="span4 mobile-margin">
        <input id="btnDayFinalize" type="button" class="btn btn-success" value="Finalize Your Day" <?php echo $finDisabled; ?> />
    </div>
</div>

<div class="modal fade" id="ClearConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="ClearTripTitle" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ClearTripTitle">Clear Trip?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to clear all events and activities for this city? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="btnClearCity">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src="js/city.js"></script>
<?php include('master/footer.php'); ?>


<?php include('master/header.php'); ?>
<?php include('php/controls/cities.php'); ?>
<?php include('php/pages/city.php'); ?>
<div class="row text-center">
	<div class="span3">
	</div>
	<div class="span6">
		<img src="img/city-map.png" class="img img-responsive" />
	</div>
</div>
<br/><br/>
<div class="row text-center city-<?php echo $event; ?>">
    <div class="span12">
    <h3>Build, Save, and Share Your Trip!</h3>
    </div>
</div>
<div class="row">
    <div class="span6 text-center">
    <div class="trip-item <?php echo $eventActive; ?>">Events</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='lodging'>Hotels</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='str'>Short-Term Rentals</div>
    <div class="trip-item <?php echo $itineraryActive; ?>">Home Rentals</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='campground'>Campgrounds</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='convenience_store'>Grocery Stores</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='restaurant'>Team Restaurants</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='restaurant'>Pizza</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='meal_takeaway'>Fast Food</div>
    </div>
    <div class="span6 text-center">
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='pet_store,veterinary_care'>Pet Care</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='bar,bowling_alley,library,movie_theater,museum,park,shopping_mall,tourist_attraction'>Entertainment</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='park'>Parks</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='car_repair,car_wash'>Car Care</div>
    <div class="trip-item <?php echo $itineraryActive; ?>">Golf Courses</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='bar,liquor_store'>Wineries</div>
    <div class="trip-item <?php echo $itineraryActive; ?>">Farm Markets</div>
    <div class="trip-item <?php echo $itineraryActive; ?>" data-types='convenience_store'>Convenient Stores</div>
    </div>
</div>
<div class="row text-center city-<?php echo $event; ?>">
    <div class="span12">
    <h3>Everything You Need or Want To Know!</h3>
    </div>
</div>
<br/>
<div class="row text-center">
    <div class="span3">
    </div>
    <div class="span3">
        <input id="btnTripCancel" type="button" class="btn btn-danger" value="Clear Your Trip" <?php echo $finDisabled; ?> data-toggle="modal" data-target="#ClearConfirmationModal" />
    </div>
    <div class="span3">
        <input id="btnTripFinalize" type="button" class="btn btn-success" value="Finalize Your Trip >>" <?php echo $finDisabled; ?> />
    </div>
</div>

<div class="modal fade" id="ClearConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="ClearTripTitle" aria-hidden="true">
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

<script>
$(function(){
	$('.trip-item.active').on('click', function(){
		if($(this).text() == "Events"){
			window.location.href = 'trip.php?city=<?php echo $event; ?>';
		}else {
			window.location.href = 'itinerary.php?city=<?php echo $event; ?>&types=' + this.dataset.types;
		}
	});
	$('#btnTripFinalize').on('click', function(){
			window.location.href = 'cart.php?city=<?php echo $event; ?>';
	});
	$('#btnClearCity').on('click', function(){
			window.location.href = 'php/actions/clearcity.php?city=<?php echo $event; ?>';
	});
});
</script>
<?php include('master/footer.php'); ?>


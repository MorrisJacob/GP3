<?php include('master/header.php'); ?>
<?php include('php/pages/lodging.php'); ?>
<br/><br/><br/>
<div class="row">
    <div class="span12">
      <div class="step-wizard">
        <div class="step completed">
          <div class="pill select-event">Select Your Event</div>
        </div>
        <div class="step active">
          <div class="pill">Overnight Stay</div>
        </div>
        <div class="step future">
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
    <div class="span3">
        <h3>Overnight Stay</h3>
        <div class="trip-item <?php echo $eventActive; ?>" data-types='lodging'>Hotels</div>
        <div class="trip-item <?php echo $eventActive; ?>" data-types='str'>Home Rentals</div>
        <div class="trip-item <?php echo $eventActive; ?>" data-types='campground'>Campgrounds</div>
        <br/>
        <br/>
	</div>
	<div class="span8">
		<img src="img/city-map.png" class="img img-responsive" />
	</div>
</div>
<br/><br/>
<div class="row text-center">
    <div class="span4 mobile-margin">
        <a onclick="history.go(-1)" class="btn">Back</a>
    </div>
    <div class="span4 mobile-margin">
        <input id="btnTripCancel" type="button" class="btn btn-danger" value="Clear Your Trip" <?php echo $finDisabled; ?> data-toggle="modal" data-target="#ClearConfirmationModal" />
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


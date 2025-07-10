<?php include('master/header.php'); ?>
<?php include('php/pages/city.php'); ?>
<br/><br/><br/>
<form action="city.php" method="POST" id="cityForm">
    <div class="row">
        <div class="span12">
            <div class="step-wizard">
                <div class="step active">
                  <div class="pill">Select Your Event</div>
                </div>
                <div class="step future">
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
            <h3>Events</h3>
            <div style="text-align:left;">
                <?php echo $event_rows; ?>
                <input type="radio" name="event" class="rdevent" data-event="-1" /><span class="event-item" data-event="-1">Custom Event:</span><br/>
                <?php if($event == -1){ ?>
                Title:<br/><input name='title' type="text" class="form-control" id="txtCustomEvent" placeholder="Enter your custom event name" required="required" />
                <br/>
                City:<br/>
                <select name="city" required="required">
                    <option value="">Select a city</option>
                    <option value="Westfield">Westfield</option>
                    <option value="Carmel">Carmel</option>
                    <option value="Fishers">Fishers</option>
                    <option value="Noblesville">Noblesville</option>
                    <option value="Sheridan">Sheridan</option>
                    <option value="Indianapolis">Indianapolis</option>
                <br/>
                Address: <br/><input name='address' type="text" class="form-control" id="txtAddress" placeholder="Enter your custom event address" required="required" />
                <input name='latitude' id='latitude' type="hidden" class="form-control" required="required" />
                <input name='longitude' id='longitude' type="hidden" class="form-control" required="required" />
                <?php } ?>
                <input type="hidden" name="day" value="<?php echo $day; ?>" />
                <input type="hidden" name="event" value="<?php echo $event; ?>" />
            </div>
        </div>
        <div class="span8">
            <img src="img/city-map.png" class="img img-responsive" />
        </div>
    </div>
    <br/><br/>
    <br/>
    <div class="row text-center">
        <div class="span4 mobile-margin">
            <a href="index.php" class="btn">Back</a>
        </div>
        <div class="span4 mobile-margin">
            <input id="btnTripCancel" type="button" class="btn btn-danger" value="Clear Your Trip" <?php echo $finDisabled; ?> data-toggle="modal" data-target="#ClearConfirmationModal" />
        </div>
        <div class="span4 mobile-margin">
            <input id="btnStep1Finalize" type="submit" class="btn btn-success" value="Next" />
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
</form>

<script src="js/city.js"></script>
<script src="js/add-str.js"></script>
<?php include('master/footer.php'); ?>


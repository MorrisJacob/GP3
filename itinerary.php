<?php include('master/header.php'); ?>
<?php include('php/controls/cities.php'); ?>
<?php include('php/pages/itinerary.php'); ?>
<div class="row text-center">
    <div class="span12">
	<h3>Manage Your Trip Activities</h3>
    </div>
</div>
<br/>
<form action="itinerary.php?city=<?php echo $event; ?>&types=<?php echo $types; ?>" method="POST">
    <input type="hidden" name="event" value="<?php echo $event; ?>" />
    <input type="hidden" name="types" value="<?php echo $types; ?>" />
    <div class="row text-center">
        <div id="map"></div>
        <div id="listing">
          <table id="resultsTable">
            <tbody id="results"></tbody>
          </table>
        </div>
        <div style="display: none">
          <div id="info-content">
            <table>
              <tr id="iw-url-row" class="iw_table_row">
                <td id="iw-icon" class="iw_table_icon"></td>
                <td id="iw-url"></td>
              </tr>
              <tr id="iw-address-row" class="iw_table_row">
                <td class="iw_attribute_name">Address:</td>
                <td id="iw-address"></td>
              </tr>
              <tr id="iw-phone-row" class="iw_table_row">
                <td class="iw_attribute_name">Telephone:</td>
                <td id="iw-phone"></td>
              </tr>
              <tr id="iw-rating-row" class="iw_table_row">
                <td class="iw_attribute_name">Rating:</td>
                <td id="iw-rating"></td>
              </tr>
              <tr id="iw-website-row" class="iw_table_row">
                <td class="iw_attribute_name">Website:</td>
                <td id="iw-website"></td>
              </tr>
              <tr id="iw-schedule-row" class="iw_table_row">
                <td class="iw_attribute_name">Date/Time:</td>
                <td id="iw-schedule"><input type="datetime-local" class="form-control itin-time"/> <input type="button" value="+" class="btn btn-success add-itinerary" /></td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <br/>
    <div class="row text-center">
        <div class="span3">
            Title
        </div>
        <div class="span3">
            Address
        </div>
        <div class="span3">
            Date/Time
        </div>
        <div class="span3">
            Remove
        </div>
    </div>
    <div id="itinerarytimes" class="row text-center">
        <?php echo $activity_rows; ?>
    </div>
    <div class="row text-center">
        <div class="span12">
            <input type="submit" value="Finished" class="btn btn-success" />
        </div>
    </div>
</div>
<script type="text/javascript">
var short_terms = <?php echo $strs; ?>;
</script>
<script type="text/javascript" src="js/itinerary.js"></script>
<?php include('master/footer.php'); ?>


<?php include('master/header.php'); ?>
<?php include('php/pages/itinerary.php'); ?>
<div class="row text-center">
    <div class="span2 city-<?php echo $city; ?>">
    </div>
    <div class="span2 city-westfield city-loc">WESTFIELD</div>
    <div class="span2 city-carmel city-loc">CARMEL</div>
    <div class="span2 city-noblesville city-loc">NOBLESVILLE</div>
    <div class="span2 city-fishers city-loc">FISHERS</div>
    <div class="span2 city-sheridan city-loc">SHERIDAN</div>
</div>
<br/>
<?php if($strs != "''") { ?>
<div class="row city-<?php echo $city; ?>">
    <div class="span4">
        Number of Rooms:<br/>
        <select id="numberRooms">
            <option value="0">Any</option>
            <option value="1">1 room</option>
            <option value="2">2 rooms</option>
            <option value="3">3 rooms</option>
            <option value="4">4+ rooms</option>
        </select>
    </div>
    <div class="span4">
        Number of Occupants:<br/>
        <select id="numberOccupancy">
            <option value="0">Any</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
        </select>
    </div>
</div>
<?php } ?>

<form action="itinerary.php?event=<?php echo $event; ?>&types=<?php echo $types; ?>" method="POST">
    <input type="hidden" name="event" value="<?php echo $event; ?>" />
    <input type="hidden" name="types" value="<?php echo $types; ?>" />
    <input type="hidden" name="day" value="<?php echo $day; ?>" />
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
              <tr id="iw-dist-row" class="iw_table_row">
                <td class="iw_attribute_name">Distances:</td>
                <td id="iw-distance"></td>
              </tr>
              <tr id="iw-distance-row" class="iw_table_row" style='display:none;'>
                <td id="iw-lodge"></td>
                <td id="iw-event"></td>
              </tr>
              <tr id="iw-location-row" class="iw_table_row" style='display:none;'>
                <td id="iw-latitude"></td>
                <td id="iw-longitude"></td>
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
                <td class="iw_attribute_name"></td>
                <td id="iw-schedule"><input type="button" value="Add To Cart" class="btn btn-success add-itinerary" /></td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <br/>
    <div class="row text-center itinerary-title hidden-xs">
        <div class="span2">
            Day
        </div>
        <div class="span4">
            Destination
        </div>
        <div class="span2">
            To Event
        </div>
        <div class="span2">
            To Overnight Stay
        </div>
        <div class="span2" style="color:red;">
            Remove
        </div>
    </div>
    <div id="itinerarytimes" class="row text-center">
        <?php echo $activity_rows; ?>
    </div>
    <div class="row text-center">
        <div class="span12">
            <a href="#" onclick="history.go(-1)"><input type="button" value="BACK" class="btn btn-danger" /></a>&nbsp;&nbsp;
            <input type="submit" value="NEXT" class="btn btn-success" />
        </div>
    </div>
</div>
<script type="text/javascript">
var short_terms = <?php echo $strs; ?>;
var lodgeRows = <?php echo $lodgeRows; ?>;
var lodgeLat = <?php echo $lodgeLat; ?>;
var lodgeLon = <?php echo $lodgeLon; ?>;
var city = "<?php echo $city; ?>";
var eventLat = <?php echo $eventLat; ?>;
var eventLon = <?php echo $eventLon; ?>;
</script>
<script type="text/javascript" src="js/itinerary.js"></script>
<?php include('master/footer.php'); ?>


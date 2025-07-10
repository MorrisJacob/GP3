<?php include('master/header.php'); ?>
<?php include('php/pages/activitylocations.php'); ?>
<div class="row text-center">
    <div class="span2 city-<?php echo $city; ?>">
    </div>
    <div class="span4">
        <div>Select A City</div>
        <br/>
        <select id="city" name="city">
            <option>Westfield</option>
            <option>Carmel</option>
            <option>Fishers</option>
            <option>Noblesville</option>
            <option>Sheridan</option>
            <option>Indianapolis</option>
        </select>
    </div>
    <div class="span4">
        <div>Select an Activity Type</div>
        <br/>
        <select id="type" name="type">
            <option value="lodging">Hotels</option>
            <option value="campground">Campgrounds</option>
            <option value="restaurant,fast_food">Fast Food</option>
            <option value="restaurant">Restaurants</option>
            <option value="restaurant,team">Team Restaurants</option>
            <option value="restaurant,pizza">Pizza</option>
            <option value="bar,bowling_alley,library,movie_theater,museum,park,shopping_mall,tourist_attraction">Entertainment</option>
            <option value="park">Parks</option>
            <option value="golf_course">Golf Courses</option>
            <option value="bank,book_store,car_repair,car_wash,church,convenience_store,electronics_store,gym,hospital,lawyer,library,liquor_store,pet_store,pharmacy,post_office,shopping_mall,spa,supermarket">Much More</option>
        </select>
    </div>
</div>
<br/>

<form action="activitylocations.php" method="POST">
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
              </tr>
            </table>
          </div>
        </div>
    </div>
    <br/>
</div>
<script type="text/javascript">
</script>
<script type="text/javascript" src="js/activitylocations.js"></script>
<?php include('master/footer.php'); ?>


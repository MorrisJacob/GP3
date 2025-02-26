<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $itineraryTimes = $_POST['itinerarytime'];   
    $itineraryTitles = $_POST['itineraryTitle'];   
    $itineraryAddresses = $_POST['itineraryAddress'];   
    $event = GetSafeString($_POST['event']);
    $types = GetSafeString($_POST['types']);

    // Attempt to get Trip. If none exists, create trip.
    $trip = GetTrip($userid, $event);

    if(is_null($trip) or $trip == "" or $trip == 0){
        $trip = CreateTrip($userid, $event);
    }

    //Delete all of the previous activities of this type in this trip 
    DeleteItinerary($trip, $types);

    //Add all new activities
    CreateItinerary($trip, $itineraryTimes, $itineraryTitles, $itineraryAddresses, $types);

    echo '<script type="text/javascript">window.location = "city.php?city=' . $event . '";</script>   ';
} else {

    $event = GetSafeString($_GET['city']);
    $types = GetSafeString($_GET['types']);
    $activity_rows = "";

    //Get current trip events
    $trip = GetTrip($userid, $event);

    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip_activities = GetActivities($trip, $types);
        
        if (is_null($trip_activities) || count($trip_activities) > 0) {
            // output data of each row
            foreach($trip_activities as $row) {

                $activity_rows .= <<<END

                        <div class="row text-center itinerary-row">
                            <div class="span3">
                                {$row["Title"]} <input type="hidden" name="itineraryTitle[]" value={$row['Title']}" />
                            </div>
                            <div class="span3">
                                {$row["Address"]} <input type="hidden" name="itineraryAddress[]" value="{$row['Address']}" />
                            </div>
                            <div class="span3">
                                <input type="datetime-local" class="form-control" name="itinerarytime[]" value="{$row['ActivityTime']}" />
                            </div>
                            <div class="span3">
                                <input type="button" value="X" class="btn btn-danger delete-row" />
                            </div>
                        </div>
                END;

            }

        }
        
        if($types == "str"){
            //Pull Short-Term Rental information from database
            $short_terms = ExecuteSQLArray("SELECT 'https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/lodging-71.png' icon, CONCAT('{ \"lat\": ', latitude, ', \"lng\": ' , longitude, '}') location, " . 
                                                "phone formatted_phone_number, name, address vicinity, url, url website FROM ShortTermRentals");
            
            if(count($short_terms) > 0) {
                foreach($short_terms as &$row){
                    $row['location'] = json_decode($row['location'], true);
                }
            }
            $strs = json_encode($short_terms);
        }
    }
}

?>

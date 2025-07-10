<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $itineraryTitles = GetSafeString($_POST['itineraryTitle']);   
    $itineraryAddresses = GetSafeString($_POST['itineraryAddress']);   
    $itineraryLatitudes = GetSafeString($_POST['itineraryLatitude']);   
    $itineraryLongitudes = GetSafeString($_POST['itineraryLongitude']);   
    $itineraryCities = GetSafeString($_POST['city']);
    $itineraryLodge = GetSafeString($_POST['itineraryLodge']);   
    $itineraryEvent = GetSafeString($_POST['itineraryEvent']);   
    $event = GetSafeString($_POST['event']);
    $types = GetSafeString($_POST['types']);
    $day = GetSafeString($_POST['day']);

    // Attempt to get Trip. If none exists, create trip.
    $trip = GetTrip($userid, $event);

    if(is_null($trip) or $trip == "" or $trip == 0){
        $trip = CreateTrip($userid, $event);
    }


    //Delete all of the previous activities of this type in this trip for this day
    DeleteItinerary($trip, $types, $day);

    //Add all new activities
    CreateItinerary($trip, $itineraryTitles, $itineraryAddresses, $types, $itineraryLatitudes, $itineraryLongitudes, $itineraryCities, $itineraryLodge, $itineraryEvent, $day);

    echo '<script type="text/javascript">window.location = "city.php?event=' . $event . '&day=' . $day . '";</script>   ';
} else {

    $event = GetSafeString($_GET['event']);
    $city = GetCity($event);
    $eventInfo = GetEvent($event);
    $types = GetSafeString($_GET['types']);
    $day = GetSafeString($_GET['day']);
    $activity_rows = "";
    $lodgeRows = "''";
    $lodgeLat = 0;
    $lodgeLon = 0;
    $eventLat = $eventInfo[0]['latitude'] ?? 0;
    $eventLon = $eventInfo[0]['longitude'] ?? 0;

    //Get current trip events
    $trip = GetTrip($userid, $event);

    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip = CreateTrip($userid, $event);
    }

    if($types == "str" || $types == "lodging" || $types == "campground"){
        $trip_activities = GetActivities($trip, $types);
    } else{
        $trip_activities = GetAllActivitiesForDay($trip, $day);
    }
    
    if (is_null($trip_activities) || count($trip_activities) > 0) {
        // output data of each row
        foreach($trip_activities as $row) {

            $day = ucwords($row['DayOfWeek']);

            $activity_rows .= <<<END

                    <div class="row text-center itinerary-row city-{$row['City']}">
                        <div class="span2">
                            <span class="visible-xs mobile-title">Day:</span>{$day}
                        </div>
                        <div class="span4">
                            <span class="visible-xs mobile-title">Destination: </span>
                            <a href="https://www.google.com/maps/place/{$row["Address"]}" class="address-link" target="_blank">{$row["Title"]} 🔗</a>
                            <input type="hidden" name="itineraryTitle[]" value="{$row['Title']}" />
                            <input type="hidden" name="itineraryAddress[]" value="{$row['Address']}" />
                            <input type="hidden" name="itineraryLatitude[]" value="{$row['latitude']}" />
                            <input type="hidden" name="itineraryLongitude[]" value="{$row['longitude']}" />
                            <input type="hidden" name="itineraryLodge[]" value="{$row['LodgeDistance']}" />
                            <input type="hidden" name="itineraryEvent[]" value="{$row['EventDistance']}" />
                            <input type="hidden" name="city[]" value="{$row['City']}" />
                        </div>
                        <div class="span2">
                            <span class="visible-xs mobile-title">To Event: </span>{$row["EventDistance"]}
                        </div>
                        <div class="span2">
                            <span class="visible-xs mobile-title">To Overnight Stay: </span>{$row["LodgeDistance"]}
                        </div>
                        <div class="span2">
                            <input type="button" value="X" class="btn btn-danger delete-row" />
                        </div>
                    </div>
            END;

        }

    }

    //If it's a lodging type, get count of all lodgings and return to front-end
    $lodging = GetLodging($trip);
    if($types == "str" || $types == "lodging" || $types == "campground"){
        $lodgeRows = count($lodging);
        //remove this current type (js will handle)
        $lodgeRows = $lodgeRows - count(GetActivities($trip, $types) ?? []);
    } else {
        //Non-lodging type. set lat/lng for front-end to utilize for distance formula
        $lodgeLat = $lodging[0]['latitude'] ?? "''";
        $lodgeLon = $lodging[0]['longitude'] ?? "''";
    }
    

    if($types == "str"){
        //Pull Short-Term Rental information from database
        $short_terms = ExecuteSQLArray("SELECT 'https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/lodging-71.png' icon, CONCAT('{ \"lat\": ', latitude, ', \"lng\": ' , longitude, '}') location, " . 
                                            "'' vicinity, name, url, url website, RoomCount, Occupancy FROM ShortTermRentals");
        
        if(count($short_terms) > 0) {
            foreach($short_terms as &$row){
                $row['location'] = json_decode($row['location'], true);
            }
        }
        $strs = json_encode($short_terms);
    } else {
        $strs = "''";
    }
}

?>

<?php

$event = GetSafeString($_GET['city']);
$trip = GetSafeString($_GET['trip']);
$gametime_rows = "";
$itinerary_rows = "";
$trip_rows = "";

if($userid == 0 && is_null($trip)){
    //Force to create account if they're not viewing one trip as anonymous user
    echo '<script type="text/javascript">window.location = "create-account.php";</script>   ';    
}else{
    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip_events = GetEvents($trip);
        $trip_activities = GetAllActivities($trip);
        
        if (!is_null($trip_events) && count($trip_events) > 0) {
            // output data of each row
            foreach($trip_events as $row) {
                $gametime_rows .= <<<END
                      <div class="row text-center"> 
                         <div class="span4">
                             {$row["GameTime"]}
                         </div>
                         <div class="span4">
                            {$row["GateNumber"]}
                         </div>
                         <div class="span4">
                            {$row["FieldNumber"]}
                         </div>
                     </div>
                END;

            }

        } 


        if (!is_null($trip_activities) && count($trip_activities) > 0) {
            // output data of each row
            foreach($trip_activities as $row) {
                $itinerary_rows .= <<<END
                      <div class="row text-center"> 
                         <div class="span4">
                             {$row["ActivityTime"]}
                         </div>
                         <div class="span4">
                            {$row["Title"]}
                         </div>
                         <div class="span4">
                            {$row["Address"]}
                         </div>
                     </div>
                END;

            }

        } 
    } else{
        //Get Past Trips
        $past_trips = GetPastTrips($userid, $event);
        if(!is_null($past_trips) && count($past_trips) > 0){
            foreach($past_trips as $row){
                $trip_rows .= <<<END
                          <div class="row text-center" style="margin-bottom:10px;"> 
                             <div class="span12">
                                 <h4><a href="cart-history.php?city={$event}&trip={$row["TripId"]}">Trip Created On {$row["Created"]}</a></h4>
                             </div>
                         </div>
                END;
            }
        } else {
            $trip_rows .= <<<END
                      <div class="row text-center"> 
                         <div class="span12">
                            No Past Trips Found.
                         </div>
                     </div>
            END;
        }
    }

}

?>

<?php

$event = GetSafeString($_GET['event']);
$city = GetCity($event);
$trip = GetSafeString($_GET['trip']);
$gametime_rows = "";
$itinerary_rows = "";
$trip_rows = "";
$fieldTitle = GetFieldTitle($event);
$showGate = ShouldShowGate($event);
$showField = ShouldShowField($event);

if($userid == 0 && is_null($trip)){
    //Force to create account if they're not viewing one trip as anonymous user
    echo '<script type="text/javascript">window.location = "create-account.php";</script>   ';    
}else{
    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip_events = GetEvents($trip);
        $trip_activities = GetAllActivities($trip);
        
        if (!is_null($trip_events) && count($trip_events) > 0) {
            // output data of each row
            $gateHTML = "";
            $fieldHTML = "";
            foreach($trip_events as $row) {
                if($showGate){
                    $gateHTML = <<<END
                        <div class="span3">
                            {$row["GateNumber"]}
                        </div>
                    END;
                }
                if($showField){
                    $fieldHTML = <<<END
                        <div class="span3">
                            {$row["FieldNumber"]}
                        </div>
                    END;
                }
                $gametime_rows .= <<<END
                      <div class="row text-center city-{$city}"> 
                         <div class="span3">
                             {$row["DayOfWeek"]}
                         </div>
                         <div class="span3">
                            {$row["Time"]}
                        </div>
                        $gateHTML
                        $fieldHTML
                     </div>
                END;

            }

        } 


        if (!is_null($trip_activities) && count($trip_activities) > 0) {
            // output data of each row
            foreach($trip_activities as $row) {
                $itinerary_rows .= <<<END
                      <div class="row text-center city-{$row["City"]}"> 
                         <div class="span3">
                             {$row["DayOfWeek"]}
                         </div>
                         <div class="span3">
                            {$row["Time"]}
                        </div>
                         <div class="span3">
                            <a href="https://www.google.com/maps/place/{$row["Address"]}" class="address-link" target="_blank">{$row["Title"]} 🔗</a>
                         </div>
                         <div class="span3">
                            <a href="https://www.google.com/maps/place/{$row["Address"]}" class="address-link" target="_blank">{$row["Address"]} 🔗</a>
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
function GetFieldTitle($event){
    $courtEvents = array(3,5);
    if(in_array($event, $courtEvents)){
        return "Court";
    } else {
        return "Field";
    }
}
function ShouldShowGate($event){
    if($event == 1){
        return true;
    } else{
        return false;
    }
}

function ShouldShowField($event){
    $fieldEnabled = array(1,3,5,7);
    if(in_array($event, $fieldEnabled)){
        return true;
    } else{
        return false;
    }
}

?>

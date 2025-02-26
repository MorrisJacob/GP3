<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event = GetSafeString($_POST['event']);
    $emails = $_POST["emails"];

    if($userid == 0 || is_null($userid)){
        echo "<script type='text/javascript'>location.href = 'create-account.php?redirect=cart.php&event=" . $event . "';</script>";
    } 

    $subject = "A GrandParkRentals Event has been set up for you!";
    $message = WriteMessage($userid, $event);

    //Send email to each in list
    foreach($emails as $i => $email){
        $thisMessage = $message;
        if(!str_contains($email, "@")){
            //email is a phone number. clean it and send it
            $email = preg_replace('/[()\-\.\s]/', '', $email);
            $email = $email . "@vtext.com";
            //$thisMessage = "";
        }
        echo $email;
        SendEmail($email, $subject, $thisMessage);
    }

    //Update Trip from draft to published
    $trip = GetTrip($userid, $event);
    $updateTrip = "UPDATE Trip SET IsDraft = 0 WHERE TripId = " . $trip;
    ExecuteSQL($updateTrip);

    echo '<script type="text/javascript">window.location = "index.php";</script>   ';
} else {

    $event = GetSafeString($_GET['city']);
    $gametime_rows = "";
    $itinerary_rows = "";

    //Get current trip events
    $trip = GetTrip($userid, $event);

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
    }
}

function WriteMessage($userid, $event){
    //Get current trip events
    $trip = GetTrip($userid, $event);
    $message = "";

    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip_events = GetEvents($trip);
        $trip_activities = GetAllActivities($trip);

        $message .= "\t\tEVENT\n";
        
        if (!is_null($trip_events) && count($trip_events)) {
            // output data of each row
            foreach($trip_events as $row) {
                $message .= <<<END
                GameTime: {$row["GameTime"]}\nGate Number: {$row["GateNumber"]}\nField Number: {$row["FieldNumber"]}\n\n
                END;
            }

        } else {
    
            $message .= "No Event!\n\n";

        } 


        if (!is_null($trip_activities) && count($trip_activities)) {
            // output data of each row
            $message .= "\n\t\tACTIVITIES\n";
            foreach($trip_activities as $row) {
                $message .= <<<END
                Activity Time: {$row["ActivityTime"]}\nActivity: {$row["Title"]}\nAddress: {$row["Address"]}\n\n
                END;
            }
        } 

        $message .= <<<END
            \n\n\n
            View Your Trip Itinerary here: https://grandparkrentals.com/new-site/cart-history.php?city={$event}&trip={$trip}
            END;
    }

    return $message;

}
?>

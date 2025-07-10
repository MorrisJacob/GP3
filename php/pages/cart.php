<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event = GetSafeString($_POST['event']);
    $emails = $_POST["emails"];
    $notes = $_POST["notes"];
    $gameDays = $_POST["GameDay"];
    $gameTimes = $_POST["GameTime"];
    $gameGates = $_POST["GameGate"];
    $gameFields = $_POST["GameField"];
    $activityDays = $_POST["ActivityDay"];
    $activityTimes = $_POST["ActivityTime"];
    $activityIds = $_POST["ActivityId"];
    $activityAddresses = $_POST["ActivityAddress"];
    $chkText = $_POST["chkText"];


    $trip = GetTrip($userid, $event);
    DeleteEvents($trip);
    CreateEvents($trip, $gameDays, $gameTimes, $gameGates, $gameFields);
    UpdateActivities($activityIds, $activityDays, $activityTimes, $activityAddresses);

    if(!is_null($emails)){

        $subject = "A GrandParkRentals Event has been set up for you!";
        $emailMessage = WriteMessage($userid, $event, $notes, GetFieldTitle($event));

        //Send email to each in list
        foreach($emails as $i => $email){
            $thisMessage = $emailMessage;
            if(!str_contains($email, "@") && $chkText == "Yes"){
                //email is a phone number. clean it and send it
                $email = preg_replace('/[()\-\.\s]/', '', $email);
                $thisMessage = WriteText($userid, $event);
                SendText($email, $thisMessage);
                AuditTripSend($userid, $trip, $email, $thisMessage, "text");
            } else {
                SendEmail($email, $subject, $thisMessage, "Email");
                AuditTripSend($userid, $trip, $email, $thisMessage, "email");
            }
        }

        if($userid == 0 || is_null($userid)){
            echo "<script type='text/javascript'>location.href = 'create-account.php?redirect=cart.php&event=" . $event . "';</script>";
        } 


        echo '<script type="text/javascript">window.location = "index.php";</script>   ';

    } else {
        echo '<script type="text/javascript">window.location = "activities.php?event=' . $event . '&day=monday&fromsave=1";</script>   ';
    }
} else {

    $event = GetSafeString($_GET['event']);
    $eventName = GetEvent($event)[0]['Event'];

    if($event == "" || $event == 0){
        //just default to Grand Park for now
        $event = 1;
    }

    $city = GetCity($event);
    $gametime_rows = "";
    $itinerary_rows = "";
    $timeAdditions = "";
    $fieldTitle = GetFieldTitle($event);

    $showGate = ShouldShowGate($event);
    $showField = ShouldShowField($event);

    $daysOfWeek = <<<END
            <option value="">Select a day...</option>
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
    END;


    $timeAdditions = GetTimeAdditions($event);
    $gameTimes = <<<END
            <option value="">Select a time...</option>
            $timeAdditions
            <option value="6:30 AM">6:30 AM</option>
            <option value="6:45 AM">6:45 AM</option>
            <option value="7:00 AM">7:00 AM</option>
            <option value="7:15 AM">7:15 AM</option>
            <option value="7:30 AM">7:30 AM</option>
            <option value="7:45 AM">7:45 AM</option>
            <option value="8:00 AM">8:00 AM</option>
            <option value="8:15 AM">8:15 AM</option>
            <option value="8:30 AM">8:30 AM</option>
            <option value="8:45 AM">8:45 AM</option>
            <option value="9:00 AM">9:00 AM</option>
            <option value="9:15 AM">9:15 AM</option>
            <option value="9:30 AM">9:30 AM</option>
            <option value="9:45 AM">9:45 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="10:15 AM">10:15 AM</option>
            <option value="10:30 AM">10:30 AM</option>
            <option value="10:45 AM">10:45 AM</option>
            <option value="11:00 AM">11:00 AM</option>
            <option value="11:15 AM">11:15 AM</option>
            <option value="11:30 AM">11:30 AM</option>
            <option value="11:45 AM">11:45 AM</option>
            <option value="12:00 PM">12:00 PM</option>
            <option value="12:15 PM">12:15 PM</option>
            <option value="12:30 PM">12:30 PM</option>
            <option value="12:45 PM">12:45 PM</option>
            <option value="1:00 PM">1:00 PM</option>
            <option value="1:15 PM">1:15 PM</option>
            <option value="1:30 PM">1:30 PM</option>
            <option value="1:45 PM">1:45 PM</option>
            <option value="2:00 PM">2:00 PM</option>
            <option value="2:15 PM">2:15 PM</option>
            <option value="2:30 PM">2:30 PM</option>
            <option value="2:45 PM">2:45 PM</option>
            <option value="3:00 PM">3:00 PM</option>
            <option value="3:15 PM">3:15 PM</option>
            <option value="3:30 PM">3:30 PM</option>
            <option value="3:45 PM">3:45 PM</option>
            <option value="4:00 PM">4:00 PM</option>
            <option value="4:15 PM">4:15 PM</option>
            <option value="4:30 PM">4:30 PM</option>
            <option value="4:45 PM">4:45 PM</option>
            <option value="5:00 PM">5:00 PM</option>
            <option value="5:15 PM">5:15 PM</option>
            <option value="5:30 PM">5:30 PM</option>
            <option value="5:45 PM">5:45 PM</option>
            <option value="6:00 PM">6:00 PM</option>
            <option value="6:15 PM">6:15 PM</option>
            <option value="6:30 PM">6:30 PM</option>
            <option value="6:45 PM">6:45 PM</option>
            <option value="7:00 PM">7:00 PM</option>
            <option value="7:15 PM">7:15 PM</option>
            <option value="7:30 PM">7:30 PM</option>
            <option value="7:45 PM">7:45 PM</option>
            <option value="8:00 PM">8:00 PM</option>
            <option value="8:15 PM">8:15 PM</option>
            <option value="8:30 PM">8:30 PM</option>
            <option value="8:45 PM">8:45 PM</option>
            <option value="9:00 PM">9:00 PM</option>
    END;

    $gates = <<<END
        <select class="require-check" name="GameGate[]">
            <option value="">Select a gate...</option>
            <option value="N/A">N/A</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
            <option value="H">H</option>
            <option value="I">I</option>
            <option value="J">J</option>
        </select>
    END;

    $fieldOptions = GetFieldOptions($event);

    $fields = <<<END
        <select class="require-check" name="GameField[]">
            <option value="">Select a $fieldTitle...</option>
            $fieldOptions
        </select>
    END;

    //Get current trip events
    $trip = GetTrip($userid, $event);

    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip_events = GetEvents($trip);
        $trip_activities = GetAllActivities($trip);

        $gateHTML = "";
        $fieldHTML = "";

        if($showGate){
            $gateHTML = <<<END
                     <div class="span2 gamegate">
                        <span class="visible-xs mobile-title">Gate: </span>
                        {$gates}
                     </div>
            END;
        }

        if($showField){
            $fieldHTML = <<<END
                     <div class="span2 gamefield">
                        <span class="visible-xs mobile-title">$fieldTitle: </span>
                        {$fields}
                     </div>
            END;
        }


        $gametime_rows_template = <<<END
                  <div class="row text-center city-{$city} gametime-row"> 
                     <div class="span3 gameday">
                        <span class="visible-xs mobile-title">Game Day: </span>
                        <select class="require-check day-select" name="GameDay[]">
                            {$daysOfWeek}
                        </select>
                     </div>
                     <div class="span2 gametime">
                        <span class="visible-xs mobile-title">Be There: </span>
                        <select class="require-check" name="GameTime[]">
                            {$gameTimes}
                        </select>
                     </div>
                     $gateHTML
                     $fieldHTML
                 </div>
            END;

        $gametime_rows = "<div id='template' style='display:none;'>$gametime_rows_template</div>";
        
        if (!is_null($trip_events) && count($trip_events) > 0) {

            // output data of each row
            foreach($trip_events as $row) {
                $dayDropdown = generateSelectedDropdown($row["DayOfWeek"], $daysOfWeek);
                $timeDropdown = generateSelectedDropdown($row["Time"], $gameTimes);
                $fieldDropdown = generateSelectedDropdown($row["FieldNumber"], $fields);
                $gateDropdown = generateSelectedDropdown($row["GateNumber"], $gates);

                if($showGate){
                    $gateHTML = <<<END
                             <div class="span2 gamegate">
                                <span class="visible-xs mobile-title">Gate: </span>
                                {$gateDropdown}
                             </div>
                    END;
                }

                if($showField){
                    $fieldHTML = <<<END
                             <div class="span2 gamefield">
                                <span class="visible-xs mobile-title">$fieldTitle: </span>
                                {$fieldDropdown}
                             </div>
                    END;
                }

                $gametime_rows .= <<<END
                      <div class="row text-center city-{$city} gametime-row row-data"> 
                         <div class="span3 gameday">
                            <span class="visible-xs mobile-title">Game Day: </span>
                            <select class="require-check day-select" name="GameDay[]">
                                {$dayDropdown}
                            </select>
                         </div>
                         <div class="span2 gametime">
                            <span class="visible-xs mobile-title">Be There: </span>
                            <select class="require-check" name="GameTime[]">
                                {$timeDropdown}
                            </select>
                         </div>
                         $gateHTML
                         $fieldHTML
                        <div class="span2">
                            <input type="button" value="X" class="btn btn-danger delete-row" />
                        </div>
                     </div>
                END;

            }

        } else {
            $gametime_rows .= $gametime_rows_template;
        }


        if (!is_null($trip_activities) && count($trip_activities) > 0) {
            // output data of each row
            foreach($trip_activities as $row) {
                $dayDropdown = generateSelectedDropdown($row["DayOfWeek"], $daysOfWeek);
                $timeDropdown = generateSelectedDropdown($row["Time"], $gameTimes);
                $itinerary_rows .= <<<END
                      <div class="row text-center city-{$row["City"]} activity-row row-data"> 
                         <div class="span3">
                            <span class="visible-xs mobile-title">Activity Day: </span>
                            <select name="ActivityDay[]" class="require-check day-select">
                                {$dayDropdown}
                            </select>
                            <input type="hidden" value="{$row["TripItineraryId"]}" name="ActivityId[]">
                         </div>
                         <div class="span2">
                            <span class="visible-xs mobile-title">Be There: </span>
                            <select name="ActivityTime[]" class="require-check">
                                {$timeDropdown}
                            </select>
                         </div>
                         <div class="span3">
                            <span class="visible-xs mobile-title">Title: </span>
                            <a href="https://www.google.com/maps/place/{$row["Address"]}" class="address-link" target="_blank">{$row["Title"]} 🔗</a>
                            <input type="hidden" value="{$row["Address"]}" name="ActivityAddress[]">
                         </div>
                         <div class="span2">
                            <span class="visible-xs mobile-title">To Lodge: </span>
                            {$row["LodgeDistance"]} Miles
                         </div>
                         <div class="span2">
                            <span class="visible-xs mobile-title">To Event: </span>
                            {$row["EventDistance"]} Miles
                         </div>
                     </div>
                END;

            }

        } 
    }
}

function WriteMessage($userid, $event, $notes, $fieldTitle){
    //Get current trip events
    $trip = GetTrip($userid, $event);
    $message = "";

    if(!is_null($trip) and $trip != "" and $trip != 0){
        $trip_events = GetEvents($trip);
        $trip_activities = GetAllActivities($trip);
        $city = GetCity($event);
        $color = GetCityColor($city);

        $message .= "<br/><br/>You've been invited to a GrandParkRentals event!<br/><br/>";

        $message .= "<h2>MAIN EVENT: " . GetEventString($event) . "</h2><br/><br/>";


        $message .= "<h3 style='text-decoration:underline;'>Game Day Events</h3><br/><br/>";
        
        if (!is_null($trip_events) && count($trip_events)) {
            // output data of each row
            $gateHTML = "";
            $fieldHTML = "";

            if(ShouldShowGate($event)){
                $gateHTML = "<th>Gate Number</th>";
            }

            if(ShouldShowField($event)){
                $fieldHTML = "<th>$fieldTitle Number</th>";
            }

            $message .= "<table style='text-align:left;border:none;width:100%;'><tr><th>Game Day</th><th>Be There</th>" . $gateHTML . $fieldHTML . "</tr>";
            foreach($trip_events as $row) {

                if(ShouldShowGate($event)){
                    $gateHTML = "<td>{$row["GateNumber"]}</td>";
                }

                if(ShouldShowField($event)){
                    $fieldHTML = "<td>{$row["FieldNumber"]}</td>";
                }

                $message .= <<<END
                    <tr style="color:{$color}"><td>{$row["DayOfWeek"]}</td><td>{$row["Time"]}</td>$gateHTML$fieldHTML</tr>
                END;
            }

            $message .= "</table><br/><br/>";

        } else {
    
            $message .= "No Event!<br/><br/>";

        } 


        $message .= "<h3 style='text-decoration:underline;'>Activities</h3><br/><br/>";

        if (!is_null($trip_activities) && count($trip_activities)) {
            // output data of each row
            $message .= "<table style='text-align:left;border:none;width:100%;'><tr><th>Activity Day</th><th>Activity Time</th><th>Activity</th></tr>";
            foreach($trip_activities as $row) {
                $color = GetCityColor($row["City"]);
                $message .= <<<END
                    <tr style="color:{$color}"><td>{$row["DayOfWeek"]}</td><td>{$row["Time"]}</td><td><a href="https://www.google.com/maps/place/{$row["Address"]}" target="_blank">{$row["Title"]}</a></td></tr>
                END;
            }

            $message .= "</table><br/><br/>";
        } else {
            $message .= "No Activities!<br/><br/>";
        }

        $message .= <<<END
            <br/><br/>
            Notes: <p>{$notes}</p>
            <br/><br/>
            <a href="https://grandparkrentals.com/new-site/cart-history.php?event={$event}&trip={$trip}">View Your Trip Itinerary</a>
        END;
    }

    return $message;

}

function WriteText($userid, $event){
    //Get current trip events
    $trip = GetTrip($userid, $event);
    $message = "You've been invited to an event at ";

    if(!is_null($trip) and $trip != "" and $trip != 0){
        $message .= GetEventString($event) . "! ";

        $message .= "View event details at https://grandparkrentals.com/new-site/cart-history.php?event={$event}&trip={$trip}";
    }

}

function generateSelectedDropdown($selectedValue, $fields_template) {

    return preg_replace_callback('/<option value="([^"]+)"/', function ($matches) use ($selectedValue) {
        $value = $matches[1];
        $selected = (strtolower($value) == strtolower($selectedValue)) ? ' selected' : '';
        return "<option value=\"$value\"$selected";
    }, $fields_template);
}

function GetEventString($event){
    $eventInfo = GetEvent($event);

    $color = GetCityColor($eventInfo[0]['City']);

    $eventString = "<a href='" . $eventInfo[0]['URL'] . "' style='color:" . $color . "' target='_blank'>" . $eventInfo[0]["Event"] . "</a>";


    return $eventString;
}

function GetCityColor($city){
    $colors = array(
        "westfield" => "green",
        "indianapolis" => "purple",
        "carmel" => "blue",
        "fishers" => "red",
        "noblesville" => "yellow"
    );

    if(array_key_exists($city, $colors)){
        return $colors[$city];
    } else {
        return "#000000"; // Default to black if city not found
    }
}

function GetTimeAdditions($event){
    $games = array(1,3,5);
    if(in_array($event, $games)){
        return <<<END
            <option value="After 1st Game">After 1st Game</option>
            <option value="After 2nd Game">After 2nd Game</option>
        END;
    } else {
        return "";
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

function GetFieldOptions($event){

    if($event == 1){
        return <<<END
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
        END;
    } else if($event == 5){
        return <<<END
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="1a">1a</option>
                <option value="1b">1b</option>
                <option value="2a">2a</option>
                <option value="2b">2b</option>
                <option value="3a">3a</option>
                <option value="3b">3b</option>
        END;

    } else if($event == 3){
        return <<<END
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
        END;
    } else if($event == 7){
        return <<<END
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
        END;
    } else{
        return "";
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

<?php
function GetValidString($str){
    if((isset($str)) && !empty($str))
    {
        return $str;
    }else{
        return "";
    }

}

function GetSafeString($str){
    $str = GetValidString($str);

    $str = str_replace("'", "", $str);
    $str = str_replace('"', "", $str);
    $str = str_replace(";", "", $str);

    return $str;
}

function SendEmail($toAddress, $subject, $message){
    $sendingEmail = "DoNotReply@GrandParkRentals.com";

    // use wordwrap() if lines are longer than 70 characters
    $message = wordwrap($message,70);

    $headers = 'From: ' . $sendingEmail . "\r\n" .
    'Reply-To: ' . $sendingEmail . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    // send email
    mail($toAddress,$subject,$message, $headers, "-f" . $sendingEmail);
}

function GetPastTrips($userid, $event){
    
    if(!isset($userid) || $userid == "" || $userid == 0){
        return null;
    }
    else {
        //user logged in. Return trips
        $sql = "SELECT TripId, Created FROM Trip WHERE UserID = " . $userid . " AND Event = '" .$event . "' AND IsDraft = 0;";
        return ExecuteSQLArray($sql);
    }
}

function GetTrip($userid, $event){

    if(!isset($userid) || $userid == "" || $userid == 0){
        //no user is logged in. If the session has event times, return some arbitrary string
        if(isset($_SESSION["eventTimes"])){
            return "SessionStart";
        } else{
            return null;
        }
    } else {
        //user logged in. Return tripID
        return GetSingleValueDB("SELECT TripId FROM Trip WHERE UserID = " . $userid . " AND Event = '" . $event . "' AND IsDraft = 1;", "TripId");
    }
}

function CreateTrip($userid, $event){

    if(!isset($userid) || $userid == "" || $userid == 0){
        //no user is logged in. Create empty array object and return arbitrary SessionStart placeholder
        $_SESSION["eventTimes"] = [];
        return "SessionStart";
    } else {
        ExecuteSQL("INSERT INTO Trip (UserId, Event, Created, IsDraft) VALUES (" . $userid . ", '" . $event . "', NOW(), 1);");
        return GetTrip($userid, $event);
    }

}

function GetEvents($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip
        return null;
    }
    if($trip == "SessionStart"){
        //session. return session events
        return $_SESSION["eventTimes"];
    } else {
        return ExecuteSQLArray("SELECT GameTime, GateNumber, FieldNumber FROM TripEvent WHERE TripId = " . $trip . ";");
    }
}

function ConvertEvents($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0 || $trip == "SessionStart"){
        //no trip
        return null;
    } else {
        //Assume event conversion means trip publish
        $updateTrip = "UPDATE Trip SET IsDraft = 0 WHERE TripId = " . $trip;
        ExecuteSQL($updateTrip);
        $events = $_SESSION["eventTimes"];
        foreach ($events as $i => $event) {
            $gameTime = $event["GameTime"];
            $gate = $event["GateNumber"];
            $field = $event["FieldNumber"];
            //logged in user. Add to db.
            $addgame = "INSERT INTO TripEvent(TripId, GameTime, GateNumber, FieldNumber) VALUES (" . $trip . ", '" . $gameTime . "', '" . $gate . "', '" . $field . "');";
            ExecuteSQL($addgame);
        }
    }   
}

function DeleteEvents($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip. Do nothing
        exit();
    }
    if($trip == "SessionStart"){
        //session. delete session events
        $_SESSION["eventTimes"] = [];
    } else {
        ExecuteSQL("DELETE FROM TripEvent WHERE TripId = " . $trip . ";");
    }
}

function CreateEvents($trip, $gameTimes, $gates, $fields){
    
    $isSession = true;
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip. Do nothing
        exit();
    }
    
    $isSession = $trip == "SessionStart";
        
    foreach ($gameTimes as $i => $gameTime) {
        $gate = $gates[$i];
        $field = $fields[$i];
        if($isSession){
            //session only. Add the item to the session events
            $_SESSION["eventTimes"][] = ["GameTime" => $gameTime, "GateNumber" => $gate, "FieldNumber" => $field];
        } else {
            //logged in user. Add to db.
            $addgame = "INSERT INTO TripEvent(TripId, GameTime, GateNumber, FieldNumber) VALUES (" . $trip . ", '" . $gameTime . "', '" . $gate . "', '" . $field . "');";
            ExecuteSQL($addgame);
        }
    }   

}


function GetAllActivities($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip
        return null;
    }
    if($trip == "SessionStart"){
        //session. return session events
        return $_SESSION["itineraryTimes"];
    } else {
        return ExecuteSQLArray("SELECT ActivityTime, Address, Title FROM TripItinerary WHERE TripId = " . $trip . ";");
    }
}

function ConvertActivities($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0 || $trip == "SessionStart"){
        //no trip
        return null;
    } else {
        $activities = $_SESSION["itineraryTimes"];
        foreach ($activities as $i => $activity) {
            $title = $activity["Title"];
            $address = $activity["Address"];
            $types = $activity["ActivityType"];
            $itineraryTime = $activity["ActivityTime"];
            //logged in user. Add to db.
            $addActivity = "INSERT INTO TripItinerary(TripId, Title, Address, ActivityType, ActivityTime) VALUES (" . $trip . ", '" . $title . "', '" . $address . "', '" . $types . "', '" . $itineraryTime . "');";
            ExecuteSQL($addActivity);
        }
    }   
}

function GetActivities($trip, $types){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip
        return null;
    }
    if($trip == "SessionStart"){
        //session. return session events
        return FilterArray($_SESSION["itineraryTimes"], "ActivityType", $types);
    } else {
        return ExecuteSQLArray("SELECT ActivityTime, Address, Title FROM TripItinerary WHERE TripId = " . $trip . " AND ActivityType = '" . $types . "';");
    }
}

function FilterArray($array, $field, $value){
    $returnArray = [];

    foreach($array as $item){
        if($item[$field] == $value){
            array_push($returnArray, $item);
        }
    }

    return $returnArray;
}

function ExcludeArray($array, $field, $value){
    $returnArray = [];

    foreach($array as $item){
        if($item[$field] != $value){
            array_push($returnArray, $item);
        }
    }

    return $returnArray;
}

function DeleteItinerary($trip, $activityType){
    
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip. Do nothing
        exit();
    }
    if($trip == "SessionStart"){
        //session. delete session itinerary
        $_SESSION["itineraryTimes"] = ExcludeArray($_SESSION["itineraryTimes"], "ActivityType", $types);
    } else {
        ExecuteSQL("DELETE FROM TripItinerary WHERE TripId = " . $trip . " AND ActivityType = '" . $activityType . "';");
    }
}

function CreateItinerary($trip, $itineraryTimes, $titles, $addresses, $types){

    $isSession = true;
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        //no trip. Do nothing
        exit();
    }
    
    $isSession = $trip == "SessionStart";
        
    foreach ($itineraryTimes as $i => $itineraryTime) {
        $title = $titles[$i];
        $address = $addresses[$i];
        if($isSession){
            //session only. Add the item to the session events
            $_SESSION["itineraryTimes"][] = ["ActivityTime" => $itineraryTime, "Title" => $title, "ActivityType" => $types, "Address" => $address];
        } else {
            //logged in user. Add to db.
            $addActivity = "INSERT INTO TripItinerary(TripId, Title, Address, ActivityType, ActivityTime) VALUES (" . $trip . ", '" . $title . "', '" . $address . "', '" . $types . "', '" . $itineraryTime . "');";
            ExecuteSQL($addActivity);
        }
    }   

}

?>

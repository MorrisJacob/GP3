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

function SendEmail($toAddress, $subject, $message, $isHTML = false){
    $sendingEmail = "DoNotReply@GrandParkRentals.com";

    $headers = "From: " . $sendingEmail . "\r\n" .
               "Reply-To: " . $sendingEmail . "\r\n" .
               "MIME-Version: 1.0\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if($isHTML){
        // Ensure the message is wrapped in a proper HTML structure
        $message = <<<END
        <html>
        <body>
            <style>
                table, th, td {
                    text-align: left;
                    border: none;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 15px;
                }
                table {
                    width: 100%;
                }
            </style>
            {$message}
        </body>
        </html>
        END;
        // Use correct headers for HTML email
        $headers .= "\r\nContent-Type: text/html; charset=UTF-8\r\n";
    }


    // Send email
    if(mail($toAddress, $subject, $message, $headers, "-f" . $sendingEmail)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }
}

function GetEventLocations(){
    $sql = "SELECT Id, Event, City, URL FROM Event WHERE Active = 1 AND IsPublic = 1;";
    return ExecuteSQLArray($sql);
}

function CreateEventLocation($title, $city, $latitude, $longitude){
    $title = GetSafeString($title);
    $city = GetSafeString($city);
    $latitude = GetSafeString($latitude);
    $longitude = GetSafeString($longitude);

    $sql = "INSERT INTO Event (Event, City, Active, Latitude, Longitude, IsPublic) VALUES ('" . $title . "', '" . $city . "', 1, " . $latitude . ", " . $longitude . ", 0);";
    ExecuteSQL($sql);

    return GetSingleValueDB("SELECT Id FROM Event WHERE Event = '" . $title . "' AND City = '" . $city . "' AND latitude = " . $latitude . " AND longitude = " . $longitude . ";", "Id");
}

function GetEvent($event){
    $sql = "SELECT Id, Event, City, URL, latitude, longitude FROM Event WHERE Id = '" . $event . "';";
    return ExecuteSQLArray($sql);
}

function GetCity($event){
    $sql = "SELECT City FROM Event WHERE Id = '" . $event . "';";
    return GetSingleValueDB($sql, "City");
}

function GetAllPublishes(){
    $sql = "SELECT IFNULL(u.EmailAddress, 'Anonymous') as User, p.TripPublishId, p.UserId, p.TripId, p.SentTo, p.PublishType, p.DateSent FROM TripPublish p
            LEFT JOIN users u ON p.UserId = u.UserId ORDER BY DateSent DESC;";
    return ExecuteSQLArray($sql);
}

function GetPastTrips($userid, $event){
    
    if(!isset($userid) || $userid == "" || $userid == 0){
        return null;
    }
    else {
        //user logged in. Return trips
        $sql = "SELECT TripId, Created FROM Trip WHERE UserID = " . $userid . " AND Event = '" .$event . "';";
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
        return GetSingleValueDB("SELECT TripId FROM Trip WHERE UserID = " . $userid . ";", "TripId");
    }
}

function CreateTrip($userid, $event){

    if(!isset($userid) || $userid == "" || $userid == 0){
        //no user is logged in. Create empty array object and return arbitrary SessionStart placeholder
        $_SESSION["eventTimes"] = [];
        return "SessionStart";
    } else {
        ExecuteSQL("INSERT INTO Trip (UserId, Event, Created) VALUES (" . $userid . ", '" . $event . "', NOW());");
        return GetTrip($userid, $event);
    }

}

function GetEvents($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }
    if($trip == "SessionStart"){
        //session. return session events
        return $_SESSION["eventTimes"];
    } else {
        return ExecuteSQLArray("SELECT GateNumber, FieldNumber, DayOfWeek, Time FROM TripEvent WHERE TripId = " . $trip . ";");
    }
}

function ConvertEvents($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0 || $trip == "SessionStart"){
        //no trip
        return null;
    } else {
        $events = $_SESSION["eventTimes"];
        foreach ($events as $i => $event) {
            $gate = $event["GateNumber"];
            $field = $event["FieldNumber"];
            $dayOfWeek = $event["DayOfWeek"];
            //logged in user. Add to db.
            if($gameTime == ""){
                $gameTime = "NULL";
            } else {
                $gameTime = "'" . $gameTime . "'";
            }
            $addgame = "INSERT INTO TripEvent(TripId, GateNumber, FieldNumber, DayOfWeek) VALUES (" . $trip . ", " . $gameTime . ", '" . $gate . "', '" . $field . "', '" . $dayOfWeek . "');";
            ExecuteSQL($addgame);
        }
    }   
}

function DeleteEvents($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }
    if($trip == "SessionStart"){
        //session. delete session events
        $_SESSION["eventTimes"] = [];
    } else {
        ExecuteSQL("DELETE FROM TripEvent WHERE TripId = " . $trip . ";");
    }
}

function CreateEvents($trip, $daysOfWeek, $times, $gates, $fields){
    
    $isSession = true;
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        $trip = CreateTrip($userid, '');
    }
    
    $isSession = $trip == "SessionStart";
        
    foreach ($daysOfWeek as $i => $dayOfWeek) {
        $time = $times[$i] ?? "";
        $gate = $gates[$i] ?? "";
        $field = $fields[$i] ?? "";
        if($isSession){
            //session only. Add the item to the session events
            $_SESSION["eventTimes"][] = ["DayOfWeek" => $dayOfWeek, "Time" => $time, "GateNumber" => $gate, "FieldNumber" => $field];
        } else {
            //logged in user. Add to db.
            $addgame = "INSERT INTO TripEvent(TripId, DayOfWeek, Time, GateNumber, FieldNumber) VALUES (" . $trip . ", '" . $dayOfWeek . "', '" . $time . "', '" . $gate . "', '" . $field . "');";
            ExecuteSQL($addgame);
        }
    }   

}


function GetAllActivities($trip){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }
    if($trip == "SessionStart"){
        //session. return session events
        return $_SESSION["itineraryTimes"];
    } else {
        return ExecuteSQLArray("SELECT TripItineraryId, Time, Address, Title, latitude, longitude, DayOfWeek, LodgeDistance, EventDistance, City, ActivityType FROM TripItinerary WHERE TripId = " . $trip . ";");
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
            $dayOfWeek = $activity["DayOfWeek"];
            $time = $activity["Time"];
            $latitude = $activity["latitude"];
            $longitude = $activity["longitude"];
            $lodgeDistance = $activity["LodgeDistance"];
            $eventDistance = $activity["EventDistance"];
            //logged in user. Add to db.
            $addActivity = "INSERT INTO TripItinerary(TripId, Title, Address, ActivityType, DayOfWeek, Time, latitude, longitude, LodgeDistance, EventDistance) VALUES (" . $trip . ", '" . $title . "', '" . $address . "', '" . $types . "', '" . $dayOfWeek . "', '" . $time . "', " . $latitude . ", " . $longitude . ", " . $lodgeDistance . ", " . $eventDistance . ");";
            ExecuteSQL($addActivity);
        }
    }   
}

function GetAllActivitiesForDay($trip, $day){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }

    if($trip == "SessionStart"){
        //session. return session events
        return FilterArray($_SESSION["itineraryTimes"], "DayOfWeek", $day);
    } else {
        return ExecuteSQLArray("SELECT Time, ActivityType, DayOfWeek, Address, Title, latitude, longitude, LodgeDistance, EventDistance, City FROM TripItinerary WHERE TripId = " . $trip . " AND DayOfWeek = '" . $day . "';");
    }
}

function GetActivitiesForDay($trip, $types, $day){
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }

    if($trip == "SessionStart"){
        //session. return session events
        return FilterArray(FilterArray($_SESSION["itineraryTimes"], "ActivityType", $types), "DayOfWeek", $day);
    } else {
        return ExecuteSQLArray("SELECT Time, DayOfWeek, ActivityType, Address, Title, latitude, longitude, LodgeDistance, EventDistance, City FROM TripItinerary WHERE TripId = " . $trip . " AND ActivityType = '" . $types . "' AND DayOfWeek = '" . $day . "';");
    }
}

function GetActivities($trip, $types){

    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }

    if($trip == "SessionStart"){
        //session. return session events
        return FilterArray($_SESSION["itineraryTimes"], "ActivityType", $types);
    } else {
        return ExecuteSQLArray("SELECT Time, Address, Title, latitude, longitude, LodgeDistance, EventDistance, City, ActivityType FROM TripItinerary WHERE TripId = " . $trip . " AND ActivityType = '" . $types . "';");
    }
}

function UpdateActivities($activityIds, $daysOfWeek, $times, $activityAddresses){
    foreach ($activityIds as $i => $activityId) {
        UpdateActivity($activityId, $daysOfWeek[$i], $times[$i], $activityAddresses[$i]);
    }
}

function UpdateActivity($activityId, $dayOfWeek, $time, $activityAddress){

    if(is_null($activityId) || !isset($activityId) || $activityId == "" || $activityId == 0){
        foreach ($_SESSION["itineraryTimes"] as &$entry) {
            if ($entry["Address"] === $activityAddress) {
                $entry["DayOfWeek"] = $dayOfWeek;
                $entry["Time"] = $time;
                break; // Stop loop after finding the match
            }
        }
    } else {
        $updateActivity = "UPDATE TripItinerary SET DayOfWeek = '" . $dayOfWeek . "', Time = '" . $time . "' WHERE TripItineraryId = " . $activityId;
        ExecuteSQL($updateActivity);
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
        if(strcasecmp($item[$field],$value) != 0){
            array_push($returnArray, $item);
        }
    }

    return $returnArray;
}


function ExcludeArrayTwo($array, $field, $value, $field2, $value2){
    $returnArray = [];

    foreach($array as $item){
        if(strcasecmp($item[$field],$value) != 0 || strcasecmp($item[$field2],$value2) != 0){
            array_push($returnArray, $item);
        }
    }

    return $returnArray;
}

function DeleteItinerary($trip, $activityType, $day){
    
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
	$trip = CreateTrip($userid, '');
    }
    if($trip == "SessionStart"){
        //session. delete session itinerary
        $_SESSION["itineraryTimes"] = ExcludeArray($_SESSION["itineraryTimes"], "DayOfWeek", $day);
    } else {
        ExecuteSQL("DELETE FROM TripItinerary WHERE TripId = " . $trip . " AND ActivityType = '" . $activityType . "' AND DayOfWeek = '" . $day . "';");
    }
}

function CreateItinerary($trip, $titles, $addresses, $types, $latitudes, $longitudes, $cities, $lodgeDistances, $eventDistances, $dayOfWeek){

    $isSession = true;
    if(is_null($trip) || !isset($trip) || $trip == "" || $trip == 0){
        $trip = CreateTrip($userid, '');
    }
    
    $isSession = $trip == "SessionStart";
        
    foreach ($titles as $i => $title) {
        $address = $addresses[$i];
        $latitude = $latitudes[$i];
        $longitude = $longitudes[$i];
        $city = $cities[$i];
        $lodgeDistance = $lodgeDistances[$i];
        $eventDistance = $eventDistances[$i];
        $type = $types[$i]; 
        if($isSession){
            //session only. Add the item to the session events
            $_SESSION["itineraryTimes"][] = ["Title" => $title, "ActivityType" => $type, "Address" => $address, "latitude" => $latitude, "longitude" => $longitude, "LodgeDistance" => $lodgeDistance, "EventDistance" => $eventDistance, "DayOfWeek" => $dayOfWeek, "City" => $city];
        } else {
            //logged in user. Add to db.
            $addActivity = "INSERT INTO TripItinerary(TripId, Title, Address, ActivityType, latitude, longitude, LodgeDistance, EventDistance, DayOfWeek, City) VALUES (" . $trip . ", '" . $title . "', '" . $address . "', '" . $types . "', '" . $latitude . "', '" . $longitude . "', " . $lodgeDistance . ", " . $eventDistance . ", '" . $dayOfWeek . "', '" . $city . "');";
            ExecuteSQL($addActivity);
        }
    }   


}

function GetLodging($trip){
    $lodging = GetActivities($trip, "lodging") ?? [];
    if(count($lodging) > 0){
        return  $lodging;
    }
    $lodging = GetActivities($trip, "str") ?? [];
    if(count($lodging) > 0){
        return  $lodging;
    }
    return GetActivities($trip, "campground") ?? [];
}

function AuditTripSend($userId, $tripId, $email, $message, $type){
    if(is_null($userId)){
        $userId = 0; // Default to 0 if userId is not set
    }
    if($tripId == "SessionStart"){
        $tripId = 0; // Default to 0 if tripId is not set
    }

    $sql = "INSERT INTO TripPublish (UserId, TripId, SentTo, PublishType, DateSent) VALUES (" . $userId . ", " . $tripId . ", '" . $email . "', '" . $type . "', NOW());";
    ExecuteSQL($sql);

}

?>

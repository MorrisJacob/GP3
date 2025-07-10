<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event = $_POST["event"];
    $day = $_POST["day"];
    $title = $_POST["title"];
    $city = $_POST["city"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    if($event == -1){
        $event = CreateEventLocation($title, $city, $latitude, $longitude);
    }

    echo '<script type="text/javascript">window.location = "lodging.php?event=' . $event . '&day=' . $day . '";</script>';
} else{

    $event = $_GET["event"];
    $day = $_GET["day"];

    $city = GetCity($event);
    $trip = GetTrip($userid, $event);
    $lodging = GetLodging($trip);
    $events = GetEventLocations();

    $event_rows = "";

    foreach($events as $eventrow){

        $event_rows .= <<<END
            <input type="radio" name="event" class="rdevent" data-event="{$eventrow["Id"]}" /><a href="{$eventrow["URL"]}" target="_blank"><span class="event-item city-{$eventrow["City"]}" data-event="{$eventrow["Id"]}">{$eventrow["Event"]}</span></a><br/>
        END;

    }

    $eventActive = "";
    $itineraryActive = "";
    $finDisabled = "disabled";
    $eventActive = "active city-" . $city;
    if(count($lodging) > 0){
        $itineraryActive = "active city-" . $city;
        $finDisabled = "";
        $activeButton = "background-" . $city;
    } else {
        $dayDisabled = "disabled";
    }
}

?>

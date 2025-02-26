<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $gameTimes = $_POST['gametime'];   
    $gates = $_POST['gate'];
    $fields = $_POST['field'];
    $event = GetSafeString($_POST['event']);

    // Attempt to get Trip. If none exists, create trip.
    $trip = GetTrip($userid, $event);

    if(is_null($trip) or $trip == "" or $trip == 0){
        $trip = CreateTrip($userid, $event);
    }

    //Delete all of the previous game times
    DeleteEvents($trip);

    //Add all new game times
    CreateEvents($trip, $gameTimes, $gates, $fields);

    echo '<script type="text/javascript">window.location = "city.php?city=' . $event . '";</script>   ';
} else {

    $event = GetSafeString($_GET['city']);
    $gametime_rows = "";

    //Get current trip events
    $trip = GetTrip($userid, $event);

    if(!is_null($trip) and $trip != "" and $trip != 0){
        //Trip exists. Get Events
        $trip_events = GetEvents($trip);
        
        if (!is_null($trip_events) && count($trip_events) > 0) {
            // output data of each row
            foreach($trip_events as $row) {

                $optionA = $row["GateNumber"] == "A" ? "selected" : "";
                $optionB = $row["GateNumber"] == "B" ? "selected" : "";
                $optionC = $row["GateNumber"] == "C" ? "selected" : "";


                $field1 = $row["FieldNumber"] == "1" ? "selected" : "";
                $field2 = $row["FieldNumber"] == "2" ? "selected" : "";
                $field3 = $row["FieldNumber"] == "3" ? "selected" : "";

                $gametime_rows .= <<<END
                      <div class="row text-center gametime-row">                                                                                                                                                                                                                        
                         <div class="span3">
                         <input type="datetime-local" class="form-control" name="gametime[]" value='{$row["GameTime"]}' />
                         </div>
                         <div class="span3">
                         <select class="form-control" name="gate[]">
                             <option {$optionA}>A</option>
                             <option {$optionB}>B</option>
                             <option {$optionC}>C</option>
                         </select>
                         </div>
                         <div class="span3">
                         <select class="form-control" name="field[]">
                             <option {$field1}>1</option>
                             <option {$field2}>2</option>
                             <option {$field3}>3</option>
                         </select>
                         </div>
                         <div class="span3">
                         <input type="button" value="X" class="btn btn-danger delete-row" />
                         </div>
                     </div>
                END;

            }

        } 
    }

    if($gametime_rows == ""){
        $gametime_rows = <<<END
              <div class="row text-center gametime-row">                                                                                                                                                                                                                        
                 <div class="span3">
                 <input type="datetime-local" class="form-control" name="gametime[]" />
                 </div>
                 <div class="span3">
                 <select class="form-control" name="gate[]">
                     <option>A</option>
                     <option>B</option>
                     <option>C</option>
                 </select>
                 </div>
                 <div class="span3">
                 <select class="form-control" name="field[]">
                     <option>1</option>
                     <option>2</option>
                     <option>3</option>
                 </select>
                 </div>
                 <div class="span3">
                 <input type="button" value="X" class="btn btn-danger delete-row" />
                 </div>
             </div>
        END;
    }
}

?>

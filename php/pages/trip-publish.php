<?php


if($admin != "" and !is_null($admin)){
    $publishes = GetAllPublishes();
    $publish_rows = "";
    if (!is_null($publishes) && count($publishes) > 0) {
            // output data of each row
            foreach($publishes as $row) {
                    $publish_rows .= <<<END
                        <div class="row text-center">
                            <div class="span3">
                                {$row["User"]}
                            </div>
                            <div class="span3">
                                {$row["PublishType"]}
                            </div>
                            <div class="span3">
                                {$row["SentTo"]}
                            </div>
                            <div class="span3">
                                {$row["DateSent"]}
                            </div>
                        </div>
                    END;
            }

        } 
}
?>

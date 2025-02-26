<?php

$rental_rows = "";

//Get STRs
$shortTerms = ExecuteSQLArray("SELECT id, name, address FROM ShortTermRentals");
if(!is_null($shortTerms) && count($shortTerms) > 0){
    foreach($shortTerms as $row){
        $rental_rows .= <<<END
                  <div class="row text-center" style="margin-bottom:10px;"> 
                     <div class="span12">
                         <h4 style='display:inline;'><a href="add-str.php?id={$row["id"]}">{$row["name"]} ({$row["address"]})</a></h4>&nbsp;&nbsp;<a href="php/actions/delete-str.php?id={$row["id"]}"><input type="button" class="btn btn-danger" value="X" /></a>
                     </div>
                 </div>
        END;
    }
}

?>

<?php include('master/header.php'); ?>
<?php include('php/pages/trip-publish.php'); ?>

<div>
    <div class="row text-center">
        <div class="span12">
        <h2>Publish History</h2>
        </div>
    </div>
    <br/>
    <div class="row text-center" style="font-weight: bold;font-size:14pt;"> 
         <div class="span3">
            User 
         </div>
         <div class="span3">
            Type
         </div>
         <div class="span3">
            Sent To
         </div>
         <div class="span3">
            Date Sent
         </div>
    </div>
    <?php echo $publish_rows; ?>
    <br/>

</div>
<?php include('master/footer.php'); ?>


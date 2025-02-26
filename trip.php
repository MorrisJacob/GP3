<?php include('master/header.php'); ?>
<?php include('php/controls/cities.php'); ?>
<?php include('php/pages/trip.php'); ?>
<div class="row text-center">
    <div class="span12">
	<h3>Manage Your Trip Event</h3>
    </div>
</div>
<br/>
<div class="row text-center">
    <div class="span3">
	Event Day/Time
    </div>
    <div class="span3">
	Gate
    </div>
    <div class="span3">
	Field
    </div>
    <div class="span3">
	Actions
    </div>
</div>
<br/>
<form action="trip.php?city=<?php echo $event; ?>" method="POST">
    <input type="hidden" name="event" value="<?php echo $event; ?>" />
    <div id="gametimes">
        <?php echo $gametime_rows; ?>
    </div>
    <br/>
    <div class="row">
        <div class="span3">
        </div>
        <div class="span3">
            <input type="button" value="+" class="btn btn-success add-row" />
        </div>
    </div>
    <br/>
    <br/>
    <div class="row text-center">
        <div class="span12">
            <input type="submit" value="Finished" class="btn btn-success" />
        </div>
    </div>
</div>
<script type="text/javascript" src="js/trip.js"></script>
<?php include('master/footer.php'); ?>


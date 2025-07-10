<?php
include('master/header.php');
include('php/pages/add-str.php');
?>
<div id="map" style="display:none;"></div>
<form action="add-str.php" method="POST" class="form-horizontal">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	<div class="container" style="border:1px solid gray;padding:25px;">
	    <div class="row row-marg">
		<div class="span12" style="text-align:center;">
		    <h2>Add a Short-Term Rental</h2>
		</div>
	    </div>
	    <div class="span5">
	    </div>
	    <div class="span6 col-xs-12 col-sm-6">
		<div class="row row-marg">
            <input id='latitude' type="hidden" name="Latitude" value="<?php echo $latitude; ?>" />
            <input id='longitude' type="hidden" name="Longitude" value="<?php echo $longitude; ?>" />
            <div class="row row-marg">
				<div class="span12">
				    Name:
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
				</div>
            </div>
            <div class="row row-marg">
				<div class="span12">
				    Address:
				</div>
				<div class="span12">
				    <input type="text" id='txtAddress' class="form-control" name="address" value="<?php echo $address; ?>" />
				</div>
            </div>
            <div class="row row-marg">
				<div class="span12">
                    Occupancy:
				</div>
				<div class="span12">
				    <input type="number" class="form-control" name="occupancy" value="<?php echo $occupancy; ?>" />
				</div>
            </div>
            <div class="row row-marg">
				<div class="span12">
                    Number of Rooms:
				</div>
				<div class="span12">
				    <input type="number" class="form-control" name="numberOfRooms" value="<?php echo $numberOfRooms; ?>" />
				</div>
            </div>
            <div class="row row-marg">
				<div class="span12">
				    Phone Number:
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" />
				</div>
            </div>
			<div class="row row-marg">
				<div class="span12">
				    Short-Term Rental URL: 
				</div>
				<div class="span12">
				    <input type="text" class="form-control" name="url" value="<?php echo $url; ?>" />
				</div>
            </div>
			<div class="row row-marg">
				<div class="span12">
				    <input type="submit" class="btn btn-success" />
				</div>
            </div>
		</div>
	    </div>
	</div>
</form>
<style>
.row-marg{
    margin-bottom:10px;
}
</style>
<script src="js/add-str.js"></script>
<?php include('master/footer.php'); ?>

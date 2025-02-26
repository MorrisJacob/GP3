<?php include('master/header.php'); ?>
<?php include('php/pages/short-term-rentals.php'); ?>

<div class="row text-center">
    <div class="span12">
        <h2>Select a Short-Term Rental</h2>
    </div>
</div>
<br/>
<?php echo $rental_rows; ?>
<br/>
<div class="row text-center">
    <div class="span12">
        <a href="add-str.php">Add A New Rental <input type="button" class="btn btn-success" value="+" /></a>
    </div>
</div>

<?php include('master/footer.php'); ?>

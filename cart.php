<?php include('master/header.php'); ?>
<?php include('php/controls/cities.php'); ?>
<?php include('php/pages/cart.php'); ?>

<?php if($event != "") { ?>
<form action="cart.php?city=<?php echo $event ; ?>" method="POST" id="emailForm">
    <input type="hidden" name="event" value="<?php echo $event; ?>" />
    <div class="row text-center">
        <div class="span12">
        <h2>Trip Itinerary</h2>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="span12 text-center">
            <h3>Main Event</h3>
        </div>
    </div>
    <br/>
    <div class="row text-center" style="font-weight: bold;font-size:14pt;"> 
         <div class="span4">
            Date/Time
         </div>
         <div class="span4">
            Gate
         </div>
         <div class="span4">
            Field
         </div>
    </div>
    <?php echo $gametime_rows; ?>
    <br/>
    <div class="row">
        <div class="span12 text-center">
            <h3>Trip Activities/Lodging</h3>
        </div>
    </div>
    <br/>
    <div class="row text-center" style="font-weight: bold;font-size:14pt;"> 
         <div class="span4">
            Date/Time
         </div>
         <div class="span4">
            Title
         </div>
         <div class="span4">
            Address
         </div>
    </div>
    <?php echo $itinerary_rows; ?>
    <br/>
    <div class="row text-center">
        <div class="span3">
        </div>
        <div class="span3">
            <a href="city.php?city=<?php echo $event; ?>"><input type="button" value="<< Adjust Activities" class="btn" /></a>
        </div>
        <div class="span3">
            <input type="button" value="Publish" class="btn btn-success" data-toggle="modal" data-target="#PublishModal" />
        </div>
    </div>


<div class="modal fade" id="PublishModal" tabindex="-1" role="dialog" aria-labelledby="PublishTripTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PublishTripTitle">Publish Your Trip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Publish your trip! Please enter the email addresses for this trip:
        <div>
          <input
            type="text"
            id="emailInput"
            class="form-control"
            placeholder="Enter email and press Enter"
          />
        </div>
          <div class="pill-container" id="pillContainer"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" id="btnPublish">Publish This Trip</button>
      </div>
    </div>
  </div>
</div>

<script>
    const emailInput = document.getElementById("emailInput");
    const pillContainer = document.getElementById("pillContainer");
    const emailForm = document.getElementById("emailForm");

    // Add pill on Enter
    emailInput.addEventListener("keydown", (event) => {
      if (event.key === "Enter") {
        event.preventDefault();
        const email = emailInput.value.trim();
        if (email && validateEmail(email)) {
          addPill(email);
          emailInput.value = "";
        } else if (email) {
          alert("Please enter a valid email address or phone number.");
        }
      }
    });

    // Validate emails or phone numbers
    function validateEmail(email) {
      const regex = /^(?:[^\s@]+@[^\s@]+\.[^\s@]+|\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4})$/;
      return regex.test(email);
    }

    // Add pill and hidden input
    function addPill(email) {
      // Create the pill
      const pill = document.createElement("span");
      pill.className = "badge bg-primary";
      pill.innerText = email;
      pill.title = "Click to remove";

      // Create the hidden input
      const hiddenInput = document.createElement("input");
      hiddenInput.type = "hidden";
      hiddenInput.name = "emails[]";
      hiddenInput.value = email;

      // Append the pill and hidden input to the container
      const wrapper = document.createElement("div");
      wrapper.className = "d-inline-block";
      wrapper.appendChild(pill);
      wrapper.appendChild(hiddenInput);
      pillContainer.appendChild(wrapper);

      // Remove pill and hidden input on click
      pill.addEventListener("click", () => {
        wrapper.remove();
      });
    }
</script>

</form>

<?php } else { ?>
    <div class="row">
        <div class="span12 text-center">
            Pick a City
        </div>
    </div>
    <br/>
    <div class="row" style="font-size:16pt;">
        <div class="span1">
        </div>
        <div class="span2 text-center">
            <a href="cart.php?city=westfield">Westfield</a>
        </div>
        <div class="span2 text-center">
            <a href="cart.php?city=carmel">Carmel</a>
        </div>
        <div class="span2 text-center">
            <a href="cart.php?city=noblesville">Noblesville</a>
        </div>
        <div class="span2 text-center">
            <a href="cart.php?city=fishers">Fishers</a>
        </div>
        <div class="span2 text-center">
            <a href="cart.php?city=sheridan">Sheridan</a>
        </div>
    </div>
<?php } ?>
<?php include('master/footer.php'); ?>


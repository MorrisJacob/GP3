$(function(){
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
    $(document).on('click', '.delete-row', function(){
        $(this).parents('.gametime-row').remove();
    });
    $(document).on('click', '.add-row', function(){

        let row = `<div class="row text-center gametime-row row-data">
                    <div class="span3">
                        ${$('.gameday').html()}
                    </div>
                    <div class="span2">
                        ${$('.gametime').html()}
                    </div>
                    ${showGate
                        ? `
                        <div class="span2">
                            ${$('.gamegate').html()}
                        </div>
                        `
                        : ''}

                    ${showField
                        ? `
                        <div class="span2">
                            ${$('.gamefield').html()}
                        </div>
                        `
                        : ''}
                    <div class="span2">
                        <input type="button" value="X" class="btn btn-danger delete-row" />
                    </div>
                </div>`;

        $('#gametimes').append(row);
    });
    $("form").submit(function() {
       $("#template").remove();
    });
    $('#savesend').click(function(e){
        $('.all-days').click();
        let valid = true;
        $('.require-check').each(function(){
            // If the input is empty and it's not the template, it is required
            if($(this).val() == '' && !$(this).closest('#template').length){
                valid = false;
                $(this).addClass('custom-required');
            }else{
                $(this).removeClass('custom-required');
            }
        });
        if(!valid){
            e.preventDefault();
            return;
        }   
        $('#PublishModal').modal('show');
    });

    $('select').change(function(){
        if($(this).val() != ''){
            $(this).removeClass('custom-required');
        }
    });

    $('.day').on('click', function(){
        $('.day').removeClass('day-selected');
        $(this).addClass('day-selected');
        let day = $(this).text();
        $('.day-select').each(function(){
            //If the input is the value of the day clicked, show it. Otherwise hide it by hiding the div it's in with the row class
            if($(this).val() == day || day == "All"){
                $(this).closest('.row').show();
            } else {
                $(this).closest('.row').hide();
            }
        });
    });

        // Function to get URL parameter
    function getUrlParameter(name) {
        const params = new URLSearchParams(window.location.search);
        return params.get(name);
    }

    const dayParam = getUrlParameter('day');
    if (dayParam) {
        // Loop through each element with class "day"
        $('.day').each(function () {
            const elementText = $(this).text().trim();
            if (elementText.toLowerCase() === dayParam.toLowerCase()) {
                $(this).click(); // Trigger the click
                return false; // Exit loop after first match
            }
        });
    }

    $('.select-event').on('click', function(){
        let selEvent = getUrlParameter('event');
        let day = getUrlParameter('day');
        window.location.href = "city.php?event="+selEvent+"&day="+day;
    });
    $('.select-lodging').on('click', function(){
        let selEvent = getUrlParameter('event');
        let day = getUrlParameter('day');
        window.location.href = "lodging.php?event="+selEvent+"&day="+day;
    });
    $('.select-itinerary').on('click', function(){
        let selEvent = getUrlParameter('event');
        let day = getUrlParameter('day');
        window.location.href = "activities.php?event="+selEvent+"&day="+day;
    });
});

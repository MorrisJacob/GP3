$('.city-select').on('click', function(){
    //deselect all cities
    $('.city-selected').removeClass('city-selected');
    //select this city
    $(this).addClass('city-selected');
    //hide all city facts and distances
    $('.city-facts').hide();
    $('.city-distance').hide();
    //get city name and show info for this city in particular
    let city = $(this).text().toLowerCase();
    $('.' + city).show();
});
//Start by showing first city
$(document).ready(function(){
    $('.city-select').first().click();
});

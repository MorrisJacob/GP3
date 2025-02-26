function selectCity(){
    let urlParams = new URLSearchParams(window.location.search);
    let city = urlParams.get('city');
    if(city != null){
	$('.city-' + city).addClass('selected');
	$('.city-' + city).find('a').addClass('selected');
    }
}

$(document).ready(function() {
    selectCity();
});


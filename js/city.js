var queryString = "";
var urlParams;
var day;
var selEvent;
$(function(){
    UpdateSearchParams();

    if(day){
        $("#" + day).prop("checked", true);
    } else{
        //default monday
        $("#monday").prop("checked", true);
        let url = "";
        UpdateURL("monday");
    }

	$('.trip-item.active').on('click', function(){

		if($(this).text() == "Events"){
			window.location.href = 'trip.php?event=' + selEvent + '&day=' + day;
		}else {
			window.location.href = 'itinerary.php?event=' + selEvent + '&types=' + this.dataset.types + '&day=' + urlParams.get('day');
		}
	});
	$('#btnDayFinalize').on('click', function(){
			window.location.href = 'cart.php?event=' + selEvent + '&day=' + day;
	});
	$('#btnTripFinalize').on('click', function(){
			window.location.href = 'cart.php?event=' + selEvent;
	});
	$('#btnClearCity').on('click', function(){
			window.location.href = 'php/actions/clearcity.php?event=' + selEvent;
	});
    $('input[name="days"]').on('click', function(){
        UpdateURL(this.id);
    });

    $('.event-item').each(function(){
        if($(this).data('event') == selEvent){
            $(this).addClass('active');
        }
    });

    $('.rdevent').each(function(){
        if($(this).data('event') == selEvent){
            $(this).prop('checked', true);
        }
    });

    $('.rdevent').on('click', function(){
        window.location.href = "city.php?event="+$(this).data('event')+"&day="+day;
    });

    $('.select-event').on('click', function(){
        window.location.href = "city.php?event="+selEvent+"&day="+day;
    });
    $('.select-lodging').on('click', function(){
        window.location.href = "lodging.php?event="+selEvent+"&day="+day;
    });
});

function UpdateURL(day){
    let url = "";
    if(document.location.href.includes('day')){
        url = document.location.href.replace(/day=[a-z]*/g, "day="+day);
    } else {
        if(document.location.href.includes('?')) {
            url = document.location.href+"&day="+day;
        }else{
            url = document.location.href+"?day="+day;
        }
    }
    history.pushState(null, "", url); // Changes the URL without reloading
    UpdateSearchParams();
}

function UpdateSearchParams(){
    queryString = window.location.search;
    urlParams = new URLSearchParams(queryString);
    day = urlParams.get('day').toLowerCase();
    selEvent = urlParams.get('event');
}

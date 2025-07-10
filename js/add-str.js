(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyD-BpsOnSX8GYvILi_StiKxKb2mVkIH93I", v: "weekly"});

$(function(){
    var latitude;
    var longitude
    let map;

    async function initMap() {
      const { Map } = await google.maps.importLibrary("maps");

      map = new Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
      });

    }

    $('body').on('change', '#txtAddress', function() {
        $('#latitude').val('');
        $('#longitude').val('');
        var geocoder = new google.maps.Geocoder();
        var address = $('#txtAddress').val();

        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $('#latitude').val(results[0].geometry.location.lat());
                $('#longitude').val(results[0].geometry.location.lng());
           } 
        });
    });

    initMap();

    $('form').submit(function (evt) {
        if($('#latitude').val() == '' || $('#longitude').val() == '' || $('#latitude').val() == '0' || $('#longitude').val() == '0') {
            alert('Invalid Address! Please try again');
            evt.preventDefault();
        }
    });
});

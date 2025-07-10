(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyD-BpsOnSX8GYvILi_StiKxKb2mVkIH93I", v: "weekly"});

$(function(){
    // Initialize and add the map
    let map;
    var forcePosition = false;
    const MARKER_PATH = "https://developers.google.com/maps/documentation/javascript/images/marker_green";
    let markers = [];
    let LODGING = ['lodging','str','campground'];
    let infoWindow;
    let placesArr = [];
    const hostnameRegexp = new RegExp("^https?://.+?/");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);


    function createInfoWindowContent() {
      const span = document.createElement("span");
      span.innerHTML = document.getElementById("info-content").innerHTML;
      return span;
    }

    function GetCityPosition() {
        let citiesLocations = new Map();
        citiesLocations.set('westfield', { lat: 40.0610, lng: -86.1518});
        citiesLocations.set('carmel',  { lat: 39.978371, lng: -86.118042});
        citiesLocations.set('noblesville', { lat: 40.026089, lng: -85.938622});
        citiesLocations.set('fishers', { lat: 39.991513, lng: -86.007557});
        citiesLocations.set('sheridan', { lat: 40.129410, lng: -86.213060});
        citiesLocations.set('indianapolis', { lat: 39.7684, lng: -86.1581});
        let city = $('#city').val();
        return citiesLocations.get(city.toLowerCase());
    }

    function GetPosition() {
        return GetCityPosition();
    }

    async function initMap() {

      GetLocations();
      $('#results').empty();
      const position = GetPosition();
      // Request needed libraries.
      const { Map } = await google.maps.importLibrary("maps");
      const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
      const {Place} = await google.maps.importLibrary("places");

      map = new Map(document.getElementById("map"), {
        zoom: 12,
        center: position,
        mapId: "DEMO_MAP_ID",
        streetViewControl: false, //Gets in the way on phones
      });

      infoWindow = new google.maps.InfoWindow({
        content: createInfoWindowContent(),
      });

      // The marker, positioned at Uluru
      const marker = new AdvancedMarkerElement({
        map: map,
        position: position,
        title: "Grand Park",
      });

      places = new google.maps.places.PlacesService(map);
    
      setTimeout(function(){ search(); }, 500);
    }

    initMap();

    function search() {
      let types = $('#type').val();
      if(types==null || types == "" || types == "undefined"){
        return;
      }   
      const search = {
        bounds: map.getBounds(),
        types: types.split(','),
      };

          places.nearbySearch(search, (results, status, pagination) => {
            if (status === google.maps.places.PlacesServiceStatus.OK && results) {
              // Create a marker for each hotel found, and
              // assign a letter of the alphabetic to each marker icon.
              for (let i = 0; i < results.length; i++) {
                const markerLetter = String.fromCharCode("A".charCodeAt(0) + (i % 26));
                const markerIcon = MARKER_PATH + markerLetter + ".png";

                // Use marker animation to drop the icons incrementally on the map.
                markers[i] = new google.maps.Marker({
                  position: results[i].geometry.location,
                  animation: google.maps.Animation.DROP,
                  icon: markerIcon,
                });
                // If the user clicks a hotel marker, show the details of that hotel
                // in an info window.
                // @ts-ignore TODO refactor to avoid storing on marker
                markers[i].placeResult = results[i];
                google.maps.event.addListener(markers[i], "click", showInfoWindow);
                setTimeout(dropMarker(i), i * 100);
                addResult(results[i], i);
              }
            }
          });
    }

    // Get the place details for a hotel. Show the information in an info window,
    // anchored on the marker for the hotel that the user selected.
    function showInfoWindow() {
      // @ts-ignore
      const marker = this;

      if(urlParams.get('types') != "str"){
          places.getDetails(
            { placeId: marker.placeResult.place_id },
            (place, status) => {
              if (status !== google.maps.places.PlacesServiceStatus.OK) {
                return;
              }

              infoWindow.open(map, marker);
              buildIWContent(place);
            },
          );
      } else {
        //custom STR. use db data rather than pulling from Google
        infoWindow.open(map, marker);
        buildIWContent(marker.placeResult);
      }

        infoWindow.setContent(createInfoWindowContent()); // <- update content here
        infoWindow.open(map, marker);
    }
    // Load the place information into the HTML elements used by the info window.
    function buildIWContent(place) {
      document.getElementById("iw-icon").innerHTML =
        '<img class="hotelIcon" ' + 'src="' + place.icon + '"/>';
      document.getElementById("iw-url").innerHTML =
        '<b>Click To View:<br/><br/><a href="' + place.url + '" target="_blank"><span id="placename">' + place.name + "</span></a></b>";
      let miles = 0;
      let lodgeMiles = 0;
      document.getElementById("iw-address").textContent = place.vicinity;
      if (place.formatted_phone_number) {
        document.getElementById("iw-phone-row").style.display = "";
        document.getElementById("iw-phone").textContent =
          place.formatted_phone_number;
      } else {
        document.getElementById("iw-phone-row").style.display = "none";
      }

      // Assign a five-star rating to the hotel, using a black star ('&#10029;')
      // to indicate the rating the hotel has earned, and a white star ('&#10025;')
      // for the rating points not achieved.
      if (place.rating) {
        let ratingHtml = "";

        for (let i = 0; i < 5; i++) {
          if (place.rating < i + 0.5) {
            ratingHtml += "&#10025;";
          } else {
            ratingHtml += "&#10029;";
          }

          document.getElementById("iw-rating-row").style.display = "";
          document.getElementById("iw-rating").innerHTML = ratingHtml;
        }
      } else {
        document.getElementById("iw-rating-row").style.display = "none";
      }

      // The regexp isolates the first part of the URL (domain plus subdomain)
      // to give a short URL for displaying in the info window.
      if (place.website) {
        let fullUrl = place.website;
        let website = String(hostnameRegexp.exec(place.website));

        if (!website) {
          website = "http://" + place.website + "/";
          fullUrl = website;
        }

        document.getElementById("iw-website-row").style.display = "";
        document.getElementById("iw-website").textContent = website;
      } else {
        document.getElementById("iw-website-row").style.display = "none";
      }
    }

    function dropMarker(i) {
      return function () {
        markers[i].setMap(map);
      };
    }
    function addResult(result, i) {
      const results = document.getElementById("results");
      const markerLetter = String.fromCharCode("A".charCodeAt(0) + (i % 26));
      const markerIcon = MARKER_PATH + markerLetter + ".png";
      const tr = document.createElement("tr");

      tr.style.backgroundColor = i % 2 === 0 ? "#F0F0F0" : "#FFFFFF";
      tr.onclick = function () {
        google.maps.event.trigger(markers[i], "click");
      };

      const iconTd = document.createElement("td");
      const nameTd = document.createElement("td");
      const visibleTd = document.createElement("td");
      const icon = document.createElement("img");

      icon.src = markerIcon;
      icon.setAttribute("class", "placeIcon");
      icon.setAttribute("className", "placeIcon");

      const name = document.createTextNode(result.name);

      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      checkbox.name = 'visibleLocation';
      checkbox.checked = placesArr.includes(result.place_id);
      checkbox.value = result.place_id;

      iconTd.appendChild(icon);
      nameTd.appendChild(name);
      visibleTd.appendChild(checkbox);
      tr.appendChild(iconTd);
      tr.appendChild(nameTd);
      tr.appendChild(visibleTd);
      results.appendChild(tr);
    }


    $('#city,#type').on('change', function(){
        GetLocations();
        initMap();
    });

    $('#results').on('click', 'input[type="checkbox"]', function() {

        let checked = $(this).is(':checked');
        let placeId = $(this).val();
        let city = $('#city').val();
        let type = $('#type').val();

        $.ajax({
            type: 'GET',
            url: 'php/actions/togglelocation.php',
            data: {
                placeid: placeId,
                visible: +checked,
                type: type,
                city: city
            },
            success: function(response) {
                console.log('Success:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    function GetLocations(){

        let city = $('#city').val();
        let type = $('#type').val();

        $.ajax({
            type: 'GET',
            url: 'php/actions/getlocations.php',
            data: {
                type: type,
                city: city
            },
            success: function(response) {
                placesArr = JSON.parse(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });

    }
});

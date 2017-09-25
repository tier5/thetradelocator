"use strict";
function initMap() {
	var latC = parseFloat(lat);
	var scale = Math.pow(2, parseInt(zoom));
	latC += ((parseInt(document.getElementById('business-map').clientHeight / 4)) / scale);
	var latLng = new google.maps.LatLng(lat, lon);
	var latLngC = new google.maps.LatLng(latC, lon);
	var scrollwheel = 'on' == mapScrollZoom ? true : false;
	var map = new google.maps.Map(document.getElementById('business-map'), {
		zoom: parseInt(zoom),
		scrollwheel : scrollwheel,
		center: latLngC,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});


	var infowindow = new google.maps.InfoWindow();

	var content = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="mapBodyContent">'+
			'<img src="' + businessMap.logo + '" alt="'+businessMap.businessName+' Logo"/>'+
			'<h4>'+businessMap.businessName+'</h4>';

	if (!businessMap.isBusiness) 
		content += '<a href="'+businessMap.businessPermalink+'" class="wyz-button" style="background-color:' + businessMap.categoryColor + ';">'+businessMap.viewDetails+'</a>';
	content += '</div></div>';

	infowindow.setContent(content);

	var marker = new google.maps.Marker({
		position: latLng,
		icon: businessMap.marker,
		map: map,
		info: content,
		anchor: new google.maps.Point(20, 27),
	});

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, this);
	});

	infowindow.open(map, marker);

}
google.maps.event.addDomListener(window, 'load', initMap);

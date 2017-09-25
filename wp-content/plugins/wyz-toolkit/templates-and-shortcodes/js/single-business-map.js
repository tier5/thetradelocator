"use strict";
function initMap() {
	var latC = parseFloat(lat);
	var scale = Math.pow(2, parseInt(zoom));
	//latC += ((parseFloat(document.getElementById('business-map').clientHeight / 2.0)) / scale);
	var latLng = new google.maps.LatLng(lat, lon);
	var latLngC = new google.maps.LatLng(latC, lon);
	var scrollwheel = false;//'on' == mapScrollZoom ? true : false;
	var map = new google.maps.Map(document.getElementById('business-map'), {
		zoom: 12,//parseInt(zoom),
		scrollwheel : scrollwheel,
		center: latLngC,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	businessMap.templateType = parseInt(businessMap.templateType);

	var markerAnchorX;
	var markerAnchorY;
	var markerWidthX;
	var markerWidthY;

	switch ( businessMap.templateType ) {
		case 1:
			markerAnchorX = 20;
			markerAnchorY = 55;
			markerWidthX = 40;
			markerWidthY = 55;
		break;
		case 2:
			markerAnchorX = 0;
			markerAnchorY = 60;
			markerWidthX = 60;
			markerWidthY = 60;
		break;
	}


	var infowindow = new google.maps.InfoWindow();

	var content = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="mapBodyContent">'+
			'<img src="' + businessMap.businesses[0].logo + '" alt="'+businessMap.businesses[0].businessName+' Logo"/>'+
			'<h4>'+businessMap.businesses[0].businessName+'</h4>';

	/*if (!businessMap.isBusiness) 
		content += '<a href="'+businessMap.businessPermalink+'" class="wyz-button" style="background-color:' + businessMap.categoryColor + ';">'+businessMap.viewDetails+'</a>';*/
	content += '</div></div>';

	infowindow.setContent(content);

	var marker = new google.maps.Marker({
		position: latLng,
		map: map,
		info: content,
		icon: {
			url: businessMap.businesses[0].marker,
			size: new google.maps.Size(markerWidthX,markerWidthY),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(markerAnchorX, markerAnchorY),
		},
	});

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, this);
	});

	infowindow.open(map, marker);

}
google.maps.event.addDomListener(window, 'load', initMap);


jQuery(document).ready(function(){
	jQuery('.map-company-info .company-logo').attr( 'href',businessMap.businesses[0].businessPermalink );
	jQuery('.map-company-info #map-company-info-name>a').attr( 'href',businessMap.businesses[0].businessPermalink ).html(businessMap.businesses[0].businessName);
	//jQuery('.map-company-info #map-company-info-desc').html(businessMap.businesses[0].slogan );
	//jQuery('.map-company-info #map-company-info-rating').html(businessMap.businesses[0].ratings );
	//jQuery('.page-map-right-content .search-wrapper').css('background-image','url('+businessMap.businesses[0].banner_image+')');

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: "action=business_map_sidebar_data&nonce=" + ajaxnonce + "&bus_id=" + businessMap.businesses[0].id ,
		success: function(result) {

			result = JSON.parse(result);

			var galleryContainer = jQuery('.page-map-right-content .map-info-gallery');
			jQuery('.page-map-right-content .search-wrapper #map-sidebar-loading').removeClass('loading-spinner');

			for(var i=0;i<result.gallery.length;i++){
				galleryContainer.append( '<li><img src="'+result.gallery.thumb[i]+'" alt=""></li>' );
			}
			if ( result.gallery.length > 0)
				jQuery('.page-map-right-content .map-info-gallery li:last-child').append('<a class="gal-link" href="'+businessMap.businesses[0].businessPermalink+'#'+businessMap.photoLink+'">'+businessMap.viewAll+'</a>');
			jQuery('.map-company-info #map-company-info-desc').html(result.slogan );
			jQuery('.map-company-info #map-company-info-rating').html(result.ratings );
			jQuery('.page-map-right-content .search-wrapper').css('background-image','url('+result.banner_image+')');
		}
	});
});
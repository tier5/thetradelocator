jQuery(document).ready(function() {
	google.maps.event.addDomListener(window, 'load', initMap);

	function initMap() {

		var markerAnchorX;
		var markerAnchorY;
		var markerWidthX;
		var markerWidthY;

		archivesMap.templateType = parseInt(archivesMap.templateType);

		switch ( archivesMap.templateType ) {
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
		
		var latLng = new google.maps.LatLng(parseFloat(archivesMap.defCoor.latitude), parseFloat(archivesMap.defCoor.longitude));

		var options = {
			scrollwheel : false,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoom: parseInt(archivesMap.defCoor.zoom),
			center: latLng,
		};
		map = new google.maps.Map(document.getElementById('home-map'), options);

		var mapCntr = 0;
		var markers = [];
		var infowindow = new google.maps.InfoWindow();
		var bounds = new google.maps.LatLngBounds();
		var content;
		var gpsLen = archivesMap.GPSLocations.length;
		for (var ii = 0; ii<gpsLen; ii++){
			if(''!=archivesMap.GPSLocations[ii].latitude&&''!=archivesMap.GPSLocations[ii].longitude){
			var latlng = new google.maps.LatLng(parseFloat(archivesMap.GPSLocations[ii].latitude), parseFloat(archivesMap.GPSLocations[ii].longitude));
			if ('' !== archivesMap.markersWithIcons[mapCntr]) {

				content = '<div id="content">'+
					'<div style="display:none;">' + archivesMap.businessNames[mapCntr] + '</div>' +
					'<div id="siteNotice">'+
					'</div>'+
					'<div id="mapBodyContent">'+
					('' != archivesMap.businessLogoes[mapCntr] ? archivesMap.businessLogoes[mapCntr] : '<img class="business-logo-marker wp-post-image" src="'+archivesMap.defLogo+'"/>' )
					+'<h4>'+archivesMap.businessNames[mapCntr]+'</h4>'+	
					'<a href="'+archivesMap.businessPermalinks[mapCntr]+'" class="wyz-button" style="background-color:' + archivesMap.businessCategoriesColors[mapCntr] + ';">'+archivesMap.viewDetails+'</a>'+		
					'</div>'+
					'</div>';

				var marker = new google.maps.Marker({
					position: latlng,
					icon: {
						url: archivesMap.markersWithIcons[mapCntr],
						size: new google.maps.Size(markerWidthX,markerWidthY),
						origin: new google.maps.Point(0, 0),
						anchor: new google.maps.Point(markerAnchorX, markerAnchorY),
					},
					animation: google.maps.Animation.DROP,
					info: content,
					category: parseInt(archivesMap.businessCategories[mapCntr]),
					busName: archivesMap.businessNames[mapCntr]
				});

				google.maps.event.addListener(marker, 'click', function() {
					infowindow.setContent(this.info);
					infowindow.open(map, this);
				});

			} else {
				var marker = new google.maps.Marker({
					position: latlng
				});
			}
			if(2 != archivesMap.templateType ){
				marker.setAnimation(google.maps.Animation.DROP);
			}
			markers.push(marker);
			if( marker != undefined ) {
				bounds.extend(marker.position);
				map.fitBounds(bounds);
			}
			}
			
			mapCntr++;
		}

		// all markers set and added to map

		var path = wyz_plg_ref + "templates-and-shortcodes\/images\/";
		var clusterStyles = [{
			textColor: 'grey',
			url: path + "mrkr-clstr-sml.png",
			height: 50,
			width: 50
		}, {
			textColor: 'grey',
			url: path + "mrkr-clstr-mdm.png",
			height: 50,
			width: 50
		}, {
			textColor: 'grey',
			url: path + "mrkr-clstr-lrg.png",
			height: 50,
			width: 50
		}];

		var markerCluster = new MarkerClusterer(map, markers, { styles: clusterStyles });
		setTimeout(function(){map.setZoom(parseInt(archivesMap.defCoor.zoom));}, 1000);
	}
});
(function( $ ) {
	'use strict';

	var maps = [];

	$( '.cmb-type-pw-map' ).each( function() {
		initializeMap( $( this ) );
	});

	function initializeMap( mapInstance ) {
		var searchInput = mapInstance.find( '.pw-map-search' );
		var mapCanvas = mapInstance.find( '.pw-map' );
		var latitude = mapInstance.find( '.pw-map-latitude' );
		var longitude = mapInstance.find( '.pw-map-longitude' );
		var zoom = mapInstance.find( '.pw-map-zoom' );
		var latLng = new google.maps.LatLng( 54.800685, -4.130859 );
		var zoomVal = 5;

		// If we have saved values, let's set the position and zoom level
		if ( latitude.val().length > 0 && longitude.val().length > 0 ) {
			latLng = new google.maps.LatLng( latitude.val(), longitude.val() );
			if(zoom.val().length > 0)
				zoomVal = parseInt(zoom.val());
			else
				zoomVal = 17;
		}
		
		// Map
		var mapOptions = {
			center: latLng,
			zoom: zoomVal
		};
		var map = new google.maps.Map( mapCanvas[0], mapOptions );

		// Marker
		var markerOptions = {
			map: map,
			draggable: true,
			title: 'Drag to set the exact location'
		};
		var marker = new google.maps.Marker( markerOptions );

		if ( latitude.val().length > 0 && longitude.val().length > 0 ) {
			marker.setPosition( latLng );
		}

		// Search
		var autocomplete = new google.maps.places.Autocomplete( searchInput[0] );
		autocomplete.bindTo( 'bounds', map );

		google.maps.event.addListener( autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();
			if ( ! place.geometry ) {
				return;
			}

			if ( place.geometry.viewport ) {
				map.fitBounds( place.geometry.viewport );
			} else {
				map.setCenter( place.geometry.location );
				map.setZoom( 17 );
			}

			marker.setPosition( place.geometry.location );

			latitude.val( place.geometry.location.lat() );
			longitude.val( place.geometry.location.lng() );
			zoomVal = map.getZoom();
			zoom.val( zoomVal );
		});

		$( searchInput ).keypress( function( event ) {
			if ( 13 === event.keyCode ) {
				event.preventDefault();
			}
		});

		// Allow marker to be repositioned
		google.maps.event.addListener( marker, 'drag', function() {
			latitude.val( marker.getPosition().lat() );
			longitude.val( marker.getPosition().lng() );
		});

		google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomVal = map.getZoom();
			zoom.val( zoomVal );
		});
		maps.push( map );
	}

	// Resize map when meta box is opened
	if ( typeof postboxes !== 'undefined' ) {
		postboxes.pbshow = function () {
			var arrayLength = maps.length;
			for (var i = 0; i < arrayLength; i++) {
				var mapCenter = maps[i].getCenter();
				google.maps.event.trigger(maps[i], 'resize');
				maps[i].setCenter(mapCenter);
			}
		};
	}

	// When a new row is added, reinitialize Google Maps
	$( '.cmb-repeatable-group' ).on( 'cmb2_add_row', function( event, newRow ) {
		var groupWrap = $( newRow ).closest( '.cmb-repeatable-group' );
		groupWrap.find( '.cmb-type-pw-map' ).each( function() {
			initializeMap( $( this ) );
		});
	});

})( jQuery );
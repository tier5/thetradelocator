/*
 * Range slider.
 */
!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var t;t="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,t.rangesliderJs=e()}}(function(){return function e(t,n,i){function s(o,a){if(!n[o]){if(!t[o]){var l="function"==typeof require&&require;if(!a&&l)return l(o,!0);if(r)return r(o,!0);var h=new Error("Cannot find module '"+o+"'");throw h.code="MODULE_NOT_FOUND",h}var u=n[o]={exports:{}};t[o][0].call(u.exports,function(e){var n=t[o][1][e];return s(n?n:e)},u,u.exports,e,t,n,i)}return n[o].exports}for(var r="function"==typeof require&&require,o=0;o<i.length;o++)s(i[o]);return s}({1:[function(e,t,n){function i(e,t,n){return n>t?t>e?t:e>n?n:e:n>e?n:e>t?t:e}t.exports=i},{}],2:[function(e,t,n){"use strict";function i(e,t,n){var i=e.getElementById(t);if(i)n(i);else{var s=e.getElementsByTagName("head")[0];i=e.createElement("style"),null!=t&&(i.id=t),n(i),s.appendChild(i)}return i}t.exports=function(e,t,n){var s=t||document;if(s.createStyleSheet){var r=s.createStyleSheet();return r.cssText=e,r.ownerNode}return i(s,n,function(t){t.styleSheet?t.styleSheet.cssText=e:t.innerHTML=e})},t.exports.byUrl=function(e){if(document.createStyleSheet)return document.createStyleSheet(e).ownerNode;var t=document.getElementsByTagName("head")[0],n=document.createElement("link");return n.rel="stylesheet",n.href=e,t.appendChild(n),n}},{}],3:[function(e,t,n){(function(e){function n(){try{var e=new i("cat",{detail:{foo:"bar"}});return"cat"===e.type&&"bar"===e.detail.foo}catch(e){}return!1}var i=e.CustomEvent;t.exports=n()?i:"function"==typeof document.createEvent?function(e,t){var n=document.createEvent("CustomEvent");return t?n.initCustomEvent(e,t.bubbles,t.cancelable,t.detail):n.initCustomEvent(e,!1,!1,void 0),n}:function(e,t){var n=document.createEventObject();return n.type=e,t?(n.bubbles=Boolean(t.bubbles),n.cancelable=Boolean(t.cancelable),n.detail=t.detail):(n.bubbles=!1,n.cancelable=!1,n.detail=void 0),n}}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],4:[function(e,t,n){var i=e("date-now");t.exports=function(e,t,n){function s(){var u=i()-l;t>u&&u>0?r=setTimeout(s,t-u):(r=null,n||(h=e.apply(a,o),r||(a=o=null)))}var r,o,a,l,h;return null==t&&(t=100),function(){a=this,o=arguments,l=i();var u=n&&!r;return r||(r=setTimeout(s,t)),u&&(h=e.apply(a,o),a=o=null),h}}},{"date-now":5}],5:[function(e,t,n){function i(){return(new Date).getTime()}t.exports=Date.now||i},{}],6:[function(e,t,n){"use strict";var i=function(e){return"number"==typeof e&&!isNaN(e)},s=function(e,t){t=t||t.currentTarget;var n=t.getBoundingClientRect(),s=e.originalEvent||e,r=e.touches&&e.touches.length,o=0,a=0;return r?i(e.touches[0].pageX)&&i(e.touches[0].pageY)?(o=e.touches[0].pageX,a=e.touches[0].pageY):i(e.touches[0].clientX)&&i(e.touches[0].clientY)&&(o=s.touches[0].clientX,a=s.touches[0].clientY):i(e.pageX)&&i(e.pageY)?(o=e.pageX,a=e.pageY):e.currentPoint&&i(e.currentPoint.x)&&i(e.currentPoint.y)&&(o=e.currentPoint.x,a=e.currentPoint.y),{x:o-n.left,y:a-n.top}};t.exports=s},{}],7:[function(e,t,n){"use strict";var i=e("number-is-nan");t.exports=Number.isFinite||function(e){return!("number"!=typeof e||i(e)||e===1/0||e===-(1/0))}},{"number-is-nan":8}],8:[function(e,t,n){"use strict";t.exports=Number.isNaN||function(e){return e!==e}},{}],9:[function(e,t,n){function i(e,t){t=t||{},this.element=e,this.options=t,this.onSlideEventsCount=-1,this.isInteracting=!1,this.needTriggerEvents=!1,this.identifier="js-"+l.PLUGIN_NAME+"-"+h++,this.min=a.getFirstNumberLike(t.min,parseFloat(e.getAttribute("min")),0),this.max=a.getFirstNumberLike(t.max,parseFloat(e.getAttribute("max")),l.MAX_SET_BY_DEFAULT),this.value=a.getFirstNumberLike(t.value,parseFloat(e.value),this.min+(this.max-this.min)/2),this.step=a.getFirstNumberLike(t.step,parseFloat(e.getAttribute("step")),l.STEP_SET_BY_DEFAULT),this.percent=null,this._updatePercentFromValue(),this.toFixed=d(this.step),this.range=u(l.RANGE_CLASS),this.range.id=this.identifier,this.fillBg=u(l.FILL_BG_CLASS),this.fill=u(l.FILL_CLASS),this.handle=u(l.HANDLE_CLASS),["fillBg","fill","handle"].forEach(function(e){this.range.appendChild(this[e])},this),["min","max","step"].forEach(function(t){e.setAttribute(t,""+this[t])},this),this._setValue(this.value),a.insertAfter(e,this.range),e.style.position="absolute",e.style.width="1px",e.style.height="1px",e.style.overflow="hidden",e.style.opacity="0",["_update","_handleDown","_handleMove","_handleEnd","_startEventListener","_changeEventListener"].forEach(function(e){this[e]=this[e].bind(this)},this),this._init(),window.addEventListener("resize",r(this._update,l.HANDLE_RESIZE_DEBOUNCE)),l.START_EVENTS.forEach(function(e){this.range.addEventListener(e,this._startEventListener)},this),e.addEventListener("change",this._changeEventListener)}e("./styles/base.css");var s=e("clamp"),r=e("debounce"),o=e("ev-pos"),a=e("./utils"),l={MAX_SET_BY_DEFAULT:100,HANDLE_RESIZE_DEBOUNCE:100,RANGE_CLASS:"rangeslider",FILL_CLASS:"range_fill",FILL_BG_CLASS:"range_fill_bg",HANDLE_CLASS:"range_handle",DISABLED_CLASS:"range-disabled",STEP_SET_BY_DEFAULT:1,START_EVENTS:["mousedown","touchstart","pointerdown"],MOVE_EVENTS:["mousemove","touchmove","pointermove"],END_EVENTS:["mouseup","touchend","pointerup"],PLUGIN_NAME:"rangeslider-js"},h=0,u=function(e){var t=document.createElement("div");return t.classList.add(e),t},d=function(e){return(e+"").replace(".","").length-1};i.prototype.constructor=i,i.prototype._init=function(){this.options.onInit&&this.options.onInit(),this._update()},i.prototype._updatePercentFromValue=function(){this.percent=(this.value-this.min)/(this.max-this.min)},i.prototype._startEventListener=function(e,t){var n=e.target,i=!1,s=this.identifier;a.forEachAncestorsAndSelf(n,function(e){return i=e.id===s&&!e.classList.contains(l.DISABLED_CLASS)}),i&&this._handleDown(e,t)},i.prototype._changeEventListener=function(e,t){t&&t.origin===this.identifier||this._setPosition(this._getPositionFromValue(e.target.value))},i.prototype._update=function(){this.handleWidth=a.getDimension(this.handle,"offsetWidth"),this.rangeWidth=a.getDimension(this.range,"offsetWidth"),this.maxHandleX=this.rangeWidth-this.handleWidth,this.grabX=this.handleWidth/2,this.position=this._getPositionFromValue(this.value),this.range.classList[this.element.disabled?"add":"remove"](l.DISABLED_CLASS),this._setPosition(this.position),this._updatePercentFromValue(),a.emit(this.element,"change")},i.prototype._listen=function(e){var t=(e?"add":"remove")+"EventListener";l.MOVE_EVENTS.forEach(function(e){document[t](e,this._handleMove)},this),l.END_EVENTS.forEach(function(e){document[t](e,this._handleEnd),this.range[t](e,this._handleEnd)},this)},i.prototype._handleDown=function(e){if(e.preventDefault(),this.isInteracting=!0,this._listen(!0),!e.target.classList.contains(l.HANDLE_CLASS)){var t=o(e,this.range).x,n=this.range.getBoundingClientRect().left,i=this.handle.getBoundingClientRect().left-n;this._setPosition(t-this.grabX),t>=i&&t<i+this.handleWidth&&(this.grabX=t-i),this._updatePercentFromValue()}},i.prototype._handleMove=function(e){this.isInteracting=!0,e.preventDefault();var t=o(e,this.range).x;this._setPosition(t-this.grabX)},i.prototype._handleEnd=function(e){e.preventDefault(),this._listen(!1),a.emit(this.element,"change",{origin:this.identifier}),(this.isInteracting||this.needTriggerEvents)&&this.options.onSlideEnd&&this.options.onSlideEnd(this.value,this.percent,this.position),this.onSlideEventsCount=0,this.isInteracting=!1},i.prototype._setPosition=function(e){var t=this._getValueFromPosition(s(e,0,this.maxHandleX)),n=this._getPositionFromValue(t);this.fill.style.width=n+this.grabX+"px",this.handle.style.webkitTransform=this.handle.style.transform="translate("+n+"px, 0px)",this._setValue(t),this.position=n,this.value=t,this._updatePercentFromValue(),(this.isInteracting||this.needTriggerEvents)&&(this.options.onSlideStart&&0===this.onSlideEventsCount&&this.options.onSlideStart(this.value,this.percent,this.position),this.options.onSlide&&this.options.onSlide(this.value,this.percent,this.position)),this.onSlideEventsCount++},i.prototype._getPositionFromValue=function(e){var t=(e-this.min)/(this.max-this.min);return t*this.maxHandleX},i.prototype._getValueFromPosition=function(e){var t=e/(this.maxHandleX||1),n=this.step*Math.round(t*(this.max-this.min)/this.step)+this.min;return Number(n.toFixed(this.toFixed))},i.prototype._setValue=function(e){e===this.value&&e===this.element.value||(this.value=this.element.value=e,a.emit(this.element,"input",{origin:this.identifier}))},i.prototype.update=function(e,t){return e=e||{},this.needTriggerEvents=!!t,a.isFiniteNumber(e.min)&&(this.element.setAttribute("min",""+e.min),this.min=e.min),a.isFiniteNumber(e.max)&&(this.element.setAttribute("max",""+e.max),this.max=e.max),a.isFiniteNumber(e.step)&&(this.element.setAttribute("step",""+e.step),this.step=e.step,this.toFixed=d(e.step)),a.isFiniteNumber(e.value)&&this._setValue(e.value),this._update(),this.onSlideEventsCount=0,this.needTriggerEvents=!1,this},i.prototype.destroy=function(){window.removeEventListener("resize",this._update,!1),l.START_EVENTS.forEach(function(e){this.range.removeEventListener(e,this._startEventListener)},this),this.element.removeEventListener("change",this._changeEventListener),this.element.style.cssText="",delete this.element[l.PLUGIN_NAME],this.range.parentNode.removeChild(this.range)},i.create=function(e,t){function n(e){e[l.PLUGIN_NAME]=e[l.PLUGIN_NAME]||new i(e,t)}e.length?Array.prototype.slice.call(e).forEach(function(e){n(e)}):n(e)},t.exports=i},{"./styles/base.css":10,"./utils":11,clamp:1,debounce:4,"ev-pos":6}],10:[function(e,t,n){var i=e("./../../node_modules/cssify"),s=".rangeslider {\n    position: relative;\n    cursor: pointer;\n    height: 30px;\n    width: 100%;\n}\n.rangeslider,\n.rangeslider__fill,\n.rangeslider__fill__bg {\n    display: block;\n}\n.rangeslider__fill,\n.rangeslider__fill__bg,\n.rangeslider__handle {\n    position: absolute;\n}\n.rangeslider__fill,\n.rangeslider__fill__bg {\n    top: calc(50% - 6px);\n    height: 12px;\n    z-index: 2;\n    background: #29e;\n    border-radius: 10px;\n    will-change: width;\n}\n.rangeslider__handle {\n    display: inline-block;\n    top: calc(50% - 15px);\n    background: #29e;\n    width: 30px;\n    height: 30px;\n    z-index: 3;\n    cursor: pointer;\n    border: solid 2px #ffffff;\n    border-radius: 50%;\n}\n.rangeslider__handle:active {\n    background: #107ecd;\n}\n.rangeslider__fill__bg {\n    background: #ccc;\n    width: 100%;\n}\n.rangeslider--disabled {\n    opacity: 0.4;\n}\n.rangeslider--slim .rangeslider {\n    height: 25px;\n}\n.rangeslider--slim .rangeslider:active .rangeslider__handle {\n    width: 21px;\n    height: 21px;\n    top: calc(50% - 10px);\n    background: #29e;\n}\n.rangeslider--slim .rangeslider__fill,\n.rangeslider--slim .rangeslider__fill__bg {\n    top: calc(50% - 1px);\n    height: 2px;\n}\n.rangeslider--slim .rangeslider__handle {\n    will-change: width, height, top;\n    -webkit-transition: width 0.1s ease-in-out, height 0.1s ease-in-out, top 0.1s ease-in-out;\n    transition: width 0.1s ease-in-out, height 0.1s ease-in-out, top 0.1s ease-in-out;\n    width: 14px;\n    height: 14px;\n    top: calc(50% - 7px);\n}\n";i(s,void 0,"_1fcddbb"),t.exports=s},{"./../../node_modules/cssify":2}],11:[function(e,t,n){function i(e){return!(0!==e.offsetWidth&&0!==e.offsetHeight&&e.open!==!1)}function s(e){return d(parseFloat(e))||d(e)}function r(){if(!arguments.length)return null;for(var e=0,t=arguments.length;t>e;e++)if(s(arguments[e]))return arguments[e]}function o(e){for(var t=[],n=e.parentNode;n&&i(n);)t.push(n),n=n.parentNode;return t}function a(e,t){function n(e){"undefined"!=typeof e.open&&(e.open=!e.open)}var i,s=o(e),r=s.length,a=e[t],l=[],h=0;if(r){for(h=0;r>h;h++)i=s[h].style,l[h]=i.display,i.display="block",i.height="0",i.overflow="hidden",i.visibility="hidden",n(s[h]);for(a=e[t],h=0;r>h;h++)i=s[h].style,n(s[h]),i.display=l[h],i.height="",i.overflow="",i.visibility=""}return a}function l(e,t){for(t(e);e.parentNode&&!t(e);)e=e.parentNode;return e}function h(e,t){e.parentNode.insertBefore(t,e.nextSibling)}var u=e("custom-event"),d=e("is-finite");t.exports={emit:function(e,t,n){e.dispatchEvent(new u(t,n))},isFiniteNumber:d,getFirstNumberLike:r,getDimension:a,insertAfter:h,forEachAncestorsAndSelf:l}},{"custom-event":3,"is-finite":7}]},{},[9])(9)});

"use strict";


var latLng;
var map;
var searching = false;
var geoEnabled = false;
var myLat = 0;
var myLon = 0;
var myTrueLat = 0;
var myTrueLon = 0;
var radVal = 0;
var offset = 1;
var append = '';
var appendTop = '';
var appendBottom = '';
var locationFirstRun = true;
var mapFirstLoad = true;
var sidebarWidth =0;

var mapCntr = 0;
var markers = [];
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();
var content;
var gpsLen = globalMap.GPSLocations.length;
var lastIndex = 0;
var searchMarker = globalMap.myLocationMarker;
var markerAnchorX;
var markerAnchorY;
var markerWidthX;
var markerWidthY;
var myoverlay;

var page = 0;

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
var markerCluster;

function initMap() {
	if(searching && jQuery.isEmptyObject(globalMap.GPSLocations)){
		toastr.info( globalMap.translations.noBusinessesFound );
	}

	// Hide Business list under map
	jQuery('#business-list').hide();

	if (!globalMap.defCoor || globalMap.defCoor.latitude === '' || undefined === globalMap.defCoor.latitude){
		latLng = new google.maps.LatLng(0, 0);
		globalMap.defCoor = new Object;
		globalMap.defCoor.latitude = 0;
		globalMap.defCoor.longitude = 0;
		globalMap.defCoor.zoom = 11;
	}
	else latLng = new google.maps.LatLng(parseFloat(globalMap.defCoor.latitude), parseFloat(globalMap.defCoor.longitude));
	var scrollwheel = 'on' == mapScrollZoom ? true : false;
	var options = {
		zoom: parseInt(globalMap.defCoor.zoom),
		scrollwheel : scrollwheel,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	};
	map = new google.maps.Map(document.getElementById('home-map'), options);

	if ( '' != globalMap.mapSkin ) {
		map.setOptions({styles: globalMap.mapSkin});
	}

	myoverlay = new google.maps.OverlayView();
    myoverlay.draw = function () {
        this.getPanes().markerLayer.id='markerLayer';
    };
	myoverlay.setMap(map);


	mapCntr = 0;
	markers = [];
	infowindow = new google.maps.InfoWindow();
	bounds = new google.maps.LatLngBounds();
	
	gpsLen = globalMap.GPSLocations.length;
	lastIndex = 0;

	markerCluster = new MarkerClusterer(map, markers, { styles: clusterStyles });
	if (!geoEnabled || !searching) {

	}
}

var slided = false;

function updateMap(){
	var marker;
	gpsLen = globalMap.GPSLocations.length;
	for (var ii = lastIndex; ii<gpsLen; ii++){
		if(''!=globalMap.GPSLocations[ii].latitude&&''!=globalMap.GPSLocations[ii].longitude){
			var latlng = new google.maps.LatLng(parseFloat(globalMap.GPSLocations[ii].latitude), parseFloat(globalMap.GPSLocations[ii].longitude));

			content = '<div id="content">'+
				'<div style="display:none;">' + globalMap.businessNames[ii] + '</div>' +
				'<div id="siteNotice">'+
				'</div>'+
				'<div id="mapBodyContent">'+
				('' != globalMap.businessLogoes[ii] ? globalMap.businessLogoes[ii] : '<img class="business-logo-marker wp-post-image" src="'+globalMap.defLogo+'"/>' )
				+
				'<h4>'+globalMap.businessNames[ii]+'</h4>'+	
				'<a href="'+globalMap.businessPermalinks[ii]+'"' + ( 2 == globalMap.templateType ? '' : ' class="wyz-button" style="background-color:' + globalMap.businessCategoriesColors[ii] + ';"' ) + '>'+globalMap.translations.viewDetails+'</a>'+		
				'</div>'+
				'</div>';

			if ('' !== globalMap.markersWithIcons[ii]) {
				marker = new google.maps.Marker({
					position: latlng,
					icon: {
						url: globalMap.markersWithIcons[ii],
						size: new google.maps.Size(markerWidthX,markerWidthY),
						origin: new google.maps.Point(0, 0),
						anchor: new google.maps.Point(markerAnchorX, markerAnchorY),
					},
					info: content,
					shadow: globalMap.myLocationMarker,
					optimized: false,
					category: parseInt(globalMap.businessCategories[ii]),
					busName: globalMap.businessNames[ii],
					busId: globalMap.businessIds[ii],
					busPermalink:globalMap.businessPermalinks[ii],
					favorite:globalMap.favorites[ii],
					galleryLoaded: false,
					gallery: [],
				});

			} else{
				marker = new google.maps.Marker({
					busName: globalMap.businessNames[ii],
					info: content,
					busId: globalMap.businessIds[ii],
					position: latlng,
					galleryLoaded: false,
					favorite:globalMap.favorites[ii],
					gallery: [],
				});
			}
			if(2 != globalMap.templateType ){
				marker.setAnimation(google.maps.Animation.DROP);
			}

			if(searching || 'on' == mapAutoZoom) {
				bounds.extend(marker.position);
				map.fitBounds(bounds);
			}
			
			var galleryContainer = jQuery('.page-map-right-content .map-info-gallery');


			google.maps.event.addListener(marker, 'click', function() {
				if ( globalMap.templateType == 1){
					infowindow.setContent(this.info);
					infowindow.open(map, this);
				}
				
				this.setAnimation(google.maps.Animation.oo);
				jQuery('.map-company-info .company-logo').attr( 'href',this.busPermalink );
				jQuery('.map-company-info #map-company-info-name>a').attr( 'href',this.busPermalink ).html(this.busName);
				jQuery('.page-map-right-content #rate-bus').attr('href',this.busPermalink +'#'+globalMap.tabs['rating'] );

				jQuery('.map-company-info #map-company-info-slogan').html('');
				jQuery('.page-map-right-content .map-company-info .company-logo img').attr('src','');
				jQuery('.map-company-info #map-company-info-rating').html('');

				if(globalMap.favEnabled){
					var favBus = jQuery('.page-map-right-content #fav-bus');
					favBus.data("busid",this.busId );

					if ( this.favorite){
						favBus.find('i').removeClass('fa-heart-o');
						favBus.find('i').addClass('fa-heart');
						favBus.data('fav',1 );

					} else {
						favBus.find('i').removeClass('fa-heart');
						favBus.find('i').addClass('fa-heart-o');
						favBus.data('fav',0 );
					}
				}

				if(!slided){
					jQuery('#slidable-map-sidebar').animate({right:'0'}, {queue: false, duration: 500});
					slided = true;
				}

				galleryContainer.html('');

				if(!this.galleryLoaded){
					var This = this;
					
					jQuery('.page-map-right-content .search-wrapper #map-sidebar-loading').addClass('loading-spinner');
					jQuery('.page-map-right-content .search-wrapper').css('background-image','');

					jQuery.ajax({
						type: "POST",
						url: ajaxurl,
						data: "action=business_map_sidebar_data&nonce=" + ajaxnonce + "&bus_id=" + this.busId ,
						success: function(result) {

							result = JSON.parse(result);

							This.galleryLoaded = true;
							This.gallery = result;

							jQuery('.map-company-info #map-company-info-slogan').html(result.slogan);

							jQuery('.page-map-right-content .map-company-info .company-logo img').attr('src',result.logo);

							jQuery('.page-map-right-content .search-wrapper #map-sidebar-loading').removeClass('loading-spinner');

							for(var i=0;i<result.gallery.length;i++){
								galleryContainer.append( '<li><img src="'+result.gallery.thumb[i]+'" alt=""></li>' );
							}
							if ( result.gallery.length > 0)
								jQuery('.page-map-right-content .map-info-gallery li:last-child').append('<a class="gal-link" href="'+This.busPermalink+'#'+globalMap.tabs['photo']+'">'+globalMap.translations.viewAll+'</a>');
							jQuery('.map-company-info #map-company-info-desc').html(result.slogan );
							jQuery('.map-company-info #map-company-info-rating').html(result.ratings );
							jQuery('.page-map-right-content .search-wrapper').css('background-image','url('+result.banner_image+')');
							jQuery('.map-info-links').append(result.share);
							if ( result.canBooking) {
								jQuery('.page-map-right-content #book-bus').attr('href',This.busPermalink +'#'+globalMap.tabs['booking'] );
								jQuery('.page-map-right-content #book-bus').parent().css('display','block');
								jQuery('.page-map-right-content .map-info-links li').each(function(){
									jQuery(this).removeClass('three-way-width');
								});
							} else {
								jQuery('.page-map-right-content #book-bus').attr('href','');
								jQuery('.page-map-right-content #book-bus').parent().css('display','none');
								jQuery('.page-map-right-content .map-info-links li').each(function(){
									jQuery(this).addClass('three-way-width');
								});
							}
							jQuery('.page-map-right-content .map-info-gallery li .gal-link').css('line-height',jQuery('.page-map-right-content .map-info-gallery').width()/4+'px');
						}
					});
				} else {
					jQuery('.page-map-right-content .search-wrapper #map-sidebar-loading').removeClass('loading-spinner');
					for(var i=0;i<this.gallery.gallery.length;i++){
						galleryContainer.append( '<li><img src="'+this.gallery.gallery.thumb[i]+'" alt=""></li>' );
					}

					jQuery('.page-map-right-content .map-company-info .company-logo img').attr('src',this.gallery.logo);
					jQuery('.map-company-info #map-company-info-slogan').html(this.gallery.slogan);

					if(this.gallery.gallery.length)
						jQuery('.page-map-right-content .map-info-gallery li:last-child').append('<a class="gal-link" href="'+this.busPermalink+'#'+globalMap.tabs['photo']+'">'+globalMap.translations.viewAll+'</a>');
					jQuery('.map-company-info #map-company-info-desc').html(this.gallery.slogan );
					jQuery('.map-company-info #map-company-info-rating').html(this.gallery.ratings );
					jQuery('.page-map-right-content .search-wrapper').css('background-image','url('+this.gallery.banner_image+')');
					jQuery('.map-info-links').append(this.gallery.share);
					if ( this.gallery.canBooking) {
						jQuery('.page-map-right-content #book-bus').attr('href',this.busPermalink +'#'+globalMap.tabs['booking'] );
						jQuery('.page-map-right-content #book-bus').parent().css('display','block');
						jQuery('.page-map-right-content .map-info-links li').each(function(){
							jQuery(this).css('width','25%');
						});
					} else {
						jQuery('.page-map-right-content #book-bus').attr('href','');
						jQuery('.page-map-right-content #book-bus').parent().css('display','none');
						jQuery('.page-map-right-content .map-info-links li').each(function(){
							jQuery(this).css('width','33%');
						});
					}
					jQuery('.page-map-right-content .map-info-gallery li .gal-link').css('line-height',jQuery('.page-map-right-content .map-info-gallery').width()/4+'px');
				}
			});

			

			markers.push(marker);
			if( 0 >= radVal && ( searching || 'on' == mapAutoZoom )&& marker != undefined ) {
				bounds.extend(marker.position);
				map.fitBounds(bounds);
			}
		}
		
		mapCntr++;
	}

	if ((geoEnabled||'dropdown' != globalMap.filterType) && searching && (0!=myLat||0!=myLon)) {

		marker = new google.maps.Marker({
			position: { lat: parseFloat(myLat), lng: parseFloat(myLon) },
			icon: {
				url: searchMarker,
				size: new google.maps.Size(40,55),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(20, 55),
			},
			map: map
		});
		if(2 != globalMap.templateType )
			marker.setAnimation(google.maps.Animation.DROP);

		//setup radius multiplier in miles or km
		var radMult = ('km'==globalMap.radiusUnit ? 1000 : 1609.34);
		// Add circle overlay and bind to marker
		var circle = new google.maps.Circle({
			map: map,
			radius: radVal * radMult,
			fillColor: '#42c2ff',
			strokeColor: '#00aeff',
			strokeWeight: 1
		});
		circle.bindTo('center', marker, 'position');

		bounds.extend(marker.position);
			
		map.fitBounds(bounds);

		var sz = 0;
		sz = (radVal < 101 ? 8 : (radVal < 201 ? 7 : (radVal < 401 ? 6 : radVal < 501 ? 5 : 0)));
		if (0 !== sz)
			map.setZoom(sz);
	} else {
		var sz = map.getZoom();
		if(sz>3)
			sz--;
		map.setZoom(sz);
	}

	// all markers set and added to map, update marker cluster

	markerCluster = new MarkerClusterer(map, markers, { styles: clusterStyles });
	lastIndex = gpsLen;
}

function initMapFirst(){
	initMap();
	if(globalMap.isListingPage)
		updateBusinessList();
}


function paginateBusinessList(){
	append = appendTop = appendBottom = '';
	if('' != globalMap.businessList){
		if(globalMap.hasBefore || globalMap.hasAfter){
			if(globalMap.hasBefore)
				append += '<li class="prev-page float-left">' + 
					'<button class="blue-btn-square list-paginate" data-offset="-1"><i class="fa fa-angle-left"> </i> ' + globalMap.translations.prev + '</button></li>';
			if(globalMap.hasAfter){
				append += '<li class="next-page float-right">'+
					'<button class="blue-btn-square list-paginate" data-offset="1">' + globalMap.translations.nxt + ' <i class="fa fa-angle-right"></i></button></li>';
			}
			if('' != append){
				appendTop = '<div class="blog-pagination fix" style="margin-bottom:20px;margin-top:0;"><ul>' + append + '</ul></div>';
				appendBottom = '<div class="blog-pagination fix" style="margin-bottom:30px;"><ul>' + append + '</ul></div>';
			}
		}
	}
}

// Display Businesses list under the map
function updateBusinessList(){
	if('' != globalMap.businessList){
		paginateBusinessList();
		//if(jQuery('#business-list').is(":visible")) alert("is visible")
		jQuery('#business-list').hide();
		if(globalMap.ess_grid_shortcode == '') {
		jQuery('#business-list').html(appendTop + '<div class="bus-list-container">' + globalMap.businessList + '</div>' + appendBottom );
		 }
		else {
		jQuery('#business-list').html(appendTop + '<div class="bus-list-container">' + globalMap.ess_grid_shortcode + '</div>' + appendBottom);
		}
		setTimeout(function(){ jQuery('#business-list').show(); jQuery('#business-list').resize();}, 100);
	}
}


var active;
function mapSearch() {
	if ('dropdown' != globalMap.filterType){
		var tmpMapLocSearch = jQuery('#wyz-loc-filter-txt').val();
		if ( '' == tmpMapLocSearch){
			jQuery("#loc-filter-lat").val('');
			jQuery("#loc-filter-lon").val('');
			jQuery("#wyz-loc-filter").val('');
		}
	}

	geoEnabled = ( globalMap.geolocation && navigator.geolocation && 0 < radVal && 500>= radVal )?true:false;
	if ( geoEnabled && (isNaN(radVal) || 0 > radVal || 500 < radVal) )
		toastr.warning( globalMap.translations.notValidRad);
	else {
		var catId = jQuery("#wyz-cat-filter").val();

		var busName = jQuery("#map-names").val();

		jQuery('#map-mask').fadeIn('"slow"');
		jQuery('#map-loading').fadeIn('"fast"');
		

		var locData = jQuery("#wyz-loc-filter").val();
		if ( mapFirstLoad && undefined != globalMap.defLoc && null != globalMap.defLoc )
			locData = globalMap.defLoc;

		var locId = '';

		if ( 'dropdown' == globalMap.filterType ) {
			locData = JSON.parse(locData);

			if( -1 != locData){
				myLat = locData.lat;
				myLon = locData.lon;
				searchMarker = globalMap.locLocationMarker;
			}else if(geoEnabled){
				myLat = myTrueLat;
				myLon = myTrueLon;
			}else{
				searchMarker = globalMap.myLocationMarker;
			}
			

			locId = locData.id;

			if( undefined == locId )
				locId = '';
		} else {

			if ( '' != jQuery("#loc-filter-lat").val()){
				myLat = jQuery("#loc-filter-lat").val();
				myLon = jQuery("#loc-filter-lon").val();
				locId = '';
				if ( radVal<1)radVal=500;
			} else if(radVal>0) {
				myLat = myTrueLat;
				myLon = myTrueLon;
			}
			searchMarker = globalMap.myLocationMarker;
		}
		
		page = 0;

		if(jQuery.active>0&&undefined!=active)
			active.abort();

		if(slided){
			jQuery('#slidable-map-sidebar').animate({right:-sidebarWidth}, {queue: false, duration: 500});
			slided = false;
		}

		if (-1 == catId && '' === busName && "" == locId && 'text' != globalMap.filterType )
			ajax_map_search('', '', '', geoEnabled);
		else
			ajax_map_search(catId, busName, locId, geoEnabled);

		if(mapFirstLoad)
			mapFirstLoad = false;
		else
			searching = true;
	}
}


function intialize() {

	var input = document.getElementById('wyz-loc-filter-txt');
	var autocomplete = new google.maps.places.Autocomplete(input);
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		document.getElementById('loc-filter-txt').value = place.name;
		document.getElementById('loc-filter-lat').value = place.geometry.location.lat();
		document.getElementById('loc-filter-lon').value = place.geometry.location.lng();

	});
}

if('text'==globalMap.filterType){
google.maps.event.addDomListener(window, 'load', intialize);
}

function ajax_map_search(catId, busName, locId, geoEnabled) {
	active = jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: "action=global_map_search&nonce=" + ajaxnonce + "&page=" + page + "&bus-name=" + busName + "&loc-id=" + locId + "&is-listing=" + globalMap.isListingPage + "&is-grid=" + globalMap.isGrid + "&cat-id=" + catId + ( ( geoEnabled || 'text' == globalMap.filterType ) ? "&rad=" +  radVal + "&lat=" + myLat + "&lon=" + myLon : '') + '&posts-per-page=' +(globalMap.isListingPage ? globalMap.postsPerPage : '-1'),
		success: function(result) {


			result = JSON.parse(result);

			if(0==page){
				resetGlobalData(result);
				initMap();
				jQuery('#map-mask').fadeOut('fast');
			}
			else
				updateGlobalData(result);


			if(0==parseInt(result.postsCount)){
				searching=false;
				jQuery('#map-loading').fadeOut('"fast"');
				return;
			}
			
			updateMap();

			if(globalMap.isListingPage)
				updateBusinessList();
			
			page+=parseInt(result.postsCount);
			ajax_map_search(catId, busName, locId, geoEnabled);
		}
	});
}

function resetGlobalData(result){
	var tempMark = globalMap.myLocationMarker;
	var tempLocMark = globalMap.locLocationMarker;
	var tempGeolocation = globalMap.geolocation;
	var defCoor = globalMap.defCoor;
	var defLogo = globalMap.defLogo;
	var radUnit = globalMap.radiusUnit;
	var grid = globalMap.isGrid;
	var translations = globalMap.translations;
	var tmpFilterType = globalMap.filterType;
	var tmpTemplateType = globalMap.templateType;
	var tmpTabs = globalMap.tabs;
	var tmpFavEn = globalMap.favEnabled;
	var tmpSkin = globalMap.mapSkin;

	globalMap = null;
	google.maps.event.trigger(map, 'resize');
	globalMap = result;


	globalMap.myLocationMarker = tempMark;
	globalMap.locLocationMarker = tempLocMark;
	globalMap.geolocation = tempGeolocation;
	globalMap.defCoor = defCoor;
	globalMap.defLogo = defLogo;
	globalMap.radiusUnit = radUnit;
	globalMap.isGrid = grid;
	globalMap.businessList = result.businessList;
	globalMap.isListingPage = result.isListingPage;
	globalMap.postsPerPage = result.postsPerPage;
	globalMap.businessIds = result.businessIds;
	globalMap.hasAfter = result.hasAfter;
	globalMap.hasBefore = result.hasBefore;
	globalMap.filterType = tmpFilterType;
	globalMap.templateType = tmpTemplateType;
	globalMap.translations = translations;
	globalMap.tabs = tmpTabs;
	globalMap.mapSkin = tmpSkin;
	globalMap.favEnabled = tmpFavEn;
}

function updateGlobalData(result){
	for(var i=0;i<result.postsCount;i++){
		globalMap.GPSLocations.push(result.GPSLocations[i]);

		globalMap.markersWithIcons.push(result.markersWithIcons[i]);
		globalMap.businessNames.push(result.businessNames[i]);

		globalMap.businessLogoes.push(result.businessLogoes[i]);
		globalMap.businessPermalinks.push(result.businessPermalinks[i]);
		globalMap.businessCategories.push(result.businessCategories[i]);
		globalMap.businessCategoriesColors.push(result.businessCategoriesColors[i]);
		
	}
	globalMap.postsCount = result.postsCount;
	
}



function ajax_business_list(ofst){
	if(ofst != 1 && ofst != -1)
		return;
	if((ofst == -1 && offset == 0) || (ofst == 1 && ! globalMap.hasAfter))
		return;
	if(ofst == 1)
		offset++;
	else
		offset--;
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: "action=business_listing_paginate&nonce=" + ajaxnonce + "&business_ids=" + JSON.stringify(globalMap.businessIds) + "&is-grid=" + globalMap.isGrid + "&offset=" + offset + '&posts-per-page=' + globalMap.postsPerPage,
		success: function(result) {
			result = JSON.parse(result);
			if(null != result){
				globalMap.businessList = result.businessList;
				globalMap.hasBefore = result.hasBefore;
				globalMap.hasAfter = result.hasAfter;
				globalMap.ess_grid_shortcode = result.ess_grid_shortcode;
				updateBusinessList();
			}
		}
	});
}

function handleLocationError(browserHasGeolocation) {
	//jQuery('#loc-radius-cont').css('display', 'none');
	switch (browserHasGeolocation) {
		case 1:
			toastr.error(globalMap.translations.geoFail);
			break;
		case 2:
			break;
		case 3:
			toastr.warning(globalMap.geolocation.geoBrowserFail);
	}
}

jQuery(document).ready(function() {

	sidebarWidth = jQuery(window).width();

	jQuery('#slidable-map-sidebar').css({'right':-sidebarWidth*2});

	jQuery(".map-share-btn").live({
		click: function (e) {
			e.preventDefault();
			jQuery(this).parent().nextAll(".business-post-share-cont").first().toggle();
		}
	});


	jQuery('.search-wrapper .close-button').click(function(event){
		event.preventDefault();
		if(slided){
			jQuery('#slidable-map-sidebar').animate({right:-sidebarWidth}, {queue: false, duration: 500});
			slided = false;
		}
	});

	globalMap.templateType = parseInt(globalMap.templateType);

	switch ( globalMap.templateType ) {
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

	var useDimmer = 1 == wyz_template_type;

	//pretty select box
	jQuery('#wyz-cat-filter').selectator({
		labels: {
			search: globalMap.translations.searchText
		},
		useDimmer: useDimmer
	});

	jQuery('#wyz-loc-filter').selectator({
		labels: {
			search: globalMap.translations.searchText
		},
		useDimmer: useDimmer
	});

	//add km or miles to the map radius slider
	if(globalMap.radiusUnit=='mile')
		jQuery('.location-search .input-range p span').addClass('distance-miles');
	else
		jQuery('.location-search .input-range p span').addClass('distance-km');

	var range = jQuery('#loc-radius');
	var radius = jQuery('#loc-radius').attr('value')
	jQuery('#loc-radius').siblings('p').find('span').html( radius );

	//hide radius slider if geolocation not enabled fron theme options
	//if (!globalMap.geolocation)
		//jQuery('#loc-radius-cont').css('display', 'none');

	rangesliderJs.create(range,{
		onSlideEnd: function(pos, value) {

			if (locationFirstRun) {
				locationFirstRun = false;

				//geolocation activation
				if (globalMap.geolocation && navigator.geolocation) {
					jQuery('#map-mask').fadeIn('"slow"') ;
					navigator.geolocation.getCurrentPosition(function(position) {
						jQuery('#map-mask').fadeOut('"fast"') ;
						myTrueLat = position.coords.latitude;
						myTrueLon = position.coords.longitude;

					}, function() {
						jQuery('#map-mask').fadeOut('"fast"') ;
						handleLocationError(1);
					});
				} else {
					// Browser doesn't support Geolocation
					//jQuery('#loc-radius-cont').css('display', 'none');
					if (globalMap.geolocation)
						handleLocationError(3);
					else
						handleLocationError(2);
				}
			} 
		}
	});

	jQuery('#fav-bus').click(favoriteBus);

	if ( 2 == globalMap.templateType){
        jQuery('.range_handle').append('<span></span>');
    
		var radiusLength = jQuery('.range_handle span');
		range.on('input', function() {
			radiusLength.html( jQuery(this).val() + ' ' + globalMap.radiusUnit );
			radVal = jQuery(this).val();
		});

		var locRadius = jQuery('input[type="range"]').attr('value');
		var radiusLength = jQuery('.range_handle span');
		radiusLength.html( locRadius + ' ' + globalMap.radiusUnit );
	} else{
		range.on('input', function() {
			jQuery(this).siblings('p').find('span').html( jQuery(this).val() );
			radVal = jQuery(this).val();
		});
	}


	jQuery('#map-names').keypress(function(e) {
		if(e.which == 13) {
			jQuery('#map-search-submit').trigger('click');
		}
	});

	jQuery('#map-search-submit').on('click', mapSearch);

	google.maps.event.addDomListener(window, 'load', function(){initMap();
		mapSearch();
	});


	jQuery(".list-paginate").live('click',function(){
		jQuery(".list-paginate").prop('disabled', true).css('background-color','#68819b'); 
		ajax_business_list(parseInt(jQuery(this).data('offset')));
	});

});

function favoriteBus(event){
	event.preventDefault();
	var bus_id = jQuery(this).data('busid');
	if( '' == bus_id || undefined == bus_id ) return;
	var isFav = jQuery(this).data('fav');
	jQuery(this).parent().addClass('fade-loading');
	jQuery(this).unbind('favoriteBus');
	var favType = isFav == 1 ? 'unfav' : 'fav';
	var target = jQuery(this);

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: "action=business_favorite&nonce=" + ajaxnonce + "&business_id=" + bus_id + "&fav_type=" + favType,
		success: function(result) {
			target.parent().removeClass('fade-loading');
			var i;
			for(i=0;i<globalMap.length;i++){
				if(globalMap.businessIds == bus_id)
					break;
			}
			if(favType=='fav'){
				if(i<globalMap.length)
					globalMap.favorites[i]=true;
				target.find('i').removeClass('fa-heart-o');
				target.find('i').addClass('fa-heart');
				target.data('fav',1 );
			} else {
				if(i<globalMap.length)
					globalMap.favorites[i]=false;
				target.find('i').removeClass('fa-heart');
				target.find('i').addClass('fa-heart-o');
				target.data('fav',0 );
			}
			//target.on('click', favoriteBus);
		}
	});
}

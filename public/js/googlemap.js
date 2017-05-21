/**
 * Google Map Function
 */
(function(){

	'use strict';

	var map;

	var marker;

	var googlemap = {

		/**
		 * Initailize Map
		 */
		init : function(){

			map = new google.maps.Map( document.getElementById('witty-map-wrap'), this.mapSettings() );

			var location = this.latlangFormater( wm.wittyMapLocation );

	        map.setCenter( location );

	        this.plotMarker( location );

		},

		plotMarker : function( latlng ){

			marker = new google.maps.Marker({
				position: latlng,
				map: map,
				animation: google.maps.Animation.DROP,
				icon : wm.wittyMapMarker,
			});

		},

		latlangFormater : function( rawLatLang ){

			var latlng = rawLatLang.split(',');

			if(	latlng[0] == "" ||
				latlng[1] == "" || 
				latlng.length != 2)
			{
				document.getElementById("witty-map-wrap").innerHTML = "Hey Admin! Invalid latitude and longitude, please fix!";
			}

			var formattedLatLang = {
				lat : parseFloat(latlng[0]),
				lng : parseFloat(latlng[1])
			}
			
			return formattedLatLang;
		},

		mapSettings : function(){

			var settings = {
				zoom: parseInt(wm.wittyDefaultZoom),
				draggable : parseInt(wm.wittyMapDraggable) ? true : false,
				disableDoubleClickZoom : parseInt(wm.wittyDoubleClickZoom) ? false : true,
				zoomControl : parseInt(wm.wittyMapZoomCtrl) ? true : false,
				scrollwheel : parseInt(wm.wittyMapScrollWheel) ? true : false,
				streetViewControl : false,
			}

			return settings;
		}

	}

	googlemap.init();

})(jQuery);		
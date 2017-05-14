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

			map = new google.maps.Map(document.getElementById('witty-map-wrap'), {
				zoom: 17,
				draggable : false,
				disableDoubleClickZoom : true,
				zoomControl : false,
				scrollwheel : false,
				streetViewControl : false,
			});

			var location = {lat: 14.635800, lng: 121.094949};

	        map.setCenter( location );

	        this.plotMarker( location );

		},

		plotMarker : function( latlng ){

			marker = new google.maps.Marker({
				position: latlng,
				map: map,
				animation: google.maps.Animation.DROP,
			});

		}

	}

	googlemap.init();

})(jQuery);		
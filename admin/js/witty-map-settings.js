/**
 * Google Map Function
 */
(function($){

	'use strict';

	var frame;

	var imageUrl;

	var wittyAdmin = {

		init : function(){

			this._registerEvents();

		},

		openMedia : function( e ){

			e.preventDefault();

			if ( frame ) {

				frame.open();
				return;
			}

            frame = wp.media({
                title: 'Select witty map marker.',
                button: {
                    text: 'Set as icon'
                },
                multiple: false
            });

            frame.open();

		},

		selectImage : function(){

			var attachment = frame.state().get('selection').first().toJSON();

			var img = attachment.sizes['witty-map-thumb'];

			imageUrl = ( typeof img == 'object' ) ? img.url : attachment.url;

			$("#witty-pointer-wrap img").attr( "src", imageUrl );

			$("#witty-pointer-wrap [type='hidden']").val(imageUrl);

		},

		removeImage : function(e){

			e.preventDefault();

			$( this ).fadeOut(function(){
				$( this ).parent().find( 'img' ).attr( 'src', '' );
				$( this ).parent().find( '[type="hidden"]' ).val("");
			});


		},

		_registerEvents : function(){

			$( document ).on( 'click',	'[data-what="set-marker"]',		this.openMedia	);
			$( document ).on( 'select',	frame, 							this.selectImage );
			$( document ).on( 'click',	'[data-what="remove-marker"]',	this.removeImage );

		}
	}

	wittyAdmin.init();


})(jQuery);		
( function( $ ) {
	$( document ).ready( function() {
		'use strict';

		( function() {

			// copy
			$( document ).on( 'mouseover', '#visual_composer_content', function() {
				$( '.wpb_vc_section, .wpb_vc_row' ).find( '.controls_row' ).on( 'mouseenter', function() {
					var $this = $(this);
					if ( $this.find( '.wn-vc-copy' ).length == 0 ) {
						$this.append( '<a href="#" class="vc_control wn-vc-copy" data-wntooltip="Copy to Clipboard"><i class="ti-files"></i></a>' );
						$this.find( '.wn-vc-copy' ).hide().fadeIn('30');
						// copy
						$this.find( '.wn-vc-copy' ).on( 'click', function( e ) {
							e.preventDefault();
							var vc_model = window.vc.app.views[$(this).closest( '[data-element_type]' ).attr( 'data-model-id' )].model;
							localStorage.setItem( 'wn_vc_copy_shortcode_wrap', vc_model.get( 'shortcode' ) );
							localStorage.setItem( 'wn_vc_copy_shortcode_wrap_params', JSON.stringify( vc_model.get( 'params' ) ) );
							window.wn_vc_copy_shortcodes = [];
							_.each( window.vc.shortcodes.where({ parent_id: vc_model.id }), function( shortcode ) {
								fetch_inner_shortcodes( shortcode, 0 );
							});
							localStorage.setItem( 'wn_vc_copy_shortcodes', JSON.stringify( window.wn_vc_copy_shortcodes ) );
						});
					}
				});
			});

			var fetch_inner_shortcodes = function( shortcode, order) {
				var parent_id = ( order != 0 ) ? shortcode.attributes.parent_id : 0;
				window.wn_vc_copy_shortcodes.push({
					shortcode: shortcode.get( 'shortcode' ),
					params: JSON.stringify( shortcode.get( 'params' ) ),
					parent_id: parent_id,
					id: shortcode.id,
					order: shortcode.get( 'order' )
				});
				_.each( window.vc.shortcodes.where({ parent_id: shortcode.id }), function( shortcode ) {
					fetch_inner_shortcodes( shortcode, -1)
				})
			};

			// vc navbar
			var row = '<li data-wntooltip="Add Row"><a href="#" class="vc_icon-btn vc_navbar-border-right wn-vc-row"><i class="ti-layout-slider-alt"></i></a></li>',
				paste = '<li data-wntooltip="Paste from Clipboard"><a href="#" class="vc_icon-btn vc_navbar-border-right wn-vc-paste"><i class="ti-clipboard"></i></a></li>';
			$( '.vc_navbar' ).find( '.vc_navbar-nav' ).append( row + paste );

			$( '.vc_navbar' ).find( '.vc_navbar-nav' )
				.find( '.vc-composer-icon.vc-c-icon-add_element' ).attr( 'class', 'sl-plus' ).closest( 'li' ).attr( 'data-wntooltip', 'Add New Element' ).end().end()
				.find( '.vc-composer-icon.vc-c-icon-add_template' ).attr( 'class', 'ti-layout-media-overlay-alt-2' ).closest( 'li' ).attr( 'data-wntooltip', 'Templates' ).end().end()
				.find( '.vc-composer-icon.vc-c-icon-fullscreen' ).attr( 'class', 'sl-frame' ).closest( 'li' ).attr( 'data-wntooltip', 'Full Screen' ).end().end()
				.find( '.vc-composer-icon.vc-c-icon-fullscreen_exit' ).attr( 'class', 'sl-size-actual' ).closest( 'li' ).attr( 'data-wntooltip', 'Exit Full Screen' ).end().end()
				.find( '.vc-composer-icon.vc-c-icon-cog' ).attr( 'class', 'sl-settings' ).closest( 'li' ).attr( 'data-wntooltip', 'Custom CSS' ).end().end();

			// paste
			$( '.wn-vc-paste' ).on( 'click', function( e ) {
				e.preventDefault();
				// paste wrap
				var shortcode_wrap_id = vc_guid();
				window.vc.shortcodes.create({
					shortcode: localStorage.getItem( 'wn_vc_copy_shortcode_wrap' ),
					id: shortcode_wrap_id,
					parent_id: false,
					cloned: false,
					params: JSON.parse( localStorage.getItem( 'wn_vc_copy_shortcode_wrap_params' ) )
				});

				// paste shortcodes
				var shortcodes = JSON.parse( localStorage.getItem( 'wn_vc_copy_shortcodes' ) ),
					uid = new Date().getTime();

				_.each( shortcodes, function( shortcode ) {
					shortcode.id = shortcode.id + uid;
					shortcode.parent_id = ( shortcode.parent_id == 0 ) ? shortcode_wrap_id : shortcode.parent_id + uid;
					var params = JSON.parse( shortcode.params );
					if ( params.tab_id != undefined ) {
						params.tab_id = params.tab_id + uid
					}
					window.vc.shortcodes.create({
						shortcode: shortcode.shortcode,
						id: shortcode.id,
						parent_id: shortcode.parent_id,
						cloned: false,
						params: params
					});
				});

			});

			// row
			$( '.wn-vc-row' ).on( 'click', function( e ) {
				e.preventDefault();

				var row_id = vc_guid();
				window.vc.shortcodes.create({
					shortcode: 'vc_row',
					id: row_id,
					parent_id: false,
					cloned: false
				});

				var column_id = new Date().getTime();
				window.vc.shortcodes.create({
					shortcode: 'vc_column',
					id: column_id,
					parent_id: row_id,
					cloned: false,
				});

			});

		})();

	}); // end document ready
})( jQuery );
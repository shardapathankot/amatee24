/* global jQuery */

/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';

domReady( () => {
	const enableUpeCheckbox = document.getElementById(
		'simpay-settings-general-advanced-is_upe'
	);

	if ( ! enableUpeCheckbox ) {
		return;
	}

	enableUpeCheckbox.addEventListener( 'change', ( { target } ) => {
		if ( ! target.checked ) {
			return;
		}

		jQuery( '.simpay-upgrade-upe-modal' ).dialog( {
			position: {
				my: 'center',
				at: 'center',
				of: window,
			},
			modal: true,
			width: 600,
			resizable: false,
			draggable: false,
			open() {
				const m = jQuery( this );

				m.parent().find( '.ui-dialog-titlebar' ).css( {
					borderBottom: 0,
				} );

				m.find( '.dismiss-modal' ).on( 'click', () =>
					m.dialog( 'close' )
				);
			},
		} );
	} );
} );

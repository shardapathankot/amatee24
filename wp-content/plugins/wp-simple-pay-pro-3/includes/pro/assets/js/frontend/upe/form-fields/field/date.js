/* global jQuery */

/**
 * Sets up the "Date" custom field.
 *
 * @since 4.7.0
 *
 * @param {jQuery} $paymentForm Payment form
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function setupDate( $paymentForm ) {
	if ( ! jQuery.datepicker ) {
		return;
	}

	const {
		paymentForm: { i18n },
	} = $paymentForm;
	const dateInputEl = $paymentForm.find( '.simpay-date-input' );

	dateInputEl.datepicker( {
		dateFormat: i18n.dateFormat,
		beforeShow() {
			jQuery( '.ui-datepicker' ).addClass( 'simpay-datepicker' );
		},
	} );

	if ( '' === dateInputEl.val() ) {
		return;
	}

	dateInputEl.datepicker( 'setDate', new Date( dateInputEl.val() ) );
}

export default setupDate;

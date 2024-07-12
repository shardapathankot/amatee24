/**
 * Sets up the "Phone" custom field.
 *
 * @since 4.7.0
 *
 * @param {jQuery} $paymentForm Payment form
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function setupPhone( { paymentForm } ) {
	const { setState } = paymentForm;
	const phoneInputEl = paymentForm.querySelector( '.simpay-telephone' );

	if ( ! phoneInputEl ) {
		return;
	}

	phoneInputEl.addEventListener( 'keypress', ( { target } ) => {
		setState( {
			phone: target.value,
		} );
	} );
}

export default setupPhone;

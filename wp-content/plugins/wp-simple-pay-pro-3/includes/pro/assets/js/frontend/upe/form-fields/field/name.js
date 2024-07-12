/**
 * Sets up the "Name" custom field.
 *
 * @since 4.7.0
 *
 * @param {jQuery} $paymentForm Payment form
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function setupName( { paymentForm } ) {
	const { setState, state } = paymentForm;
	const { paymentElement } = state;
	const nameInputEl = paymentForm.querySelector( '.simpay-customer-name' );

	if ( ! nameInputEl ) {
		return;
	}

	nameInputEl.addEventListener( 'keypress', ( { target } ) => {
		setState( {
			name: target.value,
		} );

		paymentElement.update( {
			defaultValues: {
				billingDetails: {
					name: target.value,
				},
			},
		} );
	} );
}

export default setupName;

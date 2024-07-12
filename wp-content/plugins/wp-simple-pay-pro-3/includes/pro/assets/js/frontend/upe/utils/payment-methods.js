export function getDefaultPaymentMethod( paymentMethod ) {
	return paymentMethod.settings.paymentMethods[ 0 ];
}

/**
 * Returns the payment method types for the current price.
 *
 * @since 4.7.0
 */
export function getPaymentMethodTypes() {
	const { settings, state } = this;
	const { paymentMethods } = settings;
	const { isOptionallyRecurring, price } = state;
	const { currency: priceCurrency, can_recur: canRecur, recurring } = price;

	const supportedCurrencyPaymentMethods = paymentMethods
		.filter( ( { currencies } ) => {
			return currencies.includes( priceCurrency );
		} )
		.map( ( { id } ) => id );

	const supportedRecurringPaymentMethods = paymentMethods
		.filter( ( { recurring: supportsRecurring } ) => {
			return true === supportsRecurring;
		} )
		.map( ( { id } ) => id );

	const filteredPaymentMethods = paymentMethods
		.filter( ( { id } ) => {
			const supportsCurrency = supportedCurrencyPaymentMethods.includes(
				id
			);

			if ( supportsCurrency ) {
				if (
					( ! canRecur && recurring ) ||
					( canRecur && isOptionallyRecurring && recurring )
				) {
					return supportedRecurringPaymentMethods.includes( id );
				}

				return true;
			}

			return false;
		} )
		.map( ( { id } ) => id );

	// Adds `link` as a payment method if the card payment method is enabled.
	if ( filteredPaymentMethods.includes( 'card' ) ) {
		filteredPaymentMethods.push( 'link' );
	}

	return filteredPaymentMethods;
}

/**
 * Returns the payment method options used to create a payment intent.
 *
 * @since 4.7.0
 *
 * @return {Object} Payment method options.
 */
export function getPaymentMethodOptions() {
	return {
		us_bank_account: {
			verification_method: 'instant',
		},
	};
}

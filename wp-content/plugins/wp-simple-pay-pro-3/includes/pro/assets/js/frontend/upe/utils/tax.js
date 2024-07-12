/**
 * External dependencies.
 */
import serialize from 'form-serialize';

/**
 * Calculate automatic tax amounts.
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 * @return {Promise} Promise that resolves when the tax is calculated.
 */
export function calculateAutomaticTax( paymentForm ) {
	const {
		cart,
		cart: { taxStatus },
		error,
		disable,
		enable,
		formId,
		settings,
		setState,
		state,
	} = paymentForm;
	const { addressType } = settings;
	const {
		displayType,
		coupon,
		customAmount,
		isCoveringFees,
		isOptionallyRecurring,
	} = state;

	// Do nothing if automatic tax is not enabled, or using Stripe Checkout.
	// Stripe Checkout and automatic tax restrict addresses to off-site.
	if ( 'automatic' !== taxStatus || 'stripe_checkout' === displayType ) {
		return Promise.resolve( null );
	}

	const addressData = state[ `${ addressType }Address` ] || false;

	if ( ! addressData || ! addressData.complete ) {
		return Promise.resolve( null );
	}

	error( '' );
	disable();

	const baseLineItem = cart.getLineItem( 'base' );

	return window.wp
		.apiFetch( {
			path: 'wpsp/__internal__/payment/calculate-tax',
			method: 'POST',
			data: {
				form_id: formId,
				price_id: baseLineItem.price.id,
				quantity: baseLineItem.quantity,
				custom_amount: customAmount,
				is_optionally_recurring: isOptionallyRecurring,
				is_covering_fees: isCoveringFees,
				coupon_code: coupon !== false ? coupon : null,
				[ `${ addressType }_address` ]: addressData.address || null,
				form_values: serialize( paymentForm, { hash: true } ),
			},
		} )
		.then(
			( {
				total_details: todayTotals,
				upcoming_invoice: upcomingInvoice,
				tax,
				id,
			} ) => {
				setState( {
					taxCalculationId: id,
				} );

				cart.update( {
					automaticTax: {
						...todayTotals,
						upcomingInvoice,
					},
					taxBehavior: tax.behavior,
				} );
			}
		)
		.catch( ( taxError ) => {
			error( taxError );
		} )
		.finally( enable );
}
